<?php 
	$post_thumbnail_id = get_post_thumbnail_id($post->ID);
	$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
?> 

<!--Blog Post-->
<article class="blog-post">
    <div class="post-inner">
        <?php if ( has_post_thumbnail() ):?>
        <div class="image-box">
            <figure><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('teclus_870x326', 'teclus');?></a></figure>
            <div class="overlay-box">
                <div class="links-outer">
                    <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="view lightbox-image"><span class="fa fa-eye"></span></a>
                    <a href="#" class="add-fav"><span class="fa fa-heart-o"></span></a>
                    <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="read"><span class="fa fa-link"></span></a>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="post-header">
            <h2><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title();?></a></h2>
            <ul class="post-info">
                <li><span class="fa fa-clock-o"></span>&ensp; <?php echo get_the_date('d M, Y');?></li>
                <li><span class="fa fa-user"></span>&ensp; <?php esc_html_e('Posted by', 'teclus');?>&ensp;<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author();?></a></li>
                <li><span class="fa fa-server"></span>&ensp; <?php the_category();?></li>
            </ul>
        </div>
        <div class="post-desc">
            <div class="text"><?php the_excerpt();?></div>
            <div class="text-right"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn styled-line-btn left-lined btn-theme-four"><?php esc_html_e('Read More', 'teclus');?></a></div>
        </div>
    </div>
</article>