<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "inc/db.php";
	include "inc/email.php";

	$result = $db->getDomainReputation("google.com");
	// echo $result[0]['domain'];

	$emailHeader = file_get_contents('./email_header.txt');

	$parsed = $emailHandler->doParse($emailHeader);
	var_dump($parsed);
?>
