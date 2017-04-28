<?php
require_once("../library/classes/class.RegisteredToken.inc.php");

/**
 * Right after a request is received, generate a token
 *
 * Look for headers
 * Validate browser
 */
$_SERVER["REMOTE_ADDR"] = !empty($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"0.0.0.0";
$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"])??"ISP Name";

mt_srand((double)microtime()*10000);
$hash = strtoupper(md5(uniqid(rand(), true)));
$hyphen = chr(45);// "-"
$token_id =
    substr($hash, 0, 8).$hyphen
    .substr($hash, 8, 4).$hyphen
    .substr($hash,12, 4).$hyphen
    .substr($hash,16, 4).$hyphen
    .substr($hash,20,12);

$token = [
    "token_id" => $token_id,
    "token_ip" => $_SERVER["REMOTE_ADDR"],
    "token_isp" => $hostname,
];

$dsn = "mysql:dbname=users;host=localhost";
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);

# INSERT INTO hello_tokens (token_id, token_ip, token_isp, created_on, expires_on) VALUES ('', '', '', NOW(), DATE_ADD(NOW(), INTERVAL 5 MINUTE));
$insert_sql = "
INSERT INTO hello_tokens (
  token_id,
  token_ip, token_isp,
  created_on, expires_on
) VALUES (
  :token_id,
  :token_ip, :token_isp,
  NOW(), DATE_ADD(NOW(), INTERVAL 5 MINUTE)
);";
$statement = $db->prepare($insert_sql);
$statement->bindParam(":token_id", $token["token_id"]);
$statement->bindParam(":token_ip", $token["token_ip"]);
$statement->bindParam(":token_isp", $token["token_isp"]);
$statement->execute();

$sql="
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
$statement = $db->prepare($sql);
$statement->bindParam(":token_id", $token["token_id"]);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_CLASS, "RegisteredToken");

header("Content-Type: text/json");
if(count($result)>=1)
{
    echo json_encode($result[0]);
}
else
{
    echo json_encode(array("error" => "Not found"));
}