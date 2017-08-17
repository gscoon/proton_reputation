# Assignment

1. Please read the __1-Communicate.md__ file.
2. Please read the __2-Design.md__ file.
3. Please run the code in the following files:
	* __new.php__ => handles a new message
	* __spamify.php__ => adds a message to spam
	* __unspamify.php__ => removes a message from spam





## Setting up the environment

docker volume create mysqlv

docker run -d -p 80:80 -p 3306:3306 -v ~/projects/proton:/var/www/html -v mysqlv:/var/lib/mysql -e MYSQL_PASS="ronnie" --name lamp tutum/lamp
