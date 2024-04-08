<?php ob_start(); ?>

<article class="col-md-4 col-sm-4 col-xs-12 column wow fadeIn" data-wow-duration="0ms">
    <div class="count-outer"><span class="count-text" data-speed="1500" data-stop="<?php echo esc_attr($num);?>"><?php echo balanceTags($start_num);?></span></div>
    <div class="line"></div>
    <h4 class="counter-title"><?php echo balanceTags($title);?></h4>
</article>

<?php return ob_get_clean(); 