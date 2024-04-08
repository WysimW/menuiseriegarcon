<?php
add_action('after_setup_theme', 'teclus_bunch_theme_setup');
function teclus_bunch_theme_setup()
{
	bunch_global_version_variable();
	
	if(!defined('TECLUS_VERSION')) define('TECLUS_VERSION', '1.0');
	if( !defined( 'TECLUS_ROOT' ) ) define('TECLUS_ROOT', get_template_directory().'/');
	if( !defined( 'TECLUS_URL' ) ) define('TECLUS_URL', get_template_directory_uri().'/');	
	include_once get_template_directory() . '/includes/loader.php';
	
	
	load_theme_textdomain('teclus', get_template_directory() . '/languages');
	
	//ADD THUMBNAIL SUPPORT
	add_theme_support('post-thumbnails');
	add_theme_support('menus'); //Add menu support
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	add_theme_support( "title-tag" );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu' => esc_html__('Main Menu', 'teclus'),
				'sidebar_menu' => esc_html__('Side Menu', 'teclus'),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	add_image_size( 'teclus_370x220', 370, 220, true ); // '370x220 our portfolio'
	add_image_size( 'teclus_285x285', 285, 285, true ); // '285x285 our blog'
	add_image_size( 'teclus_260x232', 260, 232, true ); // '260x232 our Team'
	add_image_size( 'teclus_270x184', 270, 184, true ); // '270x184 our gallery carousel'
	add_image_size( 'teclus_470x420', 470, 420, true ); // '470x420 we do tabs'
	add_image_size( 'teclus_468x468', 468, 468, true ); // '468x468 masonry'
	add_image_size( 'teclus_468x234', 468, 234, true ); // '468x234 masonry'
	add_image_size( 'teclus_234x234', 234, 234, true ); // '234x234 masonry'
	add_image_size( 'teclus_420x180', 420, 180, true ); // '420x180 Blog Two Column'
	add_image_size( 'teclus_370x160', 370, 160, true ); // '370x160 Blog Three Column'
	add_image_size( 'teclus_870x326', 870, 326, true ); // '870x326 Blog Page'
	add_image_size( 'teclus_71x66', 71, 66, true ); // '71x66 recent comment'
}
function teclus_bunch_widget_init()
{
	global $wp_registered_sidebars;
	$theme_options = _WSH()->option();
	if( class_exists( 'Bunch_Recent_Post_With_Image' ) )register_widget( 'Bunch_Recent_Post_With_Image' );
	if( class_exists( 'Bunch_Flickr_Feed' ) )register_widget( 'Bunch_Flickr_Feed' );
	if( class_exists( 'Bunch_About_Us' ) )register_widget( 'Bunch_About_Us' );
	if( class_exists( 'Bunch_Twitter' ) )register_widget( 'Bunch_Twitter' );
	if( class_exists( 'Bunch_Footer_Gallery_Post' ) )register_widget( 'Bunch_Footer_Gallery_Post' );
	
	
	register_sidebar(array(
	  'name' => esc_html__( 'Default Sidebar', 'teclus' ),
	  'id' => 'default-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'teclus' ),
	  'before_widget'=>'<div id="%1$s" class="widget sidebar_widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sidebar-title"><h3>',
	  'after_title' => '</h3></div>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar', 'teclus' ),
	  'id' => 'footer-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', 'teclus' ),
	  'before_widget'=>'<div id="%1$s"  class="col-md-3 col-sm-12 col-xs-12 footer-widget column %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h3>',
	  'after_title' => '</h3>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', 'teclus' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'teclus' ),
	  'before_widget'=>'<div id="%1$s" class="widget sidebar_widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sidebar-title"><h3>',
	  'after_title' => '</h3></div>'
	));
	if( !is_object( _WSH() )  )  return;
	$sidebars = teclus_set(teclus_set( $theme_options, 'dynamic_sidebar' ) , 'dynamic_sidebar' ); 
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		if(teclus_set($sidebar , 'topcopy')) continue ;
		
		$name = teclus_set( $sidebar, 'sidebar_name' );
		
		if( ! $name ) continue;
		$slug = teclus_bunch_slug( $name ) ;
		
		register_sidebar( array(
			'name' => $name,
			'id' =>  $slug ,
			'before_widget' => '<div id="%1$s" class="side-bar widget sidebar_widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<div class="sec-title"><h3 class="skew-lines">',
			'after_title' => '</h3></div>',
		) );		
	}
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}
add_action( 'widgets_init', 'teclus_bunch_widget_init' );
function teclus_load_head_scripts() {
	$options = _WSH()->option();
    if ( !is_admin() ) {
	$protocol = is_ssl() ? 'https://' : 'http://';
	$map_path = '?key='.teclus_set($options, 'map_api_key');
	wp_enqueue_script( 'map_api', ''.$protocol.'maps.google.com/maps/api/js'.$map_path, array(), false, false );
	wp_enqueue_script( 'googlemap', get_template_directory_uri().'/js/googlemaps.js', array(), false, false );
	wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js', array(), false, false );
	wp_enqueue_script( 'respond-min', get_template_directory_uri().'/js/respond.min.js', array(), false, false );
    }
    }
    add_action( 'wp_enqueue_scripts', 'teclus_load_head_scripts' );
