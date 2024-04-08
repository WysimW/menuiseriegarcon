<?php ob_start(); ?>
<!--Two Column Fluid Section-->
<section class="two-col-fluid outside-hidden">
<div class="outer-box">
	
	<!--Image Column-->
	<div class="image-column" style="background-image:url('<?php echo esc_url(wp_get_attachment_url($img));?>');"></div>
	
	<!--Content Column-->
	<div class="content-column">
		<div class="inner-box">
			<h3><?php echo balanceTags($title);?></h3>
			<!--Progress Levels-->
			<div class="progress-levels">
				<?php echo do_shortcode( $contents );?>
			</div>
		</div>
	</div>
	
</div>
</section>
<?php return ob_get_clean(); ?>