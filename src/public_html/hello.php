<?php
namespace front;

require_once("../libraries/inc.config.php");

use PDO;
use common\guid;
use common\envelope;
use dtos\rates;
use dtos\registered_token;
use dtos\consumer;

$envelope = new envelope();

$consumer = array(
    "key" => $_POST["key"]??"",
    "secret" => $_POST["secret"]??""
);

# Verify consumer
$select_consumer_sql="
SELECT
  consumer_id id,
  consumer_key `key`,
  consumer_secret secret,
  consumer_name `name` 
FROM hello_consumers
WHERE
  consumer_key=:consumer_key
  AND consumer_secret=:consumer_secret
LIMIT 1;";
$statement = $db->prepare($select_consumer_sql);
$statement->bindParam(":consumer_key", $consumer["key"]);
$statement->bindParam(":consumer_secret", $consumer["secret"]);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_CLASS, "dtos\\consumer");
if(count($result)!=1)
{
    #die("Error, not found");
    $envelope->not_found(array("error" => "Not found"));
}
else
{
    # To insert into the database
    $token = array(
        "token_id" => (new guid())->NewGuid(),
        "application_id" => $result[0]->id,
        "token_ip" => "??",
        "token_isp" => "??",
        "duration" => "30", # minutes
    );

    # To send out to the application
    $output = array(
        "token" => $token["token_id"],
    );

    $insert_sql = "
INSERT INTO hello_tokens (
  token_id, consumer_id,
  token_ip, token_isp,
  created_on, expires_on
) VALUES (
  :token_id, :application_id,
  :token_ip, :token_isp,
  NOW(), DATE_ADD(NOW(), INTERVAL :duration MINUTE)
);";
    $statement = $db->prepare($insert_sql);
    $statement->bindParam(":token_id", $token["token_id"]);
    $statement->bindParam(":application_id", $token["application_id"]);
    $statement->bindParam(":token_ip", $token["token_ip"]);
    $statement->bindParam(":token_isp", $token["token_isp"]);
    $statement->bindParam(":duration", $token["duration"]);
    $statement->execute();

    $envelope->found($output);
}
#print_r($result);
#print_r($_POST);
