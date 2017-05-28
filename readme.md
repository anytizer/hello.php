# hello.php

Creates a token for registered API Consumers for first time use.

Application status: Work in progress; do not clone.

Required `$_POST` Parameters:

 * Consumer Key (Software's internal username)
 * Consumer Secret (Software's Internal Password)


## Token Usage management

 * Create User: `hello user USER_ID`
 * Create Application: `hello application USER_ID APPLICATION_ID`
 * Create Consumer: `hello consumer APPLICATION_ID CONSUMER_ID`
 * Create Token: `hello token TOKEN_ID`
 * Authenticate Token: `hello auth TOKEN_ID`
 * Log Access


## JSON Output Examples

On Success

    curl --data "key=F9961804-61C5-667C-DDD9-B765147630D2&secret=9F522AA0-A59A-A21A-11A3-EBC6C4A847BA" http://hello.example.com:9090/hello.php

Output

    {"status":true,"data":{"token":"8010C186-DD34-A2B3-8D13-8EAFB8549011"}}


On Error

    curl http://hello.example.com:9090/hello.php
	
Output

	{"status":false,"data":{"error":"Not found"}}


## Table Structure

    CREATE TABLE `hello_tokens` (
      `token_id` varchar(255) NOT NULL COMMENT 'Token ID',
      `consumer_id` varchar(255) NOT NULL COMMENT 'Consumer ID',
      `token_ip` varchar(255) NOT NULL COMMENT 'Token IP Address',
      `token_isp` varchar(255) NOT NULL COMMENT 'Token ISP',
      `created_on` datetime NOT NULL COMMENT 'Created On',
      `expires_on` datetime NOT NULL COMMENT 'Validity',
      PRIMARY KEY (`token_id`),
      KEY `consumer_id` (`consumer_id`),
      CONSTRAINT `hello_tokens_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `hello_consumers` (`consumer_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

For details, see `database/hello.dmp`
