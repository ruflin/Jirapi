<?php
/**
 * Class for main interaction
 */
class Jirapi_Client {

	const TIMEOUT = 50;

	/**
	 * Config with defaults
	 *
	 * @var array
	 */
	protected $_config = array(
		'host' => '',
		'port' => '',
		'path' => '',
		'url' => null,
		'username' => '',
		'password' => '',
		'timeout' => self::TIMEOUT,
		'headers' => array(),
		'curl' => array(),
		'log' => false,
	);

	/**
	 * @param array $config
	 */
	public function __construct(array $config = array()) {
		$this->_config = $config;
	}

	/**
	 * Returns a specific config key or the whole
	 * config array if not set
	 *
	 * @param string $key Config key
	 * @return array|string Config value
	 */
	public function getConfig($key = '') {
		if (empty($key)) {
			return $this->_config;
		}

		if (!array_key_exists($key, $this->_config)) {
			throw new Jirapi_Exception_Invalid('Config key is not set: ' . $key);
		}

		return $this->_config[$key];
	}

	/**
	 * Returns host the client connects to
	 *
	 * @return string Host
	 */
	public function getHost() {
		return $this->getConfig('host');
	}

	/**
	 * Returns connection port of this client
	 *
	 * @return int Connection port
	 */
	public function getPort() {
		return (int) $this->getConfig('port');
	}

	/**
	 * @param $issueIdOrKey
	 * @return Jirapi_Response_Abstrac_Issue
	 */
	public function getIssue($issueIdOrKey) {
		$path = '/rest/api/2/issue/' . $issueIdOrKey;
		$responseString = $this->request($path, Jirapi_Request::GET, array());
		$issue = new Jirapi_Response_Abstrac_Issue($responseString);
		return $issue;
	}

	/**
	 * @param	   $path
	 * @param	   $method
	 * @param array $data
	 * @return mixed
	 */
	protected function request($path, $method, $data = array()) {
		$request = new Jirapi_Request($this, $path, $method, $data);
		return $request->send();
	}

}
