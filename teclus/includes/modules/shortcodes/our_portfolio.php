<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_gallery' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['gallery_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
	
<!--Gallery Section-->
    <section class="gallery-section bg-light-grey outside-hidden padd-bott-40">
    	<div class="auto-container">
        	<!--Section Title-->
            <div class="sec-title text-center with-style style-right">
            	<h2><?php echo balanceTags($title); ?></h2>
                <div class="sec-text"><?php echo balanceTags($text); ?></div>
            </div>
            
            
            <div class="row clearfix">
            
            	<?php while($query->have_posts()): $query->the_post();
					global $post ; 
					$services_meta = _WSH()->get_meta();
					//teclus_printr($services_meta); exit("sdsds");
                ?>
                
                <?php 

					$post_thumbnail_id = get_post_thumbnail_id($post->ID);
	
					$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
	
				?>
                
            	<!--Portfolio Item-->
                <article class="portfolio-item col-md-4 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<figure class="image-box"><a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image" title="<?php esc_html_e('Image Caption Here', 'teclus');?>"><?php the_post_thumbnail('teclus_370x220', array('class' => 'img-responsive'));?></a></figure>
                        <div class="lower-content">
                        	<h3><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h3>
                            <div class="desc"><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit));?></div>
                            <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image zoom-btn" title="<?php esc_html_e('Image caption here', 'teclus');?>"><span class="icon flaticon-shapes-5"></span></a>
                        </div>
                    </div>
                </article>
            	
                <?php endwhile;?>
                
             </div>
            
        </div>
    </section>
<?php endif; ?>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>