DROP DATABASE IF EXISTS awesome_hello;
CREATE DATABASE awesome_hello CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON awesome_hello.* TO 'hello'@'localhost' IDENTIFIED BY 'olleh';
USE awesome_hello;

-- SHOW CREATE TABLE hello_users;
-- DROP TABLE IF EXISTS hello_users;
CREATE TABLE `hello_users` (
  `user_id` VARCHAR(255) NOT NULL COMMENT 'User ID',
  `user_username` VARCHAR(255) NOT NULL COMMENT 'Unique User Name',
  `user_password` VARCHAR(255) NOT NULL COMMENT 'User Password',
  PRIMARY KEY (`user_id`)
);

-- SHOW CREATE TABLE hello_applications;
-- DROP TABLE IF EXISTS hello_applications;
CREATE TABLE `hello_applications` (
  `application_id` VARCHAR(255) NOT NULL COMMENT 'Application ID',
  `application_secret` VARCHAR(255) NOT NULL COMMENT 'Token ISP',
  `application_name` VARCHAR(255) NOT NULL COMMENT 'Token IP Address',
  PRIMARY KEY (`application_id`)
);

-- SHOW CREATE TABLE hello_users_applications;
-- DROP TABLE IF EXISTS hello_users_applications;
CREATE TABLE `hello_users_applications` (
  `user_id` VARCHAR(255) NOT NULL,
  `application_id` VARCHAR(255) NOT NULL,
  `created_on` DATETIME NOT NULL COMMENT 'Created On',
  `expires_on` DATETIME NOT NULL COMMENT 'Validity',
  PRIMARY KEY (`user_id`,`application_id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `hello_users_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `hello_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hello_users_applications_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `hello_applications` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- SHOW CREATE TABLE hello_tokens;
-- DROP TABLE IF EXISTS hello_tokens;
CREATE TABLE `hello_tokens` (
  `token_id` VARCHAR(255) NOT NULL COMMENT 'Token ID/Code',
  `application_id` VARCHAR(255) NOT NULL COMMENT 'Application ID',
  `token_ip` VARCHAR(255) NOT NULL COMMENT 'Token IP Address',
  `token_isp` VARCHAR(255) NOT NULL COMMENT 'Token ISP',
  `created_on` DATETIME NOT NULL COMMENT 'Created On',
  `expires_on` DATETIME NOT NULL COMMENT 'Validity',
  PRIMARY KEY (`token_id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `hello_tokens_token_id` FOREIGN KEY (`application_id`) REFERENCES `hello_applications` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE
);