<?php
require_once("../library/classes/class.envelope.inc.php");
require_once("../library/classes/class.guid.inc.php");
require_once("../library/classes/class.RegisteredToken.inc.php");

/**
 * Right after a request is received, generate a token
 *
 * Look for headers
 * Validate browser
 */
$dsn = "mysql:dbname=awesome_hello;host=localhost";
$user = "hello";
$password = "olleh";
$application_id = "6C1BC652-DE0A-7D6C-88E3-E49810332F3B";
$application_secret = "25A89AE9-7E24-8584-C289-F142D66764F0";
$db = new PDO($dsn, $user, $password);

class rates
{
    public $counter;
    public $seconds;
}

class rate_limiter
{
    public function tokens_count(string $application_id): int
    {
        return 0;
    }

    public function get_rate(string $application_id): rates
    {
        $rates = new rates();
        $rates->counter = 0;
        $rates->seconds = 0;

        return $rates;
    }

    public function can_generate_more_tokens(string $application_id): bool
    {
        $this->get_rate($application_id);
    }
}

$rate_limiter = new rate_limiter();

$_SERVER["REMOTE_ADDR"] = !empty($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"0.0.0.0";
$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"])??"ISP Name";

$token_id = (new guid())->NewGuid();

$token = [
    "token_id" => $token_id,
    "application_id" => $application_id,
    "token_ip" => $_SERVER["REMOTE_ADDR"],
    "token_isp" => $hostname,
];

# INSERT INTO hello_tokens (token_id, token_ip, token_isp, created_on, expires_on) VALUES ('', '', '', NOW(), DATE_ADD(NOW(), INTERVAL 5 MINUTE));
$insert_sql = "
INSERT INTO hello_tokens (
  token_id, application_id,
  token_ip, token_isp,
  created_on, expires_on
) VALUES (
  :token_id, :application_id,
  :token_ip, :token_isp,
  NOW(), DATE_ADD(NOW(), INTERVAL 5 MINUTE)
);";
$statement = $db->prepare($insert_sql);
$statement->bindParam(":token_id", $token["token_id"]);
$statement->bindParam(":application_id", $token["application_id"]);
$statement->bindParam(":token_ip", $token["token_ip"]);
$statement->bindParam(":token_isp", $token["token_isp"]);
$statement->execute();

$select_sql="
SELECT
    token_id id,
    token_ip ip,
    token_isp isp,
    created_on created,
    expires_on expires
FROM hello_tokens
WHERE
  token_id=:token_id
  AND NOW() <= expires_on
LIMIT 1;";
$statement = $db->prepare($select_sql);
$statement->bindParam(":token_id", $token["token_id"]);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_CLASS, "RegisteredToken");

$envelope = new envelope();
if(count($result)>=1)
{
    $envelope->found($result[0]);
}
else
{
    $envelope->not_found(array("error" => "Not found"));
}