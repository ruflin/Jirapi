<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rodrigo.benz
 * Date: 16.04.12
 * Time: 15:30
 * To change this template use File | Settings | File Templates.
 */
class Jirapi_Transport {
	protected $_config;
	protected $_data;
	protected $_method;
	protected $_path;

	/**
	 * @var resource Curl resource to reuse
	 */
	protected static $_connection = null;

	/**
	 * @param Jirapi_Request $request Request object
	 */
	public function __construct(Jirapi_Request $request) {
		$this->_request = $request;
	}

	public function exec(array $params) {
		$conn = curl_init();

		$request = $this->getRequest();

		if (!empty($params['url'])) {
			$baseUri = $params['url'];
		} else {
			if (!isset($params['host']) || !isset($params['port'])) {
				throw new Jirapi_Exception_Invalid('host and port have to been set');
			}

			$path = isset($params['path']) ? $params['path'] : '';

			$baseUri = 'https://' . $params['host'] . ':' . $params['port'] . '/' . $path;
		}

		$baseUri .= $request->getPath();

		curl_setopt($conn, CURLOPT_URL, $baseUri);
		curl_setopt($conn, CURLOPT_USERPWD, $params['username'] . ":" . $params['password']);
		curl_setopt($conn, CURLOPT_CUSTOMREQUEST, $request->getMethod());
		curl_setopt($conn, CURLOPT_TIMEOUT, 30);

		// cURL opt returntransfer leaks memory, therefore OB instead.
		ob_start();
		curl_exec($conn);
		$response = ob_get_clean();

		// Checks if error exists
		$errorNumber = curl_errno($conn);
		if ($errorNumber > 0) {
			throw new Elastica_Exception_Client($errorNumber, $request, $response);
		}

		return $response;
	}

	/**
	 * @return resource Connection resource
	 */
	protected function _getConnection() {
		if (!self::$_connection) {
			self::$_connection = curl_init();
		}
		return self::$_connection;
	}

	/**
	 * Returns the request object
	 *
	 * @return Elastica_Request Request object
	 */
	public function getRequest() {
		return $this->_request;
	}

	/**
	 * Called to add additional curl params
	 *
	 * @param resource $connection Curl connection
	 */
	protected function _setupCurl($connection) {
		foreach ($this->_request->getClient()->getConfig('curl') as $key => $param) {
			curl_setopt($connection, $key, $param);
		}
	}
}
