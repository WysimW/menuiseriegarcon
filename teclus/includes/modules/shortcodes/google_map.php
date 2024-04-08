<?php   
ob_start();
?>
<!-- Location Map -->
    <div class="our-location-map no-margin-bottom" id="map-container">&ensp;</div>

	
<script type="text/javascript">
	// Google Map Settings
	if(jQuery('#map-container').length){
		var map;
		 map = new GMaps({
			el: '#map-container',
			zoom: 14,
			scrollwheel:false,
			//Set Latitude and Longitude Here
			lat: <?php echo esc_js($lat);?>,
			lng: <?php echo esc_js($long);?>
		  });
		  
		  //Add map Marker
		  map.addMarker({
			lat: <?php echo esc_js($mark_lat);?>,
			lng: <?php echo esc_js($mark_long);?>,
			infoWindow: {
			  content: '<p style="text-align:center;"><strong><?php echo esc_js($mark_title);?></strong><br><?php echo esc_js($mark_address);?></p>'
			}
		 
		});
	}
	
</script>
<?php return ob_get_clean();?>		