<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['services_category'] = $cat;  
   $query = new WP_Query($query_args) ;
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
	
    
<!--Default Section / Services Section-->
    <section class="default-section services-section outside-hidden">
    	<div class="auto-container">
        
        	<!--Section Title-->
            <div class="sec-title padd-left-70 with-style style-left">
            	<h2><?php echo balanceTags($title); ?></h2>
                <div class="sec-text padd-left-40"><?php echo balanceTags($text); ?></div>
            </div>
            
            <div class="row clearfix">
            	<?php while($query->have_posts()): $query->the_post();
					global $post ; 
					$services_meta = _WSH()->get_meta();
					//teclus_printr($services_meta); exit("sdsds");
                ?>
                <!--Icon Column-->
                <article class="column icon-column col-md-4 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="icon-box"><span class="icon <?php echo str_replace("icon ", "", teclus_set($services_meta, 'fontawesome'));?>"></span></div>
                        <h3><?php the_title(); ?></h3>
                        <div class="text"><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit)); ?></div>
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