<?php

require __DIR__.'/vendor/autoload.php';

use Classes\Main;

$endpoint = 'http://localhost:3000/offers';

$obj = new Main($endpoint,$argv = []);
$obj->read();

echo '<br><br>';


$obj->getResult();
