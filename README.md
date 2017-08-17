# Assignment

1. 1-Communicate.md
2. 2-Design.md
3.
	* new.php => handles a new message
	* spamify.php => adds a message to spam
	* unspamify.php => removes a message from spam





## Setting up the environment

docker volume create mysqlv

docker run -d -p 80:80 -p 3306:3306 -v ~/projects/proton:/var/www/html -v mysqlv:/var/lib/mysql -e MYSQL_PASS="ronnie" --name lamp tutum/lamp
