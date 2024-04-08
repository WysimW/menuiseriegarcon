<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
	<div class="form-group">
		<fieldset>
			<input type="search" class="form-control" name="s" value="" placeholder="<?php esc_html_e('Search Here required', 'teclus');?>"  >
			<input type="submit" value="<?php esc_html_e('Search Now!', 'teclus');?>" class="theme-btn">
		</fieldset>
	</div>
</form>