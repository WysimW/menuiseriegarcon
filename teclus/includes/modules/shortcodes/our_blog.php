<?php  
   global $post ;
   $count = 0;
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
<!--Latest Blog Section-->
    <section class="latest-blog bg-light-grey outside-hidden">
    	<div class="auto-container">
        	<!--Section Title-->
            <div class="sec-title text-center with-style style-right">
            	<h2><?php echo balanceTags($title); ?></h2>
                <div class="sec-text"><?php echo balanceTags($text); ?></div>
            </div>
            
            <div class="row clearfix">
            	<!--Blog Post-->
                
                <?php while($query->have_posts()): $query->the_post();
					global $post ; 
	
					$post_meta = _WSH()->get_meta();
	
				?>
                <article class="post-item col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                	<div class="inner-box">
                    	<figure class="image-box"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('teclus_285x285');?></a></figure>
                        <div class="content-box">
                        	<h3><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h3>
                            <ul class="post-info">
                            	<li><span class="icon flaticon-time-6"></span><?php echo get_the_date('d M, Y');?></li>
                                <li><span class="icon flaticon-people-1"></span> <?php the_author(); ?></li>
                            </ul>
                            <div class="post-excerpt">
                            	<p><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit));?></p>
                            </div>
                            <div class="text-right more-link"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn read-more"><?php echo esc_html_e('Read More', 'teclus');?></a></div>
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