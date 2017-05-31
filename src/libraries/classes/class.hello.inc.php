<?php
namespace common;
use dtos\user;
use dtos\token;
use dtos\consumer;
use dtos\application;
use dtos\user_application;

class hello
{
	public function create_user(user $user): bool
	{
	    $insert_sql="INSERT IGNORE INTO hello_users VALUES(:id, :username, :password);";

	    $db = database();
	    $statement = $db->prepare($insert_sql);
	    $statement->bindParam(":id", $user->id);
	    $statement->bindParam(":username", $user->username);
	    $statement->bindParam(":password", $user->password);

	    $success = $statement->execute();
	    return $success;
	}

    public function create_application(application $application): bool
    {
        $insert_sql="INSERT IGNORE INTO hello_applications VALUES(:id, :key, :secret, :name, NOW());";

        $db = database();
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(":id", $application->id);
        $statement->bindParam(":key", $application->key);
        $statement->bindParam(":secret", $application->secret);
        $statement->bindParam(":name", $application->name);

        $success = $statement->execute();
        return $success;
    }

    public function create_user_application(user_application $user_application)
	{
	    $insert_sql="INSERT IGNORE INTO hello_users_applications VALUES(:user, :application);";

        $db = database();
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(":user", $user_application->user);
        $statement->bindParam(":application", $user_application->application);

        $success = $statement->execute();
        return $success;
	}

	public function create_consumer(consumer $consumer)
    {
        $db = database();

        $insert_sql="INSERT IGNORE INTO hello_consumers VALUES(:consumer_id, :application_id, :consumer_key, :consumer_secret, :consumer_name);";
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(":consumer_id", $consumer->id);
        $statement->bindParam(":application_id", $consumer->application);
        $statement->bindParam(":consumer_key", $consumer->key);
        $statement->bindParam(":consumer_secret", $consumer->secret);
        $statement->bindParam(":consumer_name", $consumer->name);

        $success = $statement->execute();
        return $success;
    }

    public function create_token(token $token)
    {
        $db = database();

        $insert_sql = "
INSERT IGNORE INTO hello_tokens (
  token_id, consumer_id,
  token_ip, token_isp,
  created_on, expires_on
) VALUES (
  :token_id, :application_id,
  :token_ip, :token_isp,
  NOW(), DATE_ADD(NOW(), INTERVAL :duration MINUTE)
);";
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(":token_id", $token->id);
        $statement->bindParam(":application_id", $token->application);
        $statement->bindParam(":token_ip", $token->ip);
        $statement->bindParam(":token_isp", $token->isp);
        $statement->bindParam(":duration", $token->duration);

        $success = $statement->execute();
        return $success;
    }
}
