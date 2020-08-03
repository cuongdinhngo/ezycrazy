<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(
    array(DOC_ROOT.env('DBAL_PATH_CONFIG')),
    (bool) env('DBAL_DEV_MODE'),
    env('DBAL_PROXY_DIR') ? env('DBAL_PROXY_DIR') : null,
    env('DBAL_CACHE') ? env('DBAL_CACHE') : null,
    (bool) env('DBAL_USE_SIMPLE_ANNO_READER')
);

// database configuration parameters
$conn = array(
    'driver' => env('DB_DRIVER'),
    'dbname' => env('DB_NAME'),
    'user' => env('DB_USER'),
    'password' => env('DB_PASSWORD'),
    'host' => env('DB_HOST').':'.env('DB_PORT'),
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
