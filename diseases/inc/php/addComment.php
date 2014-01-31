<?php
	require_once('connect.php');
	
	if(isset($_GET['id']) && isset($_GET['comment_text'])){
		
		// insert comment
		$sql = "
			INSERT INTO
				comments
			SET
				comment_desease = '".$mysqli->real_escape_string($_GET['id'])."',
				comment_text 		= '".$mysqli->real_escape_string(strip_tags($_GET['comment_text']))."',
				comment_created = NOW(),
				comment_creator = '".$mysqli->real_escape_string($_GET['user_id'])."'
		";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		if($dbres->num_rows > 0){
			while($row = $dbres->fetch_assoc()){
				echo '<div class="desease_text">' . stripslashes($row['desease_text']) . '</div>';
			}
		}
		
		// refresh the info inclusing comments
		echo '<script type="text/javascript">';
		echo 'showDeseaseInfo(\''.$_GET['id'].'\');';
		echo '</script>';
	}
?>