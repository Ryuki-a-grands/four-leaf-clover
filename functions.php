<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) $content_width = 800;


/** Tell WordPress to run four_leaf_clover_setup() when the 'after_setup_theme' hook is run. */
add_action('after_setup_theme', 'four_leaf_clover_setup');
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * To override four_leaf_clover_setup() in a child theme, add your own coraline_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, menus and title tag.
 * @uses add_editor_style() To style the visual editor.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses load_theme_textdomain() For translation/localization support.
 *
 */
function four_leaf_clover_setup(){
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	// This theme uses menus
	add_theme_support( 'menus' );
	// Add title tag
	add_theme_support( 'title-tag' );
	// This theme styles the visual editor with custom-editor-style.css to match the theme style.
	add_editor_style( './css/custom-editor-style.css' );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'header-navi', __('Primary Navigation','four-leaf-clover'));
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain('four-leaf-clover', get_template_directory() . '/languages');
}

/**
 * Setup the WordPress core custom background feature.
 *
 * Hooks into the after_setup_theme action.
 */
function four_leaf_clover_custom_header_background_setup() {
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	$args = array(
		'width' => 800,
		'height' => 200,
		'random-default'=> false,
		'default-image' => get_template_directory_uri() . '/images/header.png',
		'uploads' => true,
		'header-text' => false,
		'flex-height' => true,
		'flex-width' => false,
		'wp-head-callback' => 'four_leaf_clover_header_style',
	);
		register_default_headers( array(
			'four-leaf-clover' => array(
				'url' => get_template_directory_uri() . '/images/header.png',
				'thumbnail_url' => get_template_directory_uri() . '/images/header.png',
				'description' => 'four-leaf clover'
			),
		));
	add_theme_support( 'custom-header', $args );
}
function four_leaf_clover_header_style(){
	if(basename( get_header_image() )!="header.png"){
?>
	<style type="text/css">
		header {
			background: url(<?php esc_url(header_image()); ?>) repeat-x;
		}
	</style>
<?php
	}
}
add_action( 'after_setup_theme', 'four_leaf_clover_custom_header_background_setup' );


/**
 * Enqueue scripts and styles
 */
function four_leaf_clover_script_output() {
	// Use reset style sheet for html5
	wp_enqueue_style('html5reset-style', get_template_directory_uri().'/css/html5reset.css');
	// This theme style style sheet
	wp_enqueue_style('four_leaf_clover-style', get_stylesheet_uri());
	// Use jquery for this theme style css
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('rgbcolor', get_template_directory_uri() . '/javascript/rgbcolor.js',array(),1.0,true);
	// Use The javascript for this theme style css
	wp_enqueue_script('four-leaf-clover', get_template_directory_uri() . '/javascript/four-leaf-clover.js', array('jquery'),1.0,true);
	// Use comment-reply.js if a singular post is being displayed
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'four_leaf_clover_script_output');

/**
 * Register widgetized areas, including a sidebar.
 *
 */
function four_leaf_clover_slug_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Widget Area', 'four-leaf-clover' ),
		'id' => 'sidebar-1',
		'description' => __( 'Add widgets here to appear in your sidebar.', 'four-leaf-clover' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'four_leaf_clover_slug_widgets_init' );

if ( ! function_exists( 'four_leaf_clover_adds_footer' ) ){
function four_leaf_clover_adds_footer() {
	$lastpost = get_lastpostdate( 'blog' );
	if(get_theme_mod( 'four_leaf_clover_last_year_setting_value',true )){
		$lastyear = explode("-", $lastpost);
		$last_year=$lastyear[0];
	}else{
		$last_year=get_theme_mod( 'four_leaf_clover_last_year_value',date("Y") );
	}
	if(get_theme_mod( 'four_leaf_clover_first_year_setting_value',true )){
		 $found_posts = get_posts(  array("order" =>"ASC", "numberposts"=>1) ); 
		foreach ( $found_posts as $child ) {
			$start_year=get_the_date( "Y",$child  );
		}
	}else{
		$start_year=get_theme_mod( 'four_leaf_clover_year_value',date("Y") );
	}
	if($start_year==$last_year){
		$year=$last_year;
	}elseif($start_year>$last_year){
		$year=$last_year;
	}else{
		$year=$start_year."-".$last_year;
	}
	$users =get_users( array('orderby'=>'ID','order'=>'ASC') );
	foreach($users as $user){
		$default_id=$user->ID;
		break;
	}
	$id=intval(get_theme_mod( 'four_leaf_clover_name_value',$default_id ));
	foreach($users as $user){
		if($user->ID==$id){
			$name=$user->display_name;
			break;
		}
	}
	$copyright_owner_name='<a href="'.home_url('/').'">'.$name.'</a>';
?>
		<footer>
<?php
	if(get_theme_mod( 'four_leaf_clover_copyright_show_value',true )):
?>
			<div class="left"><?php printf( __( 'Copyright &copy; %1$s %2$s All Rights Reserved.', 'four-leaf-clover' ),$year,$copyright_owner_name); ?></div>
<?php
	endif;
?>
			<div class="right"><?php printf( __( 'Use theme of %s', 'four-leaf-clover' ), 'four-leaf clover' ); ?><br/>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'four-leaf-clover' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'four-leaf-clover' ), 'WordPress' ); ?></a></div>
		</footer>
<?php
}
}
add_action('wp_footer', 'four_leaf_clover_adds_footer');


require_once get_template_directory() . '/functions/parts.php';
require_once get_template_directory() . '/functions/image.php';
/**
 * Custom color for this theme.
 */
require_once get_template_directory() . '/functions/setting.php';