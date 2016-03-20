<?php
//Theme customizer setting
function four_leaf_clover_customize_register( $wp_customize ) {
	// Add a colors panel.
	$wp_customize->add_panel( 'four_leaf_clover_colors_panel', array(
		'priority'       => 40,
		'title'          => __( 'Colors','four-leaf-clover' ),
	) );
		// Add a section of body color.
		$wp_customize->add_section( 'four_leaf_clover_body_colors', array(
			'title'          => __( 'Body Color','four-leaf-clover' ),
			'panel'  => 'four_leaf_clover_colors_panel',
			'priority'       => 1,
		) );
			// Add the setting of text color.
			$wp_customize->add_setting(
				'four_leaf_clover_text_color_value',
				 array(
					'default'           =>  '#000000',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         =>'postMessage',
				)
			);
			// Add the control of text color.
			$wp_customize->add_control(
				new WP_Customize_Color_Control( 
					$wp_customize, 
					'four_leaf_clover_text_color_value_c', 
					array(
						'label'      => __( 'Font Color','four-leaf-clover' ),
						'section'    => 'four_leaf_clover_body_colors',
						'settings'   => 'four_leaf_clover_text_color_value',
						'priority'   => 1,
					)
				) 
			);
			// Add the setting of base color.
			$wp_customize->add_setting(
				'four_leaf_clover_base_color_value',
				array(
					'default'  =>  '#9acd32',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'=>'postMessage',
				)
			);
			// Add the control of base color.
			$wp_customize->add_control(
				new WP_Customize_Color_Control( 
					$wp_customize, 
					'four_leaf_clover_base_color_value_c', 
					array(
						'label'      => __('Base Color','four-leaf-clover'),
						'section'    => 'four_leaf_clover_body_colors',
						'settings'   => 'four_leaf_clover_base_color_value',
						'priority'   => 2,
					)
				)
			);
		// Customise section of default colors.
		$wp_customize->add_section( 'colors', array(
			'title'          => __( 'Background Color','four-leaf-clover' ),
			'panel'  => 'four_leaf_clover_colors_panel',
			'priority'       => 2,
		) );
		// Add a section of backgrand image color.
		$wp_customize->add_section( 'four_leaf_clover_image_colors', array(
			'title'          => __('Image Color','four-leaf-clover'),
			'panel'  => 'four_leaf_clover_colors_panel',
			'active_callback'=> 'four_leaf_clover_gd_library_active',
			'priority'       => 3,
		) );
			// Add the setting of backgrand image color.
			$wp_customize->add_setting(
				'four_leaf_clover_image_color_value',
				array(
					'default'  =>  '#c0e0b5',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);
			// Add the control of backgrand image color.
			$wp_customize->add_control(
				new WP_Customize_Color_Control( 
					$wp_customize, 
					'four_leaf_clover_image_color_value_c', 
					array(
						'label'      => __('Image Color','four-leaf-clover'),
						'section'    => 'four_leaf_clover_image_colors',
						'settings'   => 'four_leaf_clover_image_color_value',
						'priority'   => 1,
					)
				)
			);

    // Load the radio image control class.
    require_once( trailingslashit( get_template_directory() ) . 'functions/control-radio-image.php' );

    // Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'four_leaf_clover_Customize_Control_Radio_Image' );

	// Add the panel of this theme's original setting .
	$wp_customize->add_panel( 'four_leaf_clover_setting_panel', array(
		'title'          => __( 'Four-leaf clover setting','four-leaf-clover' ),
	) );

    // Add a section of layout.
	    $wp_customize->add_section(
	    	'four_leaf_clover_layout',
	    	array(
	    		'panel'  => 'four_leaf_clover_setting_panel',
	    		'priority'       => 1,
	    		'title' => __( 'Layout', 'four-leaf-clover' )
	    	)
	    );

			// Add the setting of layout.
			$wp_customize->add_setting(
				'four_leaf_clover_layout_value',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'sanitize_key',
					 'transport'=>'postMessage',
				)
			);

			// Add the control of layout.
			$wp_customize->add_control(
				new four_leaf_clover_Customize_Control_Radio_Image(
					$wp_customize,
					'four_leaf_clover_setting_c',
					array(
						'label'         => __( 'Layout', 'four-leaf-clover' ),
						'description'   =>__( 'Position of the side bar', 'four-leaf-clover' ),
						'section'       => 'four_leaf_clover_layout',
						'settings'      => 'four_leaf_clover_layout_value',
						'priority'      => 1,
						'choices'       => array(
							'content-sidebar' => array(
								'label' => __( 'Content / Sidebar', 'four-leaf-clover' ),
								'url'   => '%s/images/functions/right.png'
							),
							'sidebar-content' => array(
								'label' => __( 'Sidebar / Content', 'four-leaf-clover' ),
								'url'   => '%s/images/functions/left.png'
							)
						)
					)
				)
			);
			// Add the setting of border style change.
			$wp_customize->add_setting(
				'four_leaf_clover_border_value',
				array(
					'default'=>'dotted',
					'transport'=>'postMessage',
					'sanitize_callback' => 'sanitize_key',
				)
			);
			// Add the control of border style change.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_border_c',
					array(
						'description'    => __( 'Border style', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_layout',
						'settings'       => 'four_leaf_clover_border_value',
						'type'           => 'select',
						'priority'       => 2,
						'choices'        => array(
							'solid'      => __( 'solid', 'four-leaf-clover' ),
							'double'     => __( 'double', 'four-leaf-clover' ),
							'dashed'     => __( 'dashed', 'four-leaf-clover' ),
							'dotted'     => __( 'dotted', 'four-leaf-clover' )
							)
					)
				)
			);
			// Add the setting to show search form in the header.
			$wp_customize->add_setting(
				'four_leaf_clover_search_value',
				array(
					'default'=>false,
					'transport'=>'postMessage',
					'sanitize_callback' => 'sanitize_checkbox',
				)
			);
			// Add the control to show search form in the header.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_search_c',
					array(
						'label'          => __( 'Show search form in the header', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_layout',
						'settings'       => 'four_leaf_clover_search_value',
						'type'           => 'checkbox',
						'priority'       => 3,
					)
				)
			);

	    // Add a section of font style.
	    $wp_customize->add_section(
	    	'four_leaf_clover_font',
	    	array(
	    		'panel'  => 'four_leaf_clover_setting_panel',
	    		'priority'       => 2,
	    		'title' => __( 'Font setting', 'four-leaf-clover' )
	    	)
	    );
	    	// Add the setting of font style.
			$wp_customize->add_setting(
				'four_leaf_clover_font_value',
				array(
					'default'=>'serif',
					'sanitize_callback' => 'sanitize_key',
				)
			);
			// Add the conrol of font style.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_font_c',
					array(
						'label'          => __( 'Font setting', 'four-leaf-clover' ),
						'description'          => __( 'Font family', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_font',
						'settings'       => 'four_leaf_clover_font_value',
						'type'           => 'select',
						'priority'       => 1,
						'choices'        => array(
							'serif'      => __( 'Serif', 'four-leaf-clover' ),
							'sans-serif' => __( 'Sans-serif', 'four-leaf-clover' ),
							'cursive'    => __( 'Cursive', 'four-leaf-clover' ),
							)
					)
				)
			);
	    	// Add the setting of font size.
			$wp_customize->add_setting(
				'four_leaf_clover_fontsize_value',
				array(
					'default'=>16,
					'transport'=>'postMessage',
					'sanitize_callback' => 'sanitize_int',
				)
			);
			// Add the conrol of font size.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_font_size_c',
					array(
						'description'    => __( 'Font size : ', 'four-leaf-clover' ).'<span id="num">'.get_theme_mod( 'four_leaf_clover_fontsize_value',16 ).'</span>px',
						'section'        => 'four_leaf_clover_font',
						'settings'       => 'four_leaf_clover_fontsize_value',
						'type'           => 'range',
						'priority'       => 3,
						'input_attrs' => array(
							'min' => 8,
							'max' => 32,
							'step' => 1,
							'id' => 'nav_menu_size_id',
							'style' => 'width:100%;',
							'onmousemove' => 'changeValue(this.value)',
							'onchange' => 'changeValue(this.value)',
						),
					)
				)
			);
	    // Add a section of copyright setting.
	    $wp_customize->add_section(
	    	'four_leaf_clover_copyright',
	    	array(
	    		'panel'  => 'four_leaf_clover_setting_panel',
	    		'priority'       => 2,
	    		'title' => __( 'Copyright setting', 'four-leaf-clover' )
	    	)
	    );
			// Add the setting of start year to copyright setting.
			$wp_customize->add_setting(
				'four_leaf_clover_year_value',
				array(
					'default'=>date("Y"),
					'sanitize_callback' => 'sanitize_int',
				)
			);
			// Add the control of start year to copyright setting..
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_year_c',
					array(
						'label'          => __( 'Copyright setting', 'four-leaf-clover' ),
						'description'          => __( 'Start year', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_copyright',
						'settings'       => 'four_leaf_clover_year_value',
						'type'           => 'number',
						'priority'       => 1,
					)
				)
			);
			// Add a setting for handling of the final year to copyright setting.
			$wp_customize->add_setting(
				'four_leaf_clover_last_year_setting_value',
				array(
					'default'=>true,
					'sanitize_callback' => 'sanitize_checkbox',
				)
			);
			// Add a control for handling of the final year to copyright setting.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_last_year_setting_c',
					array(
						'label'          => __( 'Year of the Last Post is the final year.', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_copyright',
						'settings'       => 'four_leaf_clover_last_year_setting_value',
						'type'           => 'checkbox',
						'priority'       => 2,
					)
				)
			);
			// Add the setting of last year to copyright setting.
			$wp_customize->add_setting(
				'four_leaf_clover_last_year_value',
				array(
					'default'=>date("Y"),
					'sanitize_callback' => 'sanitize_int',
				)
			);
			// Add the control of last year to copyright setting.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_last_year_c',
					array(
						'description'          => __( 'Last year', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_copyright',
						'settings'       => 'four_leaf_clover_last_year_value',
						'type'           => 'number',
						'priority'       => 3,
					)
				)
			);
			//Take a display name for all users
			$users =get_users( array('orderby'=>ID,'order'=>ASC) );
			$cnt=0;
			foreach($users as $user){
				if($cnt==0){
					$farst_user_id=$user->ID;
					$cnt=1;
				}
				$ary[$user->ID] =$user->display_name;
			}
			// Add the setting of the copyright owner's name.
			$wp_customize->add_setting(
				'four_leaf_clover_name_value',
				array(
					'default'=>$farst_user_id,
					'sanitize_callback' => 'sanitize_int',
				)
			);
			// Add the control of the copyright owner's name.
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'four_leaf_clover_name_c',
					array(
						'description'          => __( 'Copyright owner', 'four-leaf-clover' ),
						'section'        => 'four_leaf_clover_copyright',
						'settings'       => 'four_leaf_clover_name_value',
						'type'           => 'select',
						'priority'       => 4,
						'choices'        => $ary
					)
				)
			);

}
add_action( 'customize_register', 'four_leaf_clover_customize_register' );

