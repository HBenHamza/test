<?php

namespace Interfaces;

interface OfferCollectionInterface {
	public function get(int $index);
	public function getIterator(): \Iterator;
}