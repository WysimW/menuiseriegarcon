<?php ob_start(); ?>

<!--Default Section-->
<section class="default-section padd-top-40 outside-hidden">
    <div class="auto-container">
    
        <!--Section Title-->
        <div class="sec-title text-right padd-right-70 with-style style-right">
            <h2><?php echo balanceTags($title); ?></h2>
            <div class="sec-text padd-right-40"><?php echo balanceTags($sub_title); ?></div>
        </div>
        
        <div class="row clearfix">
            
            <!--Column-->
            <div class="fact-counter column col-md-6 col-sm-12">
                <div class="row clearfix">
                    <!--Column-->
                    <?php echo do_shortcode( $contents );?>
                </div>
            </div>
            
            <!--Column-->
            <div class="column text-column col-md-6 col-sm-12">
                <div class="text padd-left-20 text-right">
                    <p><?php echo balanceTags($text); ?></p>
                </div>
            </div>
        
        </div>
        
    </div>
</section>
<?php return ob_get_clean(); ?>