<?php
define("__LIBRARIES__", dirname(__FILE__));

require_once(__LIBRARIES__."/dtos/class.user.inc.php");
require_once(__LIBRARIES__."/dtos/class.consumer.inc.php");
require_once(__LIBRARIES__."/dtos/class.token.inc.php");
require_once(__LIBRARIES__."/dtos/class.application.inc.php");
require_once(__LIBRARIES__."/dtos/class.user_application.inc.php");

require_once(__LIBRARIES__."/classes/class.envelope.inc.php");
require_once(__LIBRARIES__."/classes/class.guid.inc.php");
require_once(__LIBRARIES__."/classes/class.rate_limiter.inc.php");
require_once(__LIBRARIES__."/classes/class.hello.inc.php");

/**
 * Hide database configurations from rest of the scripts
 * @return PDO
 */
function database(): PDO
{
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
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
