docker run -d -p 80:80 -p 3306:3306 -v /home/j5/proton:/var/www/html -v mysqlv:/var/lib/mysql -e MYSQL_PASS="ronnie" --name lamp tutum/lamp
