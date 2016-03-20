<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
		<div class="container">
			<div class="left">
				<h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
				<p><?php bloginfo('description'); ?></p>
			</div>
			<div class="right">
				<?php get_search_form(); ?>
			</div>
		</div>
			<nav>
				<?php wp_nav_menu( array ( 'theme_location' => 'header-navi' ) ); ?>
			</nav>
		</header>
