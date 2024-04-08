<?php

$display_style = ($display_style == 'grey') ? 'theme-two' : '';  

ob_start() ;?>
 <?php 

	$post_thumbnail_id = get_post_thumbnail_id($post->ID);

	$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

?>

<!--Featured Image Section-->
<section class="feat-image-section bg-light-grey">
    <div class="auto-container">
        
        <div class="row clearfix">
            <!--Image Column-->
            <div class="col-md-5 col-sm-12 image-column">
                <figure class="image-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <a class="lightbox-image" href="<?php echo esc_url($post_thumbnail_url);?>" title="<?php esc_html_e('Title Here', 'teclus');?>"><img src="<?php echo esc_url(wp_get_attachment_url($image, 'full')); ?>"></a>
                    <div class="overlay-box">
                        <h4><a href="<?php echo esc_url($btn_link);?>"><?php echo balanceTags($overlay_title); ?></a></h4>
                        <div class="desc"><?php echo balanceTags($overlay_text); ?></div>
                        <a href="<?php echo esc_url($post_thumbnail_url);?>" class="zoom-btn lightbox-image" title="<?php esc_html_e('Title Here', 'teclus');?>"><span class="icon flaticon-cross-1"></span></a>
                    </div>
                </figure>
            </div>
            
            <!--Text Column-->
            <div class="col-md-7 col-sm-12 text-column">
                <div class="inner-box">
                    <h2><?php echo balanceTags($title); ?></h2>
                    <div class="text"><?php echo balanceTags($text); ?></div>
                    <div class="text-right"><a href="<?php echo esc_url($btn_link);?>" class="theme-btn styled-line-btn left-lined btn-theme-four"><?php echo balanceTags($btn_text); ?></a></div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>
<?php

$output = ob_get_contents(); 

ob_end_clean(); 

return $output ; ?>

   