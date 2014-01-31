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