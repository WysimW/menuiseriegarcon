<?php
ob_start() ;?>
	<!--Popped Column-->
    <div class="column popped-column">
        <div class="inner-box">
            <h2><?php echo balanceTags($title); ?></h2>
            <div class="bigger-text"><?php echo balanceTags($sub_title); ?></div>
            <div class="text">
                <p><?php echo balanceTags($text); ?></p>
                <p><?php echo balanceTags($text2); ?></p>
                <br>
            </div>
        </div>
    </div>
<?php

$output = ob_get_contents(); 

ob_end_clean(); 

return $output ; ?>

   