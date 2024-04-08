<?php  

ob_start() ;

$options = _WSH()->option();

?>

<!--Sponsors Section-->
    <section class="sponsors-section <?php if($style_two == true) echo 'no-padd-bottom';?>">
    	<div class="auto-container">
        	<div class="outer-box text-center clearfix">
            	<?php if($clients = teclus_set(teclus_set($options, 'clients'), 'clients')):?>
                
                <?php foreach($clients as $key => $value):?>
                <?php if(teclus_set($value, 'tocopy')) continue;?>
                
                <a href="<?php echo esc_url(teclus_set($value, 'client_link'))?>"><img src="<?php echo esc_url(teclus_set($value, 'client_img'));?>" alt="<?php esc_html_e('image', 'teclus');?>" title="<?php echo esc_attr(teclus_set($value, 'title'));?>"></a>
                
				<?php endforeach;?>
				<?php endif;?>
            </div>
        </div>
    </section>
<?php

	$output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>

   