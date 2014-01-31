<?php
	// Start session
	ob_start();
	session_start();
	require_once('inc/php/connect.php');
	// Check if cookie exists
	if(isset($_GET['a'])){
		setcookie('ue', '', time());
		setcookie('up', '', time());
		header("Location: index.php");
		exit();
	}
	// Check login
	function checkLogin(){
		global $mysqli;
		$sql = "SELECT * FROM users WHERE user_email = '".$mysqli->real_escape_string($_COOKIE['ue'])."' AND user_password = '".$mysqli->real_escape_string($_COOKIE['up'])."'";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		if($dbres->num_rows == 1){
			while($row = $dbres->fetch_assoc()){
				setcookie('ue', $row['user_email'], time() + 604800);
				setcookie('up', $row['user_password'], time() + 604800);
				return true;
			}
		}else{
			return false;
		}
	}
	
	if(checkLogin()){
		$sql = "SELECT * FROM users WHERE user_email = '".$mysqli->real_escape_string($_COOKIE['ue'])."'";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		if($dbres->num_rows > 0){
			while($row = $dbres->fetch_assoc()){
				// fill in some global vars
				$user_id = $row['user_id'];
			}
		}
	}
		
	
	if(isset($_POST['login'])){
		$sql = "SELECT * FROM users WHERE user_email = '".$mysqli->real_escape_string($_POST['login_email'])."' AND user_password = '".$mysqli->real_escape_string(sha1($_POST['login_password']))."'";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}
		if($dbres->num_rows == 1){
			while($row = $dbres->fetch_assoc()){
				setcookie('ue', $row['user_email'], time() + 604800);
				setcookie('up', $row['user_password'], time() + 604800);
				header("Location: index.php");
			}
		}
	}
	// Show registration form
	if(isset($_POST['register'])){
		$sql = "
			INSERT INTO
				users
			SET
				user_email			=	'".$mysqli->real_escape_string($_POST['user_email'])."',
				user_password		=	'".$mysqli->real_escape_string(sha1($_POST['user_password']))."',
				user_firstname	=	'".$mysqli->real_escape_string($_POST['user_firstname'])."',
				user_lastname		=	'".$mysqli->real_escape_string($_POST['user_lastname'])."',
				user_dob				=	'".$mysqli->real_escape_string($_POST['user_dob'])."',
				user_gender			=	'".$mysqli->real_escape_string($_POST['user_gender'])."',
				user_created		=	NOW()
		";
		if(!$dbres = $mysqli->query($sql)){
			die('There was an error running the query ['.$mysqli->error.']');
		}else{
			setcookie('ue', $_POST['user_email'], time() + 604800);  	// If registration is a succes redirect back to start
			setcookie('up', $_POST['user_password'], time() + 604800);
			header("Location: index.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Diseases map</title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
<style type="text/css">
html {
	width: 100%;
	height: 100%;
	margin: 0;
	padding: 0;
	}
body {
	width: 100%;
	height: 100%;
	margin: 0;
	padding: 0;
	font-family: 'Roboto Condensed', sans-serif;
	color:#fff;
	}
input[type=button] {
    border: 0;    
	background: #00b1ea;
	height:35px;
	padding:3px;
	font-size:18px;
	color:#fff;
	font-family: 'Roboto Condensed', sans-serif;
}
input[type=submit] {
    border: 0;    
	background: #00b1ea;
	height:35px;
	padding:3px;
	font-size:18px;
	color:#fff;
	font-family: 'Roboto Condensed', sans-serif;
}
	body a:link, a:visited, a:hover, a:active{
		text-decoration:none;
		color:#fff;
	}
	.login {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0px;
		left: 0px;
		background-image:url(img/blue.png);
		background-repeat:repeat;
		color: #fff;
		z-index: 100;
		<?php 
			if(checkLogin()){
				echo 'display: none;';
			}
		?>
	}
	#map {
		width: 100%;
		height: 100%;
	}
	.overlay {
		width: 20%;
		height: 100%;
		position: absolute;
		bottom: 0px;
		right: 0px;
		background-color:#ccc;
		overflow-y: scroll;
		
	}
	.register {
		display:none;
		background-color:#333;
		width: auto;
		padding:10px;
		height:320px;
		position:absolute;
		border-radius:5px;
		left:40%;
		top:20%;
	}
	.status {
		padding:10px;
		background-color:#666;
	}
	.comments {
		padding:10px;
		background-color:#999;
	}
	.welcome_text {
		font-size:36px;
	}
	.comment_date{
		font-size:10px;
		color:#09F;
	}
	.desease_text {
		font-size: 16px;
		font-weight: bold;
	}
	.comment_text {
		font-size: 16px;
		font-weight: bold;
		background-color:#ccc;
		padding:10px;
	}
	.comment_box {
		display:none;
	}
	.addDesease {
		display: none;
	}
	.deasesAdded {
		display: none;
	}
	.myDeseases {
		display: none;
	}
	.info {
		background-color:#333;
		padding:10px;
	}
	.form_login {
		background-color:#333;
		width: auto;
		height:200px;
		position:absolute;
		border-radius:5px;
		left:40%;
		top:20%;
	}
</style>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="inc/js/markerclusterer_compiled.js"></script>
<!-- Connect to Google and get map with all pointers(diseases) -->
<script type="text/javascript">	
var map;
	
	function initialize() {
		var center = new google.maps.LatLng(50, 6.3);

		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 5,
			center: center,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var markers = [];
		var deseases = [];
		
		<?php
			$sql = "SELECT * FROM deseases";
			if(!$dbres = $mysqli->query($sql)){
				die('There was an error running the query ['.$mysqli->error.']');
			}
			if($dbres->num_rows > 0){
				while($row = $dbres->fetch_assoc()){
					echo 'var desease = new google.maps.Marker({position: new google.maps.LatLng("'.$row['desease_lat'].'", "'.$row['desease_lng'].'"), _id: "'.$row['desease_id'].'"});'. "\n";
					echo 'deseases.push(desease);'. "\n";
				}
			}
		?>
		
		for(var i = 0; i < deseases.length; i++){
			var marker = deseases[i];
			markers.push(marker);
			google.maps.event.addListener(marker, 'click', function(e){
				showDeseaseInfo(this._id);
			});
		}		
		
		var markerCluster = new MarkerClusterer(map, markers);		
		
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	
	function addDesease(){
		$('.addDesease').slideToggle('slow');
		$('#addDeseaseBtn').hide();
		$('.deasesAdded').hide();
		geolocate();
	}
	
	function geolocate(){
		// Try HTML5 geolocation
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = new google.maps.LatLng(position.coords.latitude,
																				 position.coords.longitude);
	
				
				var marker = new google.maps.Marker({
						map: map,
						position: pos,
						draggable: true,
						icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
				});
								
				updateLatLng(marker.getPosition());
				
				google.maps.event.addListener(marker, "dragend", function() {
					updateLatLng(marker.getPosition());
				});
	
				map.setCenter(pos);
			}, function() {
				handleNoGeolocation(true);
			});
		} else {
			// Browser doesn't support Geolocation
			handleNoGeolocation(false);
		}
	}
	
	function handleNoGeolocation(errorFlag) {
		if (errorFlag) {
			var content = 'Error: The Geolocation service failed.';
		} else {
			var content = 'Error: Your browser doesn\'t support geolocation.';
		}
		alert(content);
	}
	
	function updateLatLng(pos){
		coordinates = String(pos);
		coordinates = coordinates.replace("(", "");
		coordinates = coordinates.replace(")", "");
		
		var coordinate = coordinates.split(", ");
		
		document.getElementById('desease_lat').value = coordinate[0].substring(0,10);
		document.getElementById('desease_lng').value = coordinate[1].substring(0,10);
	}
	
	function showDeseaseInfo(id){
		$.ajax({
			url: "inc/php/showDeseaseInfo.php",
			data: {id: id}
		})
		.done(function(data){
			$('.deseaseinfo').html(data);
		});
	}
	
	function closeLogin(){
		$('.login').fadeOut();
	}
	
	function addComment(id){
		var comment_text = $('#comment_text').val();
		$.ajax({
			url: "inc/php/addComment.php",
			data: {id: id, comment_text: comment_text, user_id: '<?php echo $user_id; ?>'}
		})
		.done(function(data){
			$('.comments').append(data);
		});
	}
	
	function saveDesease(){
		$.ajax({
			url: "inc/php/addDesease.php",
			data: {
				text: $('#desease_text').val(),
				lat: $('#desease_lat').val(),
				lng: $('#desease_lng').val(),
				start: $('#desease_start').val(),
				tags: $('#desease_tags').val(),
				creator: '<?php echo $user_id; ?>'
			}
		})
		.done(function(data){
			// hide and show some elements
			$('#addDeseaseBtn').show();
			$('.deasesAdded').show();
			
			// reset values of input fields
			$('.addDesease').slideToggle('slow');
			$('#desease_text').val('');
			$('#desease_lat').val('');
			$('#desease_lng').val('');
		});
	}
	
	function cencelDesease(){
		$('.addDesease').slideToggle('slow');
		$('#addDeseaseBtn').show();
		$('.deasesAdded').hide();
	}
	
	function myDeseases(){
		$('.myDeseases').slideToggle('slow');
	}
	$(document).ready(function () {
    $( ".or" ).click(function() {
  $( ".register" ).show( "slow" );
  $( ".or" ).hide( "slow" );
  $( ".form_login" ).hide( "slow" );
  
});
});
</script>
</head>

