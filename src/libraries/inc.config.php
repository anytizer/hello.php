<?php
define("__LIBRARIES__", dirname(__FILE__));

require_once(__LIBRARIES__."/dtos/class.consumer.inc.php");
require_once(__LIBRARIES__."/dtos/class.registered_token.inc.php");

require_once(__LIBRARIES__."/classes/class.envelope.inc.php");
require_once(__LIBRARIES__."/classes/class.guid.inc.php");
require_once(__LIBRARIES__."/classes/class.rate_limiter.inc.php");

/**
 * Right after a request is received, generate a token
 *
 * Look for headers
 * Validate browser
 */
$dsn = "mysql:dbname=awesome_hello;host=localhost";
$user = "hello";
$password = "olleh";
$db = new PDO($dsn, $user, $password);
