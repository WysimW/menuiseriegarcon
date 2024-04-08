<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_history' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['history_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   $data_filtration = array();
   $data_content = array();
   ?>
   
<?php if($query->have_posts()):  ?>
<?php while($query->have_posts()): $query->the_post();
	  global $post ; 
	  $history_meta = _WSH()->get_meta();
	  $active = ($count == 1) ? 'active-btn' : '';
	  $active_tab = ($count == 1) ? ' active-tab ' : '';
	  
	  $data_filtration[get_the_id()] = '<li class="tab-btn '.$active.'" data-tab="#tab-one'.get_the_id().'"><span class="icon flaticon-arrows-1"></span> '.teclus_set($history_meta, 'date').'</li>';
	 									
	  $data_content[get_the_id()] = '<div class="tab '.$active_tab.'" id="tab-one'.get_the_id().'">
										<h2>'.get_the_title($post->ID).'</h2>
										<div class="text">
											<p>'.get_the_content($post->ID).'</p>
										</div>
									</div>';
									
									
?>
<?php $count++; endwhile; endif;
wp_reset_postdata();
ob_start() ;
?>  

<!--Company History Section-->

<section class="company-history outside-hidden">
    <div class="auto-container">
        <!--Section Title-->
        <div class="sec-title padd-left-70 with-style style-left">
            <h2><?php echo balanceTags($title); ?></h2>
            <div class="sec-text padd-left-40"><?php echo balanceTags($text); ?></div>
        </div>
        
        
        <!--Tabs Box / Style Two-->
        <div class="tabs-box tabs-box-two">
            
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                <!--Tab Buttons-->
                <ul class="tab-buttons">
                    <?php foreach($data_filtration as $key => $value):?>
                        <?php echo balanceTags($value);?>
                    <?php endforeach;?>
                </ul>
            </div>
            
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                <!--Tabs Content-->
                <div class="tabs-content">
                    <?php foreach($data_content as $key => $content):?>
                        <?php echo balanceTags($content);?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>