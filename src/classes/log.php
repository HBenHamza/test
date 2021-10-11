<?php

namespace Classes;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter; 

Class Log {
	protected $handler;
	protected $logger;
	function __construct() {
		$this->handler = new StreamHandler(dirname(dirname(__DIR__)).'/logs/test.log',Logger::DEBUG);
		$this->handler->setFormatter(new LineFormatter());
		
		$this->logger = new Logger('SimpleLogger');
		$this->logger->pushHandler($this->handler);
	}

	public function getLogger() {
		return $this->logger;
	}
}