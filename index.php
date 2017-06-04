<?php get_header(); ?>
	<div class="container">
		<div id="main">
			<?php get_template_part( 'loop', 'index' ); ?>
<?php
if ( $wp_query->max_num_pages > 1 ) :
?>
	<div id="navigation">
		<ul>
			<li class="left"><?php next_posts_link( '&laquo; ' . __( 'PREV','four-leaf-clover' ) ); ?></li>
			<li class="right"><?php previous_posts_link( __( 'NEXT','four-leaf-clover' ) . ' &raquo;' ); ?></li>
		</ul>
	</div>
<?php
	endif;
?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
