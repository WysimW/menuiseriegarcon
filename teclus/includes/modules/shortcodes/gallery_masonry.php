<?php  
   bunch_global_variable();
    $args = array('post_type' => 'bunch_gallery', 'showposts'=>$num, 'orderby'=>$sort, 'order'=>$order,'suppress_filters' => 'false');
    $terms_array = explode(",",$exclude_cats);
    if($exclude_cats) $args['tax_query'] = array(array('taxonomy' => 'gallery_category','field' => 'id','terms' => $terms_array,'operator' => 'NOT IN',));
    //apartvilla_printr($args); exit("sss");
    $query = new WP_Query($args);
    $data_filtration = '';
    $data_posts = '';
   
ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
<!--Gallery Carousel Section-->
    <section class="boxed-masonary masonry-gallery">
        <div class="outer-container">
        
            <div class="items-container clearfix">
                
                <?php while($query->have_posts()): $query->the_post();
                    global $post ; 
                    $gallery_meta = _WSH()->get_meta();
                    //teclus_printr($services_meta); exit("sdsds");
                ?>
                
                <?php 
                    $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                    $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                ?>
                <!--Masonry Item-->
                <article class="masonry-item <?php if(teclus_set($gallery_meta, 'extra_width') == 'extra_width') echo 'two-fifth'; else echo 'one-fifth'?>">
                    <div class="inner-box">
                        <a href="<?php echo esc_url($post_thumbnail_url); ?>" title="Caption Of Image">
                            <figure class="image-box">
                                <?php if(teclus_set($gallery_meta, 'extra_width') == 'extra_width') 
                                        $image_size = 'teclus_468x468'; 
                                      elseif(teclus_set($gallery_meta, 'extra_height') == 'extra_height')
                                        $image_size = 'teclus_468x234'; 
                                      else
                                        $image_size = 'teclus_234x234'; 
                                      
                                      the_post_thumbnail($image_size);
                                ?>
                            </figure>
                        </a>
                        <div class="overlay-box">
                            <h4><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h4>
                            <div class="desc"><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit)); ?></div>
                            <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="zoom-btn"><span class="icon flaticon-cross-1"></span></a>
                        </div>
                    </div>
                </article>
                <?php endwhile;?>
            </div>
            <div class="btn-outer"><button title="<?php esc_html_e('Load More', 'teclus');?>" type="button" class="theme-btn load-more-btn"><span class="icon flaticon-sign"></span></button></div>
            
        </div>
    </section>
<?php endif; ?>
<?php 
    wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>