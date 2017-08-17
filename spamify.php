<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "inc/db.php";
	include "inc/email.php";

	const SPAM_DIRECTION = true;

	if(!isset($_GET["mid"])){
		echo "Message ID ('mid') as GET variable";
		return;
	}

	$mid = (int) $_GET["mid"];

	$message = $db->getEmailByID($mid);

	if(!$message){
		echo 'Message not found';
		return;
	}

	if($message['isSpam']){
		echo 'Message already marked as spam.';
		return;
	}

	$reputation = $db->getDomainReputation($message['Domain'], $message['AuthType']);

	$spamAction = $db->getUserSpamAction($message['UserID'], $message['MessageID']);

	if(!$spamAction){
		$db->addUserSpamAction($message['UserID'], $message['MessageID'], SPAM_DIRECTION);
		$isBeingFlipped = false;
	}
	else{
		$db->setUserSpamAction($message['UserID'], $message['MessageID'], SPAM_DIRECTION);
		$isBeingFlipped = true;
	}

	$newReputation = $emailHandler->calculateReputation($reputation[0], SPAM_DIRECTION, $isBeingFlipped);

	$db->updateDomainReputation($newReputation);

	$db->updateMessageSpamStatus($message['MessageID'], SPAM_DIRECTION);

	echo "Message has been marked as spam.";

?>
