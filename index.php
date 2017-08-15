<?php
	$DBH = new PDO("mysql:host=localhost;dbname=proton", "admin", "ronnie");
	$STH = $DBH->query('Show tables');
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_OBJ);

	# showing the results
	while($row = $STH->fetch()) {
	    var_dump($row);
	}
?>
