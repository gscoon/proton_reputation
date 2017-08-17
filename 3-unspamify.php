<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "inc/db.php";
	include "inc/email.php";

	// Indicates which button the user presses
	const SPAM_DIRECTION = false;

	// pass a message ID as a get variable
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

	if(!$message['isSpam']){
		echo 'Message already marked as nonspam.';
		return;
	}

	// pull the domain reputation using the message's domain name and authentication type
	$reputation = $db->getDomainReputation($message['Domain'], $message['AuthType']);

	// pull the user's previous manual spam actions, if they exist
	$spamAction = $db->getUserSpamAction($message['UserID'], $message['MessageID']);

	// either update the entry or insert a new one
	if(!$spamAction){
		$db->addUserSpamAction($message['UserID'], $message['MessageID'], SPAM_DIRECTION);
		$isBeingFlipped = false;
	}
	else{
		$db->setUserSpamAction($message['UserID'], $message['MessageID'], SPAM_DIRECTION);
		$isBeingFlipped = true;
	}

	// calculate the new reputation
	// this need to account for whether the user changed his mind ("flipped") regarding the spam status
	$newReputation = $emailHandler->calculateReputation($reputation[0], SPAM_DIRECTION, $isBeingFlipped);

	// update the domain name reputation counts and scores
	$db->updateDomainReputation($newReputation);

	// update the message's spam status in the Message table
	$db->updateMessageSpamStatus($message['MessageID'], SPAM_DIRECTION);

	echo "Message has been marked as nonspam.";

?>
