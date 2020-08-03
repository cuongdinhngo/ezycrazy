<?php
// cli-config.php

require_once "vendor/autoload.php";
require_once "config/system.php";

use Doctrine\ORM\Tools\Console\ConsoleRunner;

//Loading system configuration
config('env');

require_once "app/dbal_bootstrap.php";

return ConsoleRunner::createHelperSet($entityManager);
