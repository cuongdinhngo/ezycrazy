<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

/**
 * Set DOCUMENT_ROOT
 */
if ($_SERVER["DOCUMENT_ROOT"]) {
	define('DOC_ROOT', $_SERVER["DOCUMENT_ROOT"]);
} else {
	define('DOC_ROOT', __DIR__);
}

define('CONFIG_PATH', DOC_ROOT.'/../config/');
define('ROUTE_PATH', DOC_ROOT.'/../app/Routes/');
define('CONTROLLER_PATH', DOC_ROOT.'/../app/Controllers/');
define('VIEW_PATH', DOC_ROOT.'/../resources/views/');
define('STORAGE_PATH', DOC_ROOT.'/../storage/');
define('LOG_PATH', DOC_ROOT.'/../storage/logs/');
define('RESOURCES_PATH', DOC_ROOT.'/../resources/');
define('ASSETS_PATH', DOC_ROOT.'/assets/');
define('MIDDLEWARE_PATH', DOC_ROOT.'/../app/Middlewares/');
