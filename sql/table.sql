SHOW CREATE TABLE hello_tokens;
CREATE TABLE `hello_tokens` (
  `token_id` VARCHAR(255) NOT NULL COMMENT 'Token ID/Code',
  `token_ip` VARCHAR(255) NOT NULL COMMENT 'Token IP Address',
  `token_isp` VARCHAR(255) NOT NULL COMMENT 'Token ISP',
  `created_on` DATETIME NOT NULL COMMENT 'Created On',
  `expires_on` DATETIME NOT NULL COMMENT 'Validity',
  PRIMARY KEY (`token_id`)
);
