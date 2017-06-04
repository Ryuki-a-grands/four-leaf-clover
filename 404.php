<?php get_header(); ?>
	<div class="container">
		<div id="main">
			<article>
				<h2><?php  esc_html_e( 'That page does not exist.','four-leaf-clover' );?></h2>
				<div class="main">
					<p><?php  esc_html_e( 'You are looking for articles could not be found.','four-leaf-clover' );?></p>
				</div>
			</article>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
