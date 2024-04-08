<?php 
ob_start();
?>
<!--Contact Section-->
    <section class="contact-section scroll-to-this">
    	<div class="auto-container">
        	<!--Section Title-->
            <div class="sec-title padd-left-70 with-style style-left">
            	<h2><?php echo balanceTags($title); ?></h2>
                <div class="sec-text padd-left-40"><?php echo balanceTags($text); ?></div>
            </div>
            
            <!-- Location Map -->
            <div class="our-location-map" id="map-container">&ensp;</div>
            
            <!-- Contact Form -->
            <div class="contact-us">
                
                <div class="form-container">
                    <?php echo do_shortcode(bunch_base_decode($contact_form_three));?>
                </div>
        	</div>  
        	
        </div>
    </section>

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
			  content: ''
			}
		 
		});
	}
	
</script>
<?php return ob_get_clean();?>		