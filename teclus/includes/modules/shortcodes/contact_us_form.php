<?php
ob_start() ;?>

<!--Contact Section-->
<section class="contact-section scroll-to-this">
    
        
    <div class="auto-container">
        
        <!--Section Title-->
        <div class="sec-title padd-left-70 with-style style-left">
            <h2><?php echo balanceTags($title);?></h2>
            <div class="sec-text padd-left-40"><?php echo balanceTags($text);?></div>
        </div>
        
        <!-- Contact Form -->
        <div class="contact-us">
            
            <div class="form-container">
                <?php echo do_shortcode(bunch_base_decode($contact_form));?>
            </div>
        </div>  
        
    </div>
</section>

<?php
	$output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>
   