// Sanitize integer.
function sanitize_int($input){
	return intval($input);
}

// Sanitize checkbox.
function sanitize_checkbox($input){
	if($input==true){
		return true;
	}else{
		return false;
	}
}

//Chack the gd module.
function four_leaf_clover_gd_library_active() {
	if(extension_loaded('gd')){
		$gd_info=gd_info();
		return $gd_info['PNG Support'];
	}else{
		return false;
	}
}
// This action hook you to enqueue assets (such as javascript files) directly in the Theme Customizer only.
function four_leaf_clover_customizer_live_preview()
{
	wp_enqueue_script(
		  'four_leaf_clover-themecustomizer',
		  get_template_directory_uri().'/javascript/theme-customize.js',
		  array( 'jquery','customize-preview','rgbcolor' ),
		  '',
		  true
	);
}
add_action( 'customize_preview_init', 'four_leaf_clover_customizer_live_preview' );

// Get sub base color HEX
function four_leaf_clover_sub_base_color_visible(){
	$base=get_theme_mod( 'four_leaf_clover_base_color_value','#9acd32' );
	if(!$base){
		$base='#9acd32';
	}
	$base = preg_replace("/^#/", '', $base);
	$out = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($base, $i, 2);
		$rgb[] = hexdec($hex);
 	}
 	for ($i =0; $i <3; $i++){
		$rgb[$i]=(255-$rgb[$i])*90/100+$rgb[$i];
	}
	return "#".dechex($rgb[0]).dechex($rgb[1]).dechex($rgb[2]);
}

