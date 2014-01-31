<?php
	define("HOST", "localhost");
	define("DATABASE", "razzed_ziektekaart");
	define("USER", "razzed_dbweb");
	define("PASSWORD", "grethedoornbos");
	
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	function getNextAutoIncrement($tabelname){
		$sql = "SHOW TABLE STATUS LIKE '$tabelname'";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		$row = mysqli_fetch_assoc($dbres);
		return $row['Auto_increment'];
	}
?>