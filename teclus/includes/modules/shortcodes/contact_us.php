<?php 
ob_start();
?>
<!--Contact Style One-->
<section class="contact-style-one outside-hidden">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Left Column-->
            <div class="col-md-10 col-sm-12 col-xs-12 left-column">
                <h2><?php echo balanceTags($title); ?></h2>
                
                <div class="row clearfix">
                    <!--Column-->
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        
                        <ul class="info-box">
                            <li><span class="icon flaticon-pin-4"></span> <?php echo balanceTags($address); ?></li>
                            <li><span class="icon flaticon-technology-3"></span> <?php echo esc_html_e('Phone: ', 'teclus'); ?><?php echo balanceTags($phone_no); ?></li>
                            <li><span class="icon flaticon-interface-7"></span> <?php echo esc_html_e('E-mail: ', 'teclus'); ?><?php echo balanceTags($email); ?></li>
                        </ul>
                        
                        <div class="content-box"><?php echo balanceTags($text); ?></div>
                        
                    </div>
                    
                    <!--Column-->
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        
                        <div class="form-container">
                            <?php echo do_shortcode(bunch_base_decode($contact_form_two));?>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
            <!--Map Column-->
            <div class="col-md-2 col-sm-12 col-xs-12 map-column" id="map-container"></div>
            
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