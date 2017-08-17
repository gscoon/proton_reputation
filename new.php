<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	const SPAM_ASSASSIN_THRESHOLD = 4;

	include "inc/db.php";
	include "inc/email.php";

	// receive email header
	$emailHeader = file_get_contents('./email_header.txt');

	echo '<pre>';

	$parsed = $emailHandler->parseHeader($emailHeader);

	// var_dump($parsed);

	$u = $db->getUserByAddress($parsed['to']);
	if(!$u){
		echo 'User not found.';
		return;
	}

	$spam = array("score"=>0, "domain"=>null, "auth"=>null);

	if($parsed['spf']){
		$result = $db->getDomainReputation($parsed['spf'], 'spf');
		if($result){
			$spam['score'] = $result[0]['score'];
			$spam['domain'] = $parsed['spf'];
			$spam['auth'] = 'spf';
			$spam['reputation'] = $result[0];
		}
	}

	if($parsed['dkim']){
		$result = $db->getDomainReputation($parsed['dkim'], 'dkim');
		if($result && $result[0]['score'] > $spam){
			$spam['score'] = $result[0]['score'];
			$spam['domain'] = $parsed['dkim'];
			$spam['auth'] = 'dkim';
			$spam['reputation'] = $result[0];
		}
	}

	// if domain not authenticated...
	if(!$spam['domain']){
		echo 'Domain not authenticated';
		return;
	}

	$messageData = array(
		"body"=>"",
		"header"=>$emailHeader,
		"spamScore"=>$parsed['spamScore'],
		"isSpam"=>true,
		"authType"=>$spam['auth'],
		"domain"=>$spam['domain'],
	);

	if($spam['score'] > $u['spam_threshold']){
		$messageData['isSpam'] = false;
		echo 'Domain is good';
	}


	$newReputation = $emailHandler->calculateReputation($spam['reputation'], $messageData['isSpam'], false);

	// var_dump($newReputation);
	$db->updateDomainReputation($newReputation);

	$db->addNewMessage($messageData, $u['UserID']);


?>
