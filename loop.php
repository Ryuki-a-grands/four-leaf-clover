<?php 
	if (have_posts()) :
		while (have_posts()) : the_post();
?>
		<div class="container">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php four_leaf_clover_navi(); ?>
				<div class="main">
					<?php echo the_post_thumbnail(thumbnail,array( 'alt' => get_the_title(), 'title' => get_the_title() ,'class'=> 'firstimg')); ?>
<?php
if ( mb_strlen( get_the_title() ) > 16 ) {
	$title=mb_substr(get_the_title(),0,16).'...';
}else{
	$title=get_the_title() ;
}
?>
					<?php the_excerpt(); ?>
					<p class="more">
						<a href="<?php the_permalink() ?>" class="more-link"><?php printf(__('Read the rest of "%s"','four-leaf-clover'),$title)?> &raquo;</a>
					</p>
				</div>
			</article>
		</div>
<?php 
		endwhile;
	endif;
?>