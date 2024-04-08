<?php
///************Sidebar Widgets

/// Recent Posts 
class Bunch_Recent_Post_With_Image extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Recent_Post_With_Image', /* Name */esc_html__('Teclus Recent Posts with image','teclus'), array( 'description' => esc_html__('Show the recent posts with images', 'teclus' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget); ?>
		
		<!-- Recent Posts -->
        <div class="recent-posts wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
            <?php echo balanceTags($before_title.$title.$after_title); ?>
            
            <?php $query_string = 'posts_per_page='.$instance['number'];
					if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
					query_posts( $query_string ); 
					
					$this->posts();
					wp_reset_query();
			?>
            
        </div>
		 
		<?php echo balanceTags($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Latest News', 'teclus');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'teclus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'teclus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'teclus'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'teclus'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts()
	{
		
		if( have_posts() ):?>
        
           	<!-- Title -->
				<?php while( have_posts() ): the_post(); ?>
                    
                    <div class="post">
						<div class="post-thumb"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('teclus_71x66');?></a></div>
						<h4><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php echo balanceTags(teclus_trim(get_the_title(), 6));?></a></h4>
						<div class="post-info"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php echo get_the_date('F d, Y');?></a>  / &nbsp;<a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments');?>"><span class="fa fa-comments"></span> &nbsp; <?php comments_number('0', '1', '%');?></a></div>
					</div>
				<?php endwhile; ?>
                
        <?php endif;
    }
}

// Flicker Gallery
class Bunch_Flickr_Feed extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Flickr_Feed', /* Name */esc_html__('Teclus Flickr Feed','teclus'), array( 'description' => esc_html__('Fetch the latest feed from Flickr', 'teclus' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		wp_enqueue_script( array( 'constructpress_jflicker' ) );
		
		$flickr_id = $instance['flickr_id'];
		$number = $instance['number'];
		
		echo balanceTags($before_widget);

		echo balanceTags($before_title.$title.$after_title);
		
		
		$limit = ( $number ) ? $number : 6;?>
        
        	<!-- Recent From Gallery -->
            <div class="recent-gallery flickr_photos">
                
                <div class="clearfix">
                
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            jQuery('.flickr_photos').jflickrfeed({
                                limit: <?php echo esc_js($limit);?> ,
                                qstrings: {id: '<?php echo esc_js($flickr_id); ?>'},
                                itemTemplate: '<figure class="image"><a href="{{link}}" title="{{title}}"><img src="{{image_s}}" alt="{{title}}" /></a></figure>'
                            });
                        });
                   </script>
                
                </div>
                
            </div>
            <?php
			
		echo balanceTags($after_widget);
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);

		$instance['flickr_id'] = $new_instance['flickr_id'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Flicker Gallery', 'teclus');
		$flickr_id = ($instance) ? esc_attr($instance['flickr_id']) : '52617155@N08';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;?>
		  
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php esc_html_e('Title:', 'teclus');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" type="text" value="<?php echo balanceTags($title);?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('flickr_id'));?>"><?php esc_html_e('Flickr ID:', 'teclus');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_id'));?>" name="<?php echo esc_attr($this->get_field_name('flickr_id'));?>" type="text" value="<?php echo balanceTags($flickr_id);?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number'));?>"><?php esc_html_e('Number of Images:', 'teclus');?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number'));?>" name="<?php echo esc_attr($this->get_field_name('number'));?>" type="text" value="<?php echo balanceTags($number);?>" />
        </p>
        <?php 
	}
}

///************Footer Widgets

//Teclus About
class Bunch_About_Us extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_About_Us', /* Name */esc_html__('Teclus About Us','teclus'), array( 'description' => esc_html__('Show the information about Teclus company', 'teclus' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);?>
      		
			<div class="about-widget">
                <?php echo balanceTags($before_title.$title.$after_title); ?>
                <div class="text">
                    <?php echo balanceTags($instance['content']); ?>
                </div>
                
                <?php if( $instance['show'] ): ?>
                <div class="social-links">
                    <?php echo balanceTags(teclus_bunch_get_social_icons()); ?>
                </div>
				<?php endif;?>
                
            </div>
			
		<?php
		
		echo balanceTags($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] =$new_instance['title'];
		$instance['content'] = $new_instance['content'];
		$instance['show'] = $new_instance['show'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$show = ( $instance ) ? esc_attr($instance['show']) : '';?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'teclus'); ?></label>
            <input placeholder="<?php esc_html_e('Title', 'teclus');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'teclus'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo balanceTags($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php esc_html_e('Show Social Icons:', 'teclus'); ?></label>
			<?php $selected = ( $show ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show')); ?>" type="checkbox" value="true" />
        </p>        
                
		<?php 
	}
	
}

// twitter
class Bunch_Twitter extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Twitter', /* Name */esc_html__('Teclus Tweets','teclus'), array( 'description' => esc_html__('Grab the latest tweets from twitter', 'teclus' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);?>
        
		<!--Footer Column-->
        <div class="twitter-feeds">
			<?php echo balanceTags($before_title.$title.$after_title); ?>
            
            <?php $number = (teclus_set($instance, 'number') ) ? esc_attr(teclus_set($instance, 'number')) : 2; ?>
            <script type="text/javascript"> jQuery(document).ready(function($) {$('#twitter_update').tweets({screen_name: '<?php echo esc_js($instance['twitter_id']); ?>', number: <?php echo esc_js($number); ?>});});</script>
            <div id="twitter_update" class="feed"></div>
            
        </div>
        
		<?php
		
		echo balanceTags($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['number'] = $new_instance['number'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Twitter Feed', 'teclus');
		$twitter_id = ($instance) ? esc_attr($instance['twitter_id']) : 'wordpress';
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'teclus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>"><?php esc_html_e('Twitter ID:', 'teclus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_id')); ?>" type="text" value="<?php echo esc_attr($twitter_id); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of Tweets:', 'teclus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
        
                
		<?php 
	}
}

/// footer Gallery Posts 
class Bunch_Footer_Gallery_Post extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Footer_Gallery_Post', /* Name */esc_html__('Teclus Footer Gallery Post','teclus'), array( 'description' => esc_html__('Show the gallery Posts', 'teclus' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget); ?>
		
        <div class="footer-widget gallery-widget">
            <?php echo balanceTags($before_title.$title.$after_title); ?>
            <div class="thumbs-outer clearfix">
                <?php $query_string = 'posts_per_page='.$instance['number'];
					if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
					query_posts( $query_string ); 
					
					$this->posts();
					wp_reset_query();
				?>
                
              </div>
        </div>
		 
		<?php echo balanceTags($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Our Gallery', 'teclus');
		$number = ( $instance ) ? esc_attr($instance['number']) : 8;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
		    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'teclus'); ?></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'teclus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'teclus'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'teclus'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts()
	{
		
		if( have_posts() ):?>
        	<?php while( have_posts() ): the_post(); 
				global $post;
			?>
            <?php 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		    ?>
                <figure class="image">
                	<?php the_post_thumbnail('teclus_71x66', array('class' => 'img-responsive'));?>
                    <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image"><span class="fa fa-search"></span></a>
                </figure>
				
                
            <?php endwhile; ?>
        <?php endif;
    }
}