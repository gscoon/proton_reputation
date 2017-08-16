docker volume create mysqlv

docker run -d -p 80:80 -p 3306:3306 -v ~/projects/proton:/var/www/html -v mysqlv:/var/lib/mysql -e MYSQL_PASS="ronnie" --name lamp tutum/lamp
