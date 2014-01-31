<?php
	require_once('connect.php');
	
	if(isset($_GET['text']) && isset($_GET['lat']) && isset($_GET['lng'])){
		
		// insert comment
		$sql = "
			INSERT INTO
				deseases
			SET
				desease_text 		= '".$mysqli->real_escape_string($_GET['text'])."',
				desease_lat 		= '".$mysqli->real_escape_string($_GET['lat'])."',
				desease_lng 		= '".$mysqli->real_escape_string($_GET['lng'])."',
				desease_start 	= '".$mysqli->real_escape_string($_GET['start'])."',
				desease_creator = '".$mysqli->real_escape_string($_GET['creator'])."',
				desease_created = NOW()
		";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		/*
		$next_id = getNextAutoIncrement('deseases');
		$_GET['tags'];
		
		$sql = "
			INSERT INTO
				deseases
			SET
				desease_text 		= '".$mysqli->real_escape_string($_GET['text'])."',
				desease_lat 		= '".$mysqli->real_escape_string($_GET['lat'])."',
				desease_lng 		= '".$mysqli->real_escape_string($_GET['lng'])."',
				desease_start 	= '".$mysqli->real_escape_string($_GET['start'])."',
				desease_creator = '".$mysqli->real_escape_string($_GET['creator'])."',
				desease_created = NOW()
		";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		*/

	}
?>