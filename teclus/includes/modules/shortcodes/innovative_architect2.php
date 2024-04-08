<?php ob_start(); ?>
<!--Boxed Icon Column-->
<article class="boxed-icon-column col-md-6 col-sm-6 col-xs-12">
    <div class="box-inner text-center">
        <div class="icon-box">
            <div class="icon"><span class="<?php echo esc_attr(str_replace("icon ", "", $icon));?>"></span></div>
            <h3><?php echo balanceTags($title); ?></h3>
        </div>
        <div class="text"><?php echo balanceTags($text); ?></div>
    </div>
</article>
<?php return ob_get_clean(); 