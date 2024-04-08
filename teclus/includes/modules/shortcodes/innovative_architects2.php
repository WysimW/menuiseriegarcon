<?php ob_start(); ?>
<!--Two Column Fluid Section-->

<div class="column popped-column">
    <div class="inner-box">
        <div class="sec-header">
            <h2><?php echo balanceTags($title); ?></h2>
            <div class="bigger-text"><?php echo balanceTags($text); ?></div>
        </div>
        
        <!--Two Col Box-->
        <div class="two-col-box">
            <div class="row clearfix">
                <?php echo do_shortcode( $contents );?>
            </div>
        </div>
    </div>
</div>
<?php return ob_get_clean(); ?>