<?php
require_once dirname(__FILE__) . '/../../bootstrap.php';

class Jirapi_ClientTest extends Jirapi_Test {

	public function testConstruct() {
		$host = 'ruflin.com';
		$port = 9300;
		$client = new Jirapi_Client(array(
			'host' => $host,
			'port' => $port
		));

		$this->assertEquals($host, $client->getHost());
		$this->assertEquals($port, $client->getPort());
	}

}

