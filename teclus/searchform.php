<!-- Search Form -->
<div class="search-box">
    
    <form method="post" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="form-group">
            <input type="search" name="s" value="" placeholder="<?php esc_html_e('search for something', 'teclus');?>">
            <button type="submit"><span class="icon flaticon-arrows-1"></span></button>
        </div>
    </form>
    
</div>