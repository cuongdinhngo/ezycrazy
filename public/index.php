<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/autoload.php';

use Atom\Http\Server;

try {
    $server = new Server(['env']);
    $server->handle();
} catch (\Exception $e) {
    echo $e->getMessage();
}
