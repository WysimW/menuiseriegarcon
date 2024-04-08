<?php  
   global $post ;
   $count = 0;
   $paged = get_query_var('paged');
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order, 'paged'=>$paged);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   

<!--Content Side-->	
<div>
    <!--Blog Section-->
    <section class="default-section blog-section no-padd-bottom no-padd-top">
            
        <div class="row clearfix">
            
            <?php while($query->have_posts()): $query->the_post();
				global $post ; 

				$post_meta = _WSH()->get_meta();

			?>
            <!--Column-->
            <div class="col-md-6 col-sm-6 col-xs-12 post-item">
                <article class="inner-box">
                    <figure class="image-box"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('teclus_420x180');?></a></figure>
                    <div class="content">
                        <h3><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h3>
                        <div class="post-info"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_author(); ?></a> / <?php echo get_the_date('d M, Y');?></div>
                        <div class="text"><p><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit)); ?></p></div>
                        <div class="text-left"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn styled-line-btn right-lined btn-theme-four"><?php echo esc_html_e('Read More', 'teclus');?></a></div>
                    </div>
                </article>
            </div>
            <?php endwhile;?>
                
        </div>
    </section>
    
    <!-- Styled Pagination -->
    <div class="styled-pagination text-center margin-top-50">
        <?php teclus_the_pagination(array('total'=>$query->max_num_pages, 'next_text' => '<i class="fa fa-angle-double-right"></i>', 'prev_text' => '<i class="fa fa-angle-double-left"></i>')); ?>
    </div>

</div>
<!--Content Side-->

<?php endif; ?>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>