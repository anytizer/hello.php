-- Sample data
INSERT IGNORE INTO hello_users (user_id, user_username, user_password) VALUES ('FB9F33F8-5F6E-4EA9-0754-AE809B536B67', 'E0FD27BF-4C3A-6295-2C2C-28025ABCF24F', '3FBF36FD-4E31-403B-F6CB-DD8878757CA7');
INSERT IGNORE INTO hello_applications(application_id, application_name) VALUES ('6C1BC652-DE0A-7D6C-88E3-E49810332F3B', 'Test Application');
INSERT IGNORE INTO hello_users_applications(user_id, application_id, rate_id, created_on, expires_on) VALUES ('FB9F33F8-5F6E-4EA9-0754-AE809B536B67', '6C1BC652-DE0A-7D6C-88E3-E49810332F3B', 'A0067542-162B-DAFC-510B-07BE4DFCE11D', NOW(), DATE_ADD(NOW(), INTERVAL 1 WEEK));
INSERT IGNORE INTO hello_consumers VALUES('84DEAA52-2ACF-22F1-6943-55985444DB19', '6C1BC652-DE0A-7D6C-88E3-E49810332F3B', 'Web API', 'F9961804-61C5-667C-DDD9-B765147630D2', '9F522AA0-A59A-A21A-11A3-EBC6C4A847BA');
INSERT IGNORE INTO hello_tokens (token_id, consumer_id, token_ip, token_isp, created_on, expires_on) VALUES ('1962A8B7-14FF-E72A-7D98-63D21C9F6E35', '84DEAA52-2ACF-22F1-6943-55985444DB19', '0.0.0.0', 'localhost', NOW(), DATE_ADD(NOW(), INTERVAL 30 MINUTE));

SELECT *, (60 * rate_counts / rate_seconds) per_second FROM hello_rates ORDER BY RATE_COUNTS;

-- curl --data "key=F9961804-61C5-667C-DDD9-B765147630D2&secret=9F522AA0-A59A-A21A-11A3-EBC6C4A847BA" http://hello.example.com:9090/hello.php
-- curl --data "token=1962A8B7-14FF-E72A-7D98-63D21C9F6E35" http://hello.example.com:9090/

-- Check validity of a consumer key
SELECT * FROM hello_consumers WHERE consumer_key='F9961804-61C5-667C-DDD9-B765147630D2' AND consumer_secret='9F522AA0-A59A-A21A-11A3-EBC6C4A847BA';
SELECT
	consumer_id id, consumer_key `key`, consumer_secret secret, consumer_name `name` 
FROM hello_consumers WHERE consumer_key='F9961804-61C5-667C-DDD9-B765147630D2' AND consumer_secret='9F522AA0-A59A-A21A-11A3-EBC6C4A847BA';

-- Cleanups
DELETE FROM hello_tokens WHERE expires_on < NOW();