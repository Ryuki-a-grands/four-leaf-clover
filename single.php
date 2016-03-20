<?php get_header(); ?>
	<div class="container">
		<div id="main">
<?php 
	if (have_posts()) :
		while (have_posts()) : the_post();
?>
			<div id="navigation">
				<ul>
<?php
	$previous_post = get_previous_post();
	$pre_post_title = $previous_post->post_title;
	if ( mb_strlen( $pre_post_title ) > 18 ) { $pre_post_title = mb_substr( $pre_post_title, 0, 18).'...'; }
	if ( !empty( $previous_post ) ):
		if(!empty($pre_post_title)):
?>
				<li class="left">
					<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" title="<?php echo esc_html( $previous_post->post_title); ?>">&laquo; <?php echo $pre_post_title; ?></a>
				</li>
<?php else:?>
				<li class="left">
					<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" title="<?php echo esc_html( $previous_post->post_title); ?>">&laquo; <?php _e('Previous Post','four-leaf-clover'); ?></a>
				</li>
<?php
	endif;
	endif;
	$next_post = get_next_post();
	$next_post_title = $next_post->post_title;
	if ( mb_strlen( $next_post_title ) > 18 ) { $next_post_title = mb_substr( $next_post_title, 0, 18).'...'; }
	if ( !empty( $next_post ) ):
		if(!empty($next_post_title)):
?>
				<li class="right">
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_html( $next_post->post_title); ?>"><?php echo $next_post_title; ?> &raquo;</a>
				</li>
<?php else:?>
				<li class="right">
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_html( $next_post->post_title); ?>"><?php _e('	Next Post','four-leaf-clover'); ?> &raquo;</a>
				</li>
<?php
	endif;
	endif; ?>
				</ul>
			</div>
			<article>
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
				<?php four_leaf_clover_navi(); ?>
				<div class="main">
					<?php the_content(); ?>
				</div>
			</article>
<?php 
	$args = array(
	'before' => '<div id="page-link"><ul>',
	'after' => '</ul></div>',
	'link_before' => '<li>',
	'link_after' => '</li>',
	);
					wp_link_pages($args);
?>
					<p class="footer-post-meta">
<?php
			if(get_theme_mod( 'four_leaf_clover_tag_show_value',true )):
?>
						<?php the_tags(__('Tag : ','four-leaf-clover'),', ','<br/>'); ?>
<?php
			endif;
			if ( is_multi_author() && get_theme_mod( 'four_leaf_clover_contributor_show_value',true )):
?> 
						<?php _e('Contributor : ','four-leaf-clover')?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
<?php
			endif;
?>
					</p>
					<?php comments_template();?>
<?php 
		endwhile;
	endif;
?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>