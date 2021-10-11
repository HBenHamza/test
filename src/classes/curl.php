<?php

namespace Classes;

use Classes\Log;

class Curl
{
	private $url;
	private $header;
	private $logger;
	function __construct(string $url , $header = false)
	{
		$this->url = $url;
		$this->header = $header;
		$this->logger = new Log();
	}

	public function handleRequest() {
		$ch = curl_init();
		try {
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_HEADER, $this->header);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$response = curl_exec($ch);
			
		    if (curl_errno($ch)) {
				echo curl_error($ch);
				die();
			}
			
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($http_code == intval(200)){
				$log = "Ressource OK 200";
				$this->logger->getLogger()->info($log);

				return json_decode($response);
			}
			else {
				$log = "Undefined ressource ".$http_code;
				$this->logger->getLogger()->info($log);
				return false;
			}
		} catch (\Throwable $th) {
			throw $th;
		} finally {
			curl_close($ch);
		}

	}
}