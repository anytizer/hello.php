@ECHO OFF
mysql -uhello -polleh awesome_hello < cleanup.sql
mysqldump --routines -uhello -polleh awesome_hello > hello.dmp
PAUSE
