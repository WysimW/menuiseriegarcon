<?php $options = _WSH()->option();
	bunch_global_variable();
	$icon_href = (teclus_set( $options, 'site_favicon' )) ? teclus_set( $options, 'site_favicon' ) : get_template_directory_uri().'/images/favicon.png';
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		 <!-- Basic -->
	    <meta charset="<?php bloginfo( 'charset' ); ?>">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<!-- Favcon -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):?>
			<link rel="shortcut icon" type="image/png" href="<?php echo esc_url($icon_href);?>">
		<?php endif;?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<div class="page-wrapper">
	<?php if(teclus_set($options, 'preloader')):?> 	
		<!-- Preloader -->
		<div class="preloader"></div>
	<?php endif;?>
	<!-- Main Header-->
    <header class="main-header">
        
        <!-- Header Container -->
        <div class="header-container">
            	
                <!--Outer Box-->
                <div class="outer-box clearfix">
                
                    <!-- Logo -->
                    <div class="logo">
                    	
                        <?php if(teclus_set($options, 'logo_image')):?>
	                    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(teclus_set($options, 'logo_image'));?>" alt="<?php esc_html_e('image', 'teclus');?>"></a>
						<?php else:?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_template_directory_uri().'/images/logo.png');?>" alt="<?php esc_html_e('image', 'teclus');?>"></a>
						<?php endif;?>
                        
                     </div>
                    
                    <!--Search Btn-->
                    <div class="search-box-btn"><span class="icon fa fa-search"></span></div>
                    
                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                        <button class="hidden-bar-opener"><span class="icon fa fa-bars"></span></button>
                    </div><!-- / Hidden Nav Toggler -->
                    
                    
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        
                        <div class="navbar-header">
                            <!-- Toggle Button -->    	
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation">
                                <?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
											'container_class'=>'navbar-collapse collapse navbar-right',
											'menu_class'=>'nav navbar-nav',
											'fallback_cb'=>false, 
											'items_wrap' => '%3$s', 
											'container'=>false,
											'walker'=> new Bunch_Bootstrap_walker()  
								) ); ?>
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                    
                </div>
        </div><!-- Header Container End-->
        
    </header><!--End Main Header -->
    
    
    <!-- Hidden Bar -->
    <section class="hidden-bar right-align">
        
        <div class="hidden-bar-closer">
            <button class="btn"><i class="fa fa-close"></i></button>
        </div>
    	<!-- Hidden Bar Wrapper -->
        <div class="hidden-bar-wrapper">
        
        	<!-- .logo -->
            <div class="logo text-center">
            	<?php if(teclus_set($options, 'side_logo_image')):?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(teclus_set($options, 'side_logo_image'));?>" alt="<?php esc_html_e('image', 'teclus');?>"></a>
                <?php else:?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_template_directory_uri().'/images/logo-2.png');?>" alt="<?php esc_html_e('image', 'teclus');?>"></a>
                <?php endif;?>
            </div><!-- /.logo -->
        	
            <!-- .Side-menu -->
            <div class="side-menu">
            <!-- .navigation -->
                <ul class="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'sidebar_menu', 'container_id' => 'navbar-collapse-1',
								'container_class'=>'navbar-collapse collapse navbar-right',
								'menu_class'=>'nav navbar-nav',
								'fallback_cb'=>false, 
								'items_wrap' => '%3$s', 
								'container'=>false,
								'walker'=> new Bunch_Bootstrap_walker()  
					) ); ?>
                </ul><!-- /.navigation -->
            </div><!-- /.Side-menu -->
        	<?php if(teclus_set($options, 'show_shocial_icons')):?>
            	<?php if($socials = teclus_set(teclus_set($options, 'social_media'), 'social_media')): //teclus_printr($socials);?>
            <div class="social-icons">
                <ul>
                	<?php foreach($socials as $key => $value):
						if(teclus_set($value, 'tocopy')) continue;
					?>
                    <li><a href="<?php echo esc_url(teclus_set($value, 'social_link'));?>"><i class="fa <?php echo esc_attr(teclus_set($value, 'social_icon'));?>"></i></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>
        	<?php endif;?>
        </div><!-- / Hidden Bar Wrapper -->
    </section><!-- / Hidden Bar -->	