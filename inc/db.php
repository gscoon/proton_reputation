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


		function updateDomainReputation($reputation){
			$q = "UPDATE Reputation SET count_autononspam = :count_autononspam, count_autospam = :count_autospam, count_manual_spam = :count_manual_spam, count_manual_nonspam = :count_manual_nonspam, score = :score, total = :total WHERE domain=:domain and auth_type=:auth_type";

			$data = array(
				":domain" => $reputation['domain'],
				":auth_type" => $reputation['auth_type'],
				":count_autononspam" => $reputation['count_autononspam'],
				":count_autospam" => $reputation['count_autospam'],
				":count_manual_spam" => $reputation['count_manual_spam'],
				":count_manual_nonspam" => $reputation['count_manual_nonspam'],
				":total" => $reputation['total'],
				":score" => $reputation['score'],
			);

			// var_dump($data);

			$stmt = $this->conn->prepare($q);
			return $stmt->execute($data);
		}


		function addNewMessage($messageData, $userID){
			$now = time();
			$data = array(
				":userID"=> $userID,
				":body"=> $messageData['body'], // default blank for now,
				":header"=> $messageData['header'],
				":time"=> $now,
				":spamScore"=> $messageData['spamScore'],
				":isSpam"=> $messageData['isSpam'],
				":authType"=> $messageData['authType'],
				":domain"=> $messageData['domain'],
			);

			var_dump($data);

			$q = "INSERT INTO Message (UserID, Time, SpamScore, Body, Header, isSpam, AuthType, Domain) VALUES (:userID, :time, :spamScore, :body, :header, :isSpam, :authType, :domain)";

			$stmt = $this->conn->prepare($q);
			return $stmt->execute($data);
		}


		function getUserByAddress($email){
			$q = "SELECT * FROM User WHERE address = ?";
			$stmt = $this->conn->prepare($q);
			$stmt->execute(array($email));
			return $stmt->fetch();
		}


		function getUserSpamAction($userID, $messageID){
			$q = "SELECT * FROM User_Spam_Action WHERE user_id = ? AND message_id = ?";
			$stmt = $this->conn->prepare($q);
			$stmt->execute(array($userID, $messageID));
			return $stmt->fetch();
		}


		function getEmailByID($id){
			$q = "SELECT * FROM Message WHERE MessageID = ?";
			$stmt = $this->conn->prepare($q);
			$stmt->execute(array($id));
			return $stmt->fetch();
		}


		function updateMessageSpamStatus($messageID, $isSpam){
			$q = "UPDATE Message SET isSpam = ? WHERE MessageID = ?";
			$stmt = $this->conn->prepare($q);
			return $stmt->execute(array($isSpam, $messageID));
		}


		function addUserSpamAction($userID, $messageID, $isSpam){
			$q = "INSERT INTO User_Spam_Action (user_id, message_id, is_spam, timestamp) VALUES (?,?,?,?)";
			$ts = date("Y-m-d H:i:s");
			$stmt = $this->conn->prepare($q);
			return $stmt->execute(array($userID, $messageID, $isSpam, $ts));
		}


		function setUserSpamAction($userID, $messageID, $isSpam){
			$q = "UPDATE User_Spam_Action SET is_spam = ?, timestamp = ? WHERE message_id = ? AND user_id = ?";
			$ts = date("Y-m-d H:i:s");
			$stmt = $this->conn->prepare($q);
			return $stmt->execute(array($isSpam, $ts, $messageID, $userID));
		}

	}

	$db = new DB();
?>
