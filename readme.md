# hello.php

Hello token API - Creates amd registers a token.


## Examples

    curl http://hello.example.com:9090/

### From PHP variables only

    {"token_id":"F906C98C-B10E-2F69-E0F5-B1BC99C28DDD","token_ip":"0.0.0.0","token_isp":"ISP Name"}

### From database lookup

    {"token_id":"A3982D83-D3F6-EB30-FE6C-83C23C30971D","token_ip":"127.0.0.1","token_isp":"api.example.com","created_on":"2017-04-27 21:13:58","expires_on":"2017-04-27 21:18:58"}

### Table Structure

    CREATE TABLE `hello_tokens` (
      `token_id` VARCHAR(255) NOT NULL COMMENT 'Token ID/Code',
      `token_ip` VARCHAR(255) NOT NULL COMMENT 'Token IP Address',
      `token_isp` VARCHAR(255) NOT NULL COMMENT 'Token ISP',
      `created_on` DATETIME NOT NULL COMMENT 'Created On',
      `expires_on` DATETIME NOT NULL COMMENT 'Validity',
      PRIMARY KEY (`token_id`)
    );
