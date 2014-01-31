<?php
	require_once('connect.php');
	
	if(isset($_GET['id'])){
	echo '<div class="status">';
	
		// show desease info
		$sql = "
		SELECT * FROM deseases 
		JOIN users 
		ON desease_creator = user_id 
		WHERE desease_id = '".$mysqli->real_escape_string($_GET['id'])."'
		";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		if($dbres->num_rows > 0){
			while($row = $dbres->fetch_assoc()){
				// voeg hier nog naam en datum toe
				echo '<div style="font-size:30px;">Status:</div>';
				echo '<div class="comment_text">' . stripslashes($row['user_firstname']) . ':</br>'. stripslashes($row['desease_text']) .  
				'<div class="comment_date">' 
				.stripslashes($row['desease_created']) . '</div>' . '</div>' .'<br>';
			}
		}
		// comment box with button
		echo '<div style="font-size:18px;">Comment!:</div>';
		echo '<textarea name="comment_text" id="comment_text" cols="35" rows="5"></textarea>';
		echo '<input name="comment" type="button" value="Comment!" onClick="addComment(\''.$_GET['id'].'\')">';
		echo '</div>';

		
		echo '<div class="comments">';
		
		// show comments
		echo '<div style="font-size:30px;">Comments:</div>';
		$sql = "
		SELECT * FROM comments 
		JOIN users 
		ON comment_creator = user_id 
		WHERE comment_desease = '".$mysqli->real_escape_string($_GET['id'])."' 
		ORDER BY comment_id DESC
		";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		if($dbres->num_rows > 0){
			while($row = $dbres->fetch_assoc()){
				echo '<div class="comment_text">' . stripslashes($row['user_firstname']) . ':</br>'. stripslashes($row['comment_text']) .  
				'<div class="comment_date">' 
				.stripslashes($row['comment_created']) . '</div>' . '</div>' .'<br>';
			}
		}
		echo '</div>';
		
		

		
	}
?>