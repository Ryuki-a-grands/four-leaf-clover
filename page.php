<?php get_header(); ?>
	<div class="container">
		<div id="main">
<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
		<article>
			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
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
				wp_link_pages( $args );
?>
<?php comments_template();?>
<?php
endwhile;
	endif;
?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
