-- Sample data
INSERT IGNORE INTO hello_users (user_id, user_username, user_password) VALUES ('FB9F33F8-5F6E-4EA9-0754-AE809B536B67', 'E0FD27BF-4C3A-6295-2C2C-28025ABCF24F', '3FBF36FD-4E31-403B-F6CB-DD8878757CA7');
INSERT IGNORE INTO hello_applications(application_id, application_secret, application_name) VALUES ('6C1BC652-DE0A-7D6C-88E3-E49810332F3B', '25A89AE9-7E24-8584-C289-F142D66764F0', '54BA33F0-48DF-83CF-33E1-E522DFBE3206');
INSERT IGNORE INTO hello_users_applications(user_id, application_id, created_on, expires_on) VALUES ('FB9F33F8-5F6E-4EA9-0754-AE809B536B67', '6C1BC652-DE0A-7D6C-88E3-E49810332F3B', NOW(), DATE_ADD(NOW(), INTERVAL 1 WEEK));