if ( ! function_exists( 'four_leaf_clover_css_modes' ) ){
// Set the theme customizer value in the header.
function four_leaf_clover_css_modes() {
	$image_color=get_theme_mod( 'four_leaf_clover_image_color_value','#c0e0b5' );
	if($image_color!=get_theme_mod( 'four_leaf_clover_image_color_sub_value','#c0e0b5' )){
		set_theme_mod( 'four_leaf_clover_image_color_sub_value', $image_color);
		$image_rgb=hex2rgb($image_color);
		if($image_rgb[0]==255 & $image_rgb[1]==255 & $image_rgb[2]==255){
			$image_rgb[0]=254;
			$image_rgb[1]=254;
			$image_rgb[2]=254;
		}
		four_leaf_clover_image_create($image_rgb[0],$image_rgb[1],$image_rgb[2]);
	}
	$text_color=get_theme_mod( 'four_leaf_clover_text_color_value','#000000' );
	if(!$text_color){
		$text_color='#000000';
	}
	$base_color=get_theme_mod( 'four_leaf_clover_base_color_value','#9acd32' );
	if(!$base_color){
		$base_color='#9acd32';
	}
	$search_value=get_theme_mod( 'four_leaf_clover_search_value',false );
	$border_value=get_theme_mod( 'four_leaf_clover_border_value','dotted' );
	if(!$border_value){
		$base_color='dotted';
	}

?>
	<style type="text/css">
<?php
	$sub_base_color=four_leaf_clover_sub_base_color_visible();
	$font_size=get_theme_mod( 'four_leaf_clover_fontsize_value',16 );
?>
		body{
			font-size:<?php echo $font_size;?>px;
		}
		header {
			background: url('<?php echo get_template_directory_uri();?>/images/four-leaf-clover.png?<?php echo date(U); ?>') 0 -119px repeat-x;
		}
		nav > div > ul > li {
			background: url('<?php echo get_template_directory_uri();?>/images/four-leaf-clover.png?<?php echo date(U); ?>') -829px -54px no-repeat;
		}
		aside h3 {
			background: url('<?php echo get_template_directory_uri();?>/images/four-leaf-clover.png?<?php echo date(U); ?>') -879px -31px no-repeat;
		}
		body,a{
			color:<?php echo $text_color;?>;
		}
		#main h2.title a,
		#main .more a{
			color:<?php echo $text_color;?>;
			border-bottom: 1px solid <?php echo $text_color;?>;
		}
		a:hover {
			color: <?php echo $base_color;?>;
			border-bottom: 1px solid <?php echo $base_color;?>;
		}
		.main a:hover,
		.comment-body a:hover{
			color: <?php echo $base_color;?>;
			border-bottom: 1px solid <?php echo $base_color;?>;
		}
		.main td,
		.main th,
		.comment-body td,
		.comment-body th {
			border-bottom: 1px solid <?php echo $base_color;?>;
		}
		.main blockquote:before,
		.comment-body blockquote:before,
		.main blockquote:after,
		.comment-body blockquote:after{
			color:<?php echo $base_color;?>;
		}
		.main blockquote,
		.comment-body blockquote{
			background:<?php echo $sub_base_color;?>;
			border-left:5px solid <?php echo $base_color;?>;
		}
		header{
			border-bottom:2px <?php echo $border_value;?> <?php echo $base_color;?>;
		}
		footer{
			border-top:2px <?php echo $border_value;?> <?php echo $base_color;?>;
		}
		nav ul>li>ul>li>a:hover {
			border:1px solid <?php echo $base_color;?>;
		}
		#main h2.title a:hover,
		#main .more a:hover{
			color:<?php echo $base_color;?>;
			border-bottom: 1px solid <?php echo $base_color;?>;
		}
		input[type="text"]:focus,
		input[type="search"]:focus,
		input[type="password"]:focus,
		input[type="email"]:focus,
		input[type="search"]:focus,
		textarea:focus {
			border: 1px solid <?php echo $base_color;?> ;
			-webkit-box-shadow: 0 0 10px <?php echo $base_color;?>;
			-moz-box-shadow: 0 0 10px <?php echo $base_color;?>;
			box-shadow:  0 0 10px <?php echo $base_color;?>;
		}
		.button,
		button,
		input[type="submit"],
		input[type="reset"],
		input[type="button"] {
			border: 1px solid <?php echo $base_color;?>;
			background: <?php echo $sub_base_color;?>;
			color: <?php echo $base_color;?>;
		}
		.button:hover,
		button:hover,
		input[type="submit"]:hover,
		input[type="reset"]:hover,
		input[type="button"]:hover {
		  	border: 1px solid <?php echo $sub_base_color;?>;
			background: <?php echo $base_color;?>;
			color: <?php echo $sub_base_color;?>;
		}
		.search-key{
			color:<?php echo $base_color;?>;
		}
		.comments-list li[id^='li-comment'],
		.comment-page-link{
			border-top: 2px <?php echo $border_value;?> <?php echo $base_color;?>;
		}
		.main tbody tr:nth-child(even),
		.comment-body tr:nth-child(even) {
			background: <?php echo $sub_base_color;?>;
		}
		.main th,
		.comment-body th {
			background-color: <?php echo $sub_base_color;?>;
		}
		.main tfoot td,
		.comment-body tfoot td {
			background-color: <?php echo $sub_base_color;?>;
		}
		#page-link ul li{
			border: 1px solid <?php echo $text_color;?>;
		}

		#page-link ul a li{
			border: 1px solid <?php echo $text_color;?>;
		}
		#page-link ul a:hover li{
			color:<?php echo $base_color;?>;
			background-color:<?php echo $sub_base_color;?>;
			border: 1px solid <?php echo $base_color;?>;
		}
		article.sticky {
			background-color:<?php echo $sub_base_color;?>;
		}
		.bypostauthor {
			background-color:<?php echo $sub_base_color;?>;
		}
		span.page-numbers,
		a.page-numbers{
			border: 1px solid <?php echo $text_color;?>;
		}
		a.page-numbers:hover{
			color:<?php echo $base_color;?>;
			background-color:<?php echo $sub_base_color;?>;
			border: 1px solid <?php echo $base_color;?>;
		}
		.main img{
			border: 1px solid <?php echo $text_color;?>;
		}
		.writer_icon{
			border: 1px solid <?php echo $text_color;?>;
		}
		div.wp-caption{
			border: 1px solid <?php echo $text_color;?>;
		}
		#today {
			border: 1px solid <?php echo $base_color;?>;
		}
<?php if(!$search_value):?>
		header .right{
			display:none;
		}
<?php endif; ?>
<?php if(get_theme_mod('four_leaf_clover_layout_value','content-sidebar')=="sidebar-content"):?>
	@media screen and (min-width:641px){
		#main {
			float: right;
		}
		aside {
			float:left;
		}
	}
<?php else:?>
	@media screen and (min-width:641px){
		#main {
			float: left;
		}
		aside {
			float:right;
		}
	}
<?php endif; ?>
<?php switch (get_theme_mod( 'four_leaf_clover_font_value','serif' )) {
		case 'sans-serif':
?>
	body{
		font-family:<?php _e('Verdana,sans-serif','four-leaf-clover');?>;
	}
<?php
			break;
		case 'cursive':
?>
	body{
		font-family:<?php _e('"Comic Sans MS",cursive','four-leaf-clover');?>;
	}
<?php
			break;
		default:
?>
	body{
		font-family:<?php _e('"Times New Roman",serif','four-leaf-clover');?>;
	}
<?php
	}
?>
    </style>
<?php
}
}
add_action( 'wp_head', 'four_leaf_clover_css_modes');
