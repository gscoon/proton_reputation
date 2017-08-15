<?php
	class DB {

		public $conn;

		function __construct(){
			$host = "localhost";
			$dbname = "proton";
			$user = "admin";
			$password = "ronnie";

			$this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

		}

		function getTables(){
			$stmt = $this->conn->query('SHOW TABLES;');
			while ($row = $stmt->fetch()){
			    var_dump($row);
			}
		}

		function getDomainReputation($domain){
			$sth = $this->conn->prepare('SELECT * FROM Reputation WHERE domain = ?');
			$sth->execute(array($domain));
			return $sth->fetchAll();
		}


	}

	$db = new DB();
?>
