<?php get_header(); ?>
	<div class="container">
		<div id="main">
<?php $allsearch =new WP_Query("s=$s&posts_per_page=-1"); 
	$key = esc_html($s);
	$count = $allsearch->post_count;
	if($count!=0){
		echo '<article><h2>'.__('search results','four-leaf-clover').'</h2>';
		echo '<div class="main"><p>'.sprintf(__('Your search for "<span class="search-key">%s</span>", ','four-leaf-clover'),$key).
		sprintf(_n( 'found <span class="search-key">%d</span> post.', 'found <span class="search-key">%d</span> posts.', $count, 'four-leaf-clover' ),$count).'</p>'; 
		echo '</div></article>';
	} else {
		echo '<article><h2>'.__('search results','four-leaf-clover').'</h2>';
		echo '<div class="main"><p>'.sprintf(__('Your search for "<span class="search-key">%s</span>", related article was not found.','four-leaf-clover'),$key).'</p>'; 
		echo '</div></article>';
	} 
?> 
			<?php get_template_part( 'loop', 'index' ); ?>
			<div id="navigation">
				<ul>
<?php 
		if( get_previous_post() ):
?>
					<li class="left"><?php next_posts_link('&laquo; '.__('PREV','four-leaf-clover')); ?></li>
<?php 
		endif;
		if( get_next_post() ):
?>
					<li class="right"><?php previous_posts_link(__('NEXT','four-leaf-clover').' &raquo;'); ?></li>
<?php 
		endif; 
?>
				</ul>
			</div>
		</div>
<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>