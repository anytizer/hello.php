# hello.php

Creates a token for registered API Consumers for first time use.

Required $_POST Parameters:

 * Consumer Key (Software's internal username)
 * Consumer Secret (Software's Internal Password)

## Token Usage management

(Work in progress)

 * Create User: `hello user USER_ID`
 * Create Application: `hello application USER_ID APPLICATION_ID`
 * Create Consumer: `hello consumer APPLICATION_ID CONSUMER_ID`
 * Create Token: `hello token TOKEN_ID`
 * Authenticate Token: `hello auth TOKEN_ID`
 * Log Access


## JSON Output Examples

    curl http://hello.example.com:9090/
    curl --data "id=ID001&key=KEY001" http://hello.example.com:9090/


### From PHP variables only

DO NOT use it.

    {"token_id":"F906C98C-B10E-2F69-E0F5-B1BC99C28DDD","token_ip":"0.0.0.0","token_isp":"ISP Name"}

### From database lookup

DO NOT use it.

    {"token_id":"A3982D83-D3F6-EB30-FE6C-83C23C30971D","token_ip":"127.0.0.1","token_isp":"api.example.com","created_on":"2017-04-27 21:13:58","expires_on":"2017-04-27 21:18:58"}


### Minified with DTO

Use it.

    {"status":true,"data":{"id":"E46FC48D-8DB4-6209-ACDE-1107E755B197","ip":"127.0.0.1","isp":"api.example.com","created":"2017-04-28 20:17:51","expires":"2017-04-28 20:22:51"}}


## Table Structure

    CREATE TABLE `hello_tokens` (
      `token_id` VARCHAR(255) NOT NULL COMMENT 'Token ID/Code',
	  `application_id` VARCHAR(255) NOT NULL COMMENT 'Application ID',
      `token_ip` VARCHAR(255) NOT NULL COMMENT 'Token IP Address',
      `token_isp` VARCHAR(255) NOT NULL COMMENT 'Token ISP',
      `created_on` DATETIME NOT NULL COMMENT 'Created On',
      `expires_on` DATETIME NOT NULL COMMENT 'Validity',
      PRIMARY KEY (`token_id`),
    );