<body>
	
  <div class="login">
  <div class="form_login">
  	<form name="frmLogin" method="post" action="">
    	<center><h1>Log in</h1></center>
      <table border="0" cellspacing="0" cellpadding="3" align="center">
        <tr>
          <td>E-mailaddress: </td>
          <td><input type="text" name="login_email" id="login_email" /></td>
        </tr>
        <tr>
          <td>Password: </td>
          <td><input type="password" name="login_password" id="user_password" /></td>
        </tr>
        <tr>
          <td colspan="2" align="right"><input type="submit" name="login" id="login" value="Log in" /></td>
        </tr>
      </table>
    </form>
    
    <center><p class="or">register - <a href="javascript:closeLogin()">or continue without logging in...</a></p></center>
 	</div>
    <br />
    <br />
    <div class="register">
    <form name="frmRegister" method="post" action="">
    	<center><h1>Register</h1></center>
      <table border="0" cellspacing="0" cellpadding="3" align="center">
        <tr>
          <td>First name: </td>
          <td><label for="user_firstname"></label>
            <input type="text" name="user_firstname" id="user_firstname" /></td>
        </tr>
        <tr>
          <td>Last name: </td>
          <td><label for="user_lastname"></label>
            <input type="text" name="user_lastname" id="user_lastname" /></td>
        </tr>
        <tr>
          <td>Date of birth: </td>
          <td><label for="user_dob"></label>
            <input type="text" name="user_dob" id="user_dob" /></td>
        </tr>
        <tr>
          <td>Gender: </td>
          <td>
         	 <label><input type="radio" name="user_gender" id="user_gender" value="m" />m </label>
           <label><input type="radio" name="user_gender" id="user_gender" value="f" />f</label>
          </td>
        </tr>
        <tr>
          <td>E-mailaddress: </td>
          <td>
            <label for="user_email"></label>
            <input type="text" name="user_email" id="user_email" />
          </td>
        </tr>
        <tr>
          <td>Password: </td>
          <td><input type="password" name="user_password" id="user_password" /></td>
        </tr>
        <tr>
          <td colspan="2" align="right"><input type="submit" name="register" id="register" value="Register" /></td>
        </tr>
      </table>
    </form>
    </div>
    <br />
    <br />
  </div>
  
  <div id="map"></div>
  
  <div class="overlay">
    <div class="info">
  	<?php
			if(checkLogin()){
				$sql = "SELECT * FROM users WHERE user_email = '".$mysqli->real_escape_string($_COOKIE['ue'])."'";
				if(!$dbres = $mysqli->query($sql)){
					die('There was an error running the query ['.$mysqli->error.']');
				}
				if($dbres->num_rows > 0){
					while($row = $dbres->fetch_assoc()){
						echo '<div class="welcome_text"> Hi, ' . stripslashes($row['user_firstname']) . '</div><br>';
						echo '<a href="?a=logout">Logout</a><br />';

					}
				}
				echo '<a id="addDeseaseBtn" href="javascript:addDesease();">Add disease</a><br />';
				?>
        <div class="deasesAdded">Your disease has been added to the map. Thank you.</div>
        <div class="addDesease">
        <p> Drag the green marker to your location</span>
        <br/>
        <p>Make sure the pointer is not to close to your location if you like privacy.</p>
          <input name="desease_lat" id="desease_lat" type="hidden" />
          <input name="desease_lng" id="desease_lng" type="hidden" />
          <table border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td valign="top">Text: </td>
              <td><textarea name="desease_text" id="desease_text" cols="20" rows="5"></textarea></td>
            </tr>
            <tr>
              <td>Start: </td>
              <td><input name="desease_start" id="desease_start" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" /></td>
            </tr>
          </table>
          <input name="saveDesease" type="button" onclick="saveDesease()" value="Add" />
          <input name="cencelDesease" type="button" onclick="cencelDesease()" value="Cancel" />
        </div>
        <?php		
				echo '<a href="javascript:myDeseases()">My diseases</a><br />';
				echo '<div class="myDeseases">';
				$sql = "SELECT * FROM deseases WHERE desease_creator = '".$mysqli->real_escape_string($user_id)."' ORDER BY desease_id DESC";
				if(!$dbres = $mysqli->query($sql)){
					die('There was an error running the query ['.$mysqli->error.']');
				}
				if($dbres->num_rows > 0){
					while($row = $dbres->fetch_assoc()){
						echo '<div class="comment_text">' . '<div class="comment_date">' 
				.stripslashes($row['desease_created']) . '</div>' . stripslashes($row['desease_text']) . '</div><br>';
					}
				}
				echo '</div>';
			}else{
				echo '<a href="?a=logout">Register or log in for more options</a><br />';
			}
		?> 
        </div>
    
    <div class="deseaseinfo">
    <span style="margin:10px;"> Click on a marker for more info</span>
    </div>
    </div>
  
</body>
</html>