//global variables
function bunch_global_variable() {
    global $wp_query;
}
//global variables
function bunch_global_version_variable() {
    global $wp_version;
}
/*-------------------------------------------------------------*/

function teclus_enqueue_scripts() {
    //styles
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'fontawesom', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/css/flaticon.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl.css' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_style( 'customscroll', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.min.css' );
	wp_enqueue_style( 'hover', get_template_directory_uri() . '/css/hover.css' );
	wp_enqueue_style( 'teclus_main-style', get_stylesheet_uri() );
	wp_enqueue_style( 'teclus_responsive', get_template_directory_uri() . '/css/responsive.css' );
	wp_enqueue_style( 'teclus_custom-style', get_template_directory_uri() . '/css/custom.css' );
	
	
    //scripts
	wp_enqueue_script( 'gui_script', get_template_directory_uri().'/js/jquery-gui.js', array(), false, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'customscroll', get_template_directory_uri().'/js/jquery.mCustomScrollbar.concat.min.js', array(), false, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri().'/js/jquery.fancybox.pack.js', array(), false, true );
	wp_enqueue_script( 'wow', get_template_directory_uri().'/js/wow.js', array(), false, true );
	wp_enqueue_script( 'mixitup', get_template_directory_uri().'/js/mixitup.js', array(), false, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/isotope.js', array(), false, true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri().'/js/bxslider.js', array(), false, true );
	wp_enqueue_script( 'owl', get_template_directory_uri().'/js/owl.js', array(), false, true );
	wp_enqueue_script( 'flicker', get_template_directory_uri().'/js/jflickrfeed.min.js', array(), false, true );
	wp_enqueue_script( 'gmap', get_template_directory_uri().'/js/googlemaps.js', array(), false, true );
	wp_enqueue_script( 'teclus_main_script', get_template_directory_uri().'/js/script.js', array(), false, true );
	
}
add_action( 'wp_enqueue_scripts', 'teclus_enqueue_scripts' );
/*-------------------------------------------------------------*/
function teclus_theme_slug_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $old_standard = _x( 'on', 'Old Standard font: on or off', 'teclus' );
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'teclus' );
	
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'teclus' );
 
    if ( 'off' !== $old_standard || 'off' !== $open_sans || 'off' !== $montserrat ) {
        $font_families = array();
 
        if ( 'off' !== $old_standard ) {
            $font_families[] = 'Old Standard TT:400,700,400italic';
        }
		
		if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }
		
		if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:400,300,300italic,800italic,800,700italic,700,600italic,600,400italic';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}
function teclus_theme_slug_scripts_styles() {
    wp_enqueue_style( 'teclus-theme-slug-fonts', teclus_theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'teclus_theme_slug_scripts_styles' );
/*---------------------------------------------------------------------*/
function teclus_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'teclus_add_editor_styles' );
?>