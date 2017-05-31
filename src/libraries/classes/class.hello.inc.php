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

        $insert_sql="INSERT IGNORE INTO hello_consumers VALUES(:id, :application, :key, :secret, :name);";
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(":id", $consumer->id);
        $statement->bindParam(":application", $consumer->application);
        $statement->bindParam(":key", $consumer->key);
        $statement->bindParam(":secret", $consumer->secret);
        $statement->bindParam(":name", $consumer->name);

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
  :token_id, :consumer_id,
  :token_ip, :token_isp,
  NOW(), DATE_ADD(NOW(), INTERVAL :duration MINUTE)
);";
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(":token_id", $token->id);
        $statement->bindParam(":consumer_id", $token->consumer);
        $statement->bindParam(":token_ip", $token->ip);
        $statement->bindParam(":token_isp", $token->isp);
        $statement->bindParam(":duration", $token->duration);

        $success = $statement->execute();
        return $success;
    }
}
