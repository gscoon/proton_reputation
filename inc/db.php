<?php
	class DB {

		public $conn;

		function __construct(){
			$host = "localhost";
			$dbname = "proton";
			$user = "admin";
			$password = "ronnie";

			$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

			$this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, $opt);

		}

		function getTables(){
			$stmt = $this->conn->query('SHOW TABLES;');
			while ($row = $stmt->fetch()){
			    var_dump($row);
			}
		}

		function getDomainReputation($domain, $authType = false){
			$q = 'SELECT * FROM Reputation WHERE domain = ?';
			if($authType){
				$q .= " AND auth_type = ?";
			}

			$stmt = $this->conn->prepare($q);
			$stmt->execute(array($domain, $authType));

			return $stmt->fetchAll();
		}


		function getUserByAddress($email){
			$q = "SELECT * FROM User WHERE address = ?";
			$stmt = $this->conn->prepare($q);
			$stmt->execute(array($email));
			return $stmt->fetch();
		}

		function getAllUsers(){

		}


	}

	$db = new DB();
?>
