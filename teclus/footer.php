<?php $options = get_option('wp_teclus'.'_theme_options');?>

<!--Footer Separator-->
<div class="footer-seprarator"><div class="auto-container"><hr></div></div>	
<!--Main Footer-->
<footer class="main-footer">
    <?php if(!(teclus_set($options, 'hide_upper_footer'))):?>
    <!--Footer Upper-->        
    <div class="footer-upper">
        
        <?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
            <div class="auto-container">
                <div class="row clearfix">
                    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                </div>
            </div>
        <?php } ?>
        
    </div>
    <?php endif;?>
    <!--Footer Bottom-->
    <?php if(!(teclus_set($options, 'hide_bottom_footer'))):?>
    <div class="footer-bottom">
        <div class="auto-container">
            <!--Logo-->
            <div class="logo text-center"><img src="<?php echo esc_url(teclus_set($options, 'footer_logo'));?>" alt="<?php esc_html_e('Awesome Image', 'teclus');?>"></div>
            <!--Copyright-->
            <div class="copyright text-center"><?php echo balanceTags(teclus_set($options, 'copy_right'));?></div>
        </div>
    </div>
    <?php endif;?>
</footer>
    
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top"><span class="icon flaticon-arrows-14"></span></div>

<!--Search Popup-->
<div id="search-popup" class="search-popup">
	<div class="close-search theme-btn"><span class="fa fa-close"></span></div>
	<div class="popup-inner">
    
    	<div class="search-form">
        	<h3><?php esc_html_e('Recent Search Keywords', 'teclus');?></h3>
            <br>
            
           <?php get_template_part('searchform2'); ?>
            
         </div>
        
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>