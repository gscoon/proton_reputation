<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "inc/db.php";
	include "inc/email.php";

	// receive email header
	$emailContent = file_get_contents('./email_header.txt');

	echo '<pre>';

	$parsed = $emailHandler->doParse($emailContent);

	$u = $db->getUserByAddress($parsed['to']);
	if(!$u){
		echo 'User not found.';
		return;
	}

	$maxReputation = 0;

	if($parsed['spf']){
		$result = $db->getDomainReputation($parsed['spf'], 'spf');
		if($result){
			$maxReputation = $result[0]['reputation'];
		}
	}

	if($parsed['dkim']){
		$result = $db->getDomainReputation($parsed['dkim'], 'dkim');
		if($result && $result[0]['reputation'] > $maxReputation){
			$maxReputation = $result[0]['reputation'];
		}
	}

	echo "$maxReputation > " . $u['spam_threshold'] . " <br>";

	if($maxReputation > $u['spam_threshold']){
		echo 'Domain is good';
	}
	else {
		echo 'Domain is bad';
	}

?>
