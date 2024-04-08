<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['team_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>
<!--Team Section-->
<section class="team-section outside-hidden">
    <div class="auto-container">
    
        <!--Section Title-->
        <div class="sec-title padd-left-70 with-style style-left">
            <h2><?php echo balanceTags($title); ?></h2>
            <div class="sec-text padd-left-40"><?php echo balanceTags($text); ?></div>
        </div>
        
        <div class="row clearfix">
            <?php while($query->have_posts()): $query->the_post();
				global $post ; 
				$teams_meta = _WSH()->get_meta();
			?>
            <!--Column-->
            <article class="column team-member col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="inner-box hvr-float">
                    <figure class="image"><a href="#"><?php the_post_thumbnail('teclus_260x232');?></a></figure>
                    <div class="member-info">
                        <h3><?php the_title(); ?></h3>
                        <div class="designation"><?php echo balanceTags(teclus_set($teams_meta, 'designation'));?></div>
                        
                        <?php if($socials = teclus_set($teams_meta, 'bunch_team_social')):?>
                        <div class="social-links">
                            <?php foreach($socials as $key => $value):?>
                            	<a href="<?php echo esc_url(teclus_set($value, 'social_link'));?>"><span class="fa <?php echo esc_attr(teclus_set($value, 'social_icon'));?>"></span></a>
                            <?php endforeach;?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </article>
            
            <?php endwhile;?>
        </div>
        
        <div class="text-center"><a href="<?php echo esc_url($btn_link);?>" class="theme-btn btn-theme-four"><?php echo balanceTags($btn_text); ?></a></div>
    </div>
</section>
 
 
<?php endif; ?>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>