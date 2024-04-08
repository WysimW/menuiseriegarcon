<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   $data_filtration = array();
   $data_content = array();
   ?>
   
<?php if($query->have_posts()):  ?>
<?php while($query->have_posts()): $query->the_post();
	  global $post ; 
	  $services_meta = _WSH()->get_meta();
	  $active = ($count == 1) ? 'active-btn' : '';
	  $active_tab = ($count == 1) ? ' active-tab ' : '';
	  
	  $data_filtration[get_the_id()] = '<li class="tab-btn '.$active.'" data-tab="#tab-one'.get_the_id().'"><div class="main-title">'.get_the_title($post->ID).'</div><div class="sub-title">'.teclus_set($services_meta, 'detail').'</div></li>';
	 									
	  $data_content[get_the_id()] = '<div class="tab '.$active_tab.'" id="tab-one'.get_the_id().'">
										<div class="row clearfix">
											<div class="col-md-5 col-sm-12 column">
												<figure class="styled-box image-box">'.get_the_post_thumbnail($post->ID).'</figure>
											</div>
											
											<!--Column-->
											<div class="col-md-7 col-sm-12 column">
												<h2>'.teclus_set($services_meta, 'sub_title').'</h2>
												<div class="text">
													'.$post->post_content.'
													
													<div class="text-right"><a href="'.esc_url(teclus_set($services_meta, 'ext_url')).'" class="theme-btn styled-line-btn left-lined btn-theme-four">'.teclus_set($services_meta, 'btn_text').'</a></div>
												</div>
											</div>
										</div>

									 </div>';
									
									
?>
<?php $count++; endwhile; endif;
wp_reset_postdata();
ob_start() ;
?>  
<!--What We Do Section-->
<section class="what-we-do outside-hidden">
    <div class="auto-container">
        <!--Section Title-->
        <div class="sec-title padd-left-70 with-style style-left">
            <h2><?php echo balanceTags($title); ?></h2>
            <div class="sec-text padd-left-40"><?php echo balanceTags($text); ?></div>
        </div>
        
        
        <!--Tabs Box / Style One-->
        <div class="tabs-box tabs-box-one">
            
            <!--Tab Buttons-->
            <ul class="tab-buttons">
                <?php foreach($data_filtration as $key => $value):?>
						<?php echo balanceTags($value);?>
                    <?php endforeach;?>
            </ul>
            
            <!--Tabs Content-->
            <div class="tabs-content">
            	<!--Tab / Active Tab-->
                <?php foreach($data_content as $key => $content):?>
					<?php echo balanceTags($content);?>
               <?php endforeach;?>
              </div>
            
        </div>
        
    </div>
</section>

<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>