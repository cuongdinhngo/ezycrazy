<?php

error_reporting(E_ALL & ~E_NOTICE);
require __DIR__ . '/../vendor/autoload.php';

use Atom\Http\Server;

$server = new Server(['env']);
$server->handle();

echo '<h1>GOOD LUCK!!! Is API? '.isApi().'</h1>';
