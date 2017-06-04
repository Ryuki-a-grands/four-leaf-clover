<?php
if ( post_password_required() ) {
	return;
}
?>

<!-- comment area -->
<div id="comment-area">
	<?php
	if ( have_comments() ) :
	?>

		<h3 id="comments"><?php  esc_html_e( 'Comments List','four-leaf-clover' )?></h3>
	
		<ol class="comments-list">
		<?php wp_list_comments( 'callback=four_leaf_clover_comment' ); ?>
		</ol>
		
		<div class="comment-page-link">
				<?php paginate_comments_links();?>
		</div>
<?php
	endif;
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php  esc_html_e( 'Comments are closed.', 'four-leaf-clover' ); ?></p>
<?php
	endif;
	comment_form();
	?>
</div>
<!-- /comment area -->
