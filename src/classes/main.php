<?php

namespace Classes;

use Interfaces\readerInterface as Reader;
use Interfaces\offerCollectionInterface as Collection;
use Classes\curl;

class Main implements Reader , Collection, \IteratorAggregate
{
	protected $input;
	protected $type;
	protected $price_from;
	protected $price_to;
	protected $vendor_id;
	protected $offers = [];
	protected $n;
	
	function __construct(string $input,$args = []) {
		$this->input = $input;
		$this->handleOperation($args);
	}

	public function rewind() {
        $this->n = 0;
    }
 
    public function next() {
        $this->n++;
    }
 
    public function key() {
       return $this->n+1;
    }
 
    public function current() {
        return $this->n;
    }

    public function valid() {
        return $this->n > 0;
    }


	private function handleOperation($args) {
		$type = isset($args[1]) ? $args[1] : '';
		switch ($type) {
			case 'count_by_price_range':
				$this->type = 'count_by_price_range';
				$this->price_from = isset($args[2]) ? $args[2] : 0;
				$this->price_to = isset($args[3]) ? $args[3] : 0;
				break;
			case 'count_by_vendor_id':
				$this->type = 'count_by_vendor_id';
				$this->vendor_id = isset($args[2]) ? $args[2] : 0;
				break;
				
			default:
				$this->type = '';
				$this->price_from = 0;
				$this->price_to = 0;
				$this->vendor_id = 0;
			break;
		}
	}

	public function read() {
		echo $this->input;
		$curl = new Curl($this->input);
		$response = $curl->handleRequest();

		if($response) $this->offers = $response;

	}

	public function getIterator() : \Iterator {
		foreach($this->offers as $key => $val) {
		   
		}
		return new \ArrayIterator(['A','B']);
	}

	public function getResult() {
		foreach ($this->getIterator() as $key => $value) {
		    echo $key;
		    echo $value;
		}
	}

	public function count() {
		return iterator_count($this->getIterator());
	}

	public function get(int $index): OfferInterface {

	}
}