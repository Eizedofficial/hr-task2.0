<?php
// Settings
# ini_set('display_errors', '1');
# error_reporting(E_ALL);

// Files connection
define('ROOT', dirname(__FILE__));
require_once (ROOT . '/components/Router.php');
require_once (ROOT . '/components/Connector.php');
require_once (ROOT . '/components/Responser.php');

// Connect to database
Connector::connect();

// Router start
$router = new Router();
$router->run();