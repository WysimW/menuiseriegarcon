<?php

ob_start() ;?>
    <!--Services Column-->
    <div class="column services-column">
        <div class="inner-box">
            <h3><?php echo balanceTags($title); ?></h3>
            <ul class="styled-list-one old-standard-font">
                <?php $fearures = explode("\n",$feature_str);?>
                    <?php foreach($fearures as $feature):?>
                    <li><?php echo balanceTags($feature);?></li>
                <?php endforeach;?>
            </ul>
            
            <a href="<?php echo esc_url($btn_link);?>" class="get-serv-btn theme-btn btn-theme-three"><?php echo balanceTags($btn_text); ?></a>
        </div>
    </div>
<?php

$output = ob_get_contents(); 
ob_end_clean(); 
return $output ; ?>

   