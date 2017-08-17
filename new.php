<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	const SPAM_ASSASSIN_THRESHOLD = 4;

	// include 2 remote classes
	include "inc/db.php";
	include "inc/email.php";

	// read email header from file
	$emailHeader = file_get_contents('./email_header.txt');

	// parse the header for pertanent information (domain names, recipient, etc)
	$parsed = $emailHandler->parseHeader($emailHeader);

	// pull user from database
	$u = $db->getUserByAddress($parsed['to']);
	if(!$u){
		echo 'User not found.';
		return;
	}

	// used to store repuation data for authenticated domain
	$auth = null;

	if($parsed['spf']){
		$result = $db->getDomainReputation($parsed['spf'], 'spf');
		if($result){
			$auth = array();
			$auth['score'] = $result[0]['score'];
			$auth['domain'] = $parsed['spf'];
			$auth['type'] = 'spf';
			$auth['reputation'] = $result[0];
		}
	}

	if($parsed['dkim']){
		$result = $db->getDomainReputation($parsed['dkim'], 'dkim');
		if($result && $result[0]['score'] > $auth){
			$auth = array();
			$auth['score'] = $result[0]['score'];
			$auth['domain'] = $parsed['dkim'];
			$auth['type'] = 'dkim';
			$auth['reputation'] = $result[0];
		}
	}

	// if domain not authenticated...
	if(!$auth){
		echo 'Domain not authenticated';
		return;
	}

	// leave body blank for now
	$messageData = array(
		"body"=>"",
		"header"=>$emailHeader,
		"spamScore"=>$parsed['spamScore'],
		"isSpam"=>true,
		"authType"=>$auth['type'],
		"domain"=>$auth['domain'],
	);

	if($auth['score'] > $u['spam_threshold']){
		$messageData['isSpam'] = false;
		echo 'Domain is good';
	}

	// calcuate the domain name's new reputation
	$newReputation = $emailHandler->calculateReputation($auth['reputation'], $messageData['isSpam'], false);

	// Update new reputation in database
	$db->updateDomainReputation($newReputation);

	// add message to database
	$db->addNewMessage($messageData, $u['UserID']);

	echo "New email added to database";
?>
