<?php
    
	$servername = "localhost";
	$username = "wtuser";
	$password = "wtpassword";
	$dbname = "wt_spirala4";

	// Create connection
	$db_con = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($db_con->connect_error) {
		die("Connection failed: " . $db_con->connect_error);
	} 
    
	$result = $db_con->query('SELECT * FROM `usluga`');
	if (!$result) die('Couldn\'t fetch records');
	
	$fp = fopen('php://output', 'w');
	if ($fp && $result) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="export.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
			fputcsv($fp, array_values($row));
		}
		die;
	}
	header("Location: ponuda.php");
?>