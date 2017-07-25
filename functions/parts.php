<?php
if ( ! function_exists( 'four_leaf_clover_navi' ) ) {
	function four_leaf_clover_navi() {
?>
				<div class="navi">
					<ul>
						<li><?php esc_html_e( 'Posted : ','four-leaf-clover' );?><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>
<?php
if ( get_theme_mod( 'four_leaf_clover_category_show_value',true ) ) :
?>
				<li><?php esc_html_e( 'Category : ','four-leaf-clover' );?><?php the_category( ', ' ) ?></li>
<?php
	endif;
if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
?>
				<li><?php comments_popup_link( __( 'No comment.','four-leaf-clover' ),__( 'Comment : 1','four-leaf-clover' ), __( 'Comments : %','four-leaf-clover' ) ); ?></li>
<?php
	endif;
?>
					</ul>
				</div>
<?php
	}
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own four_leaf_clover_comment(), and that function will be used instead.
 */
function four_leaf_clover_comment( $comment, $args, $depth ) {
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
<?php if ( get_avatar( $comment ) ) : ?>
				<div class="writer_icon"><?php echo get_avatar( $comment,$size = '40' ); ?></div>
<?php endif; ?>
				<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>','four-leaf-clover' ), get_comment_author_link() ) ?>
				<div class="comment-meta commentmetadata"><a href="<?php echo esc_attr( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __( '%1$s at %2$s','four-leaf-clover' ), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '( Edit )','four-leaf-clover' ),'  ','' ) ?></div>
			</div>
<?php if ( $comment->comment_approved === '0' ) : ?>
			<em><?php esc_html_e( 'Your comment is awaiting moderation.','four-leaf-clover' ) ?></em>
			<br />
<?php endif; ?>
			<div class="comment-body">
				<?php comment_text() ?>
			</div>
			<div class="reply">
<?php comment_reply_link( array_merge( $args, array(
	'depth' => $depth,
	'max_depth' => $args['max_depth'],
) ) ) ?>
			</div>
		</div>
<?php
}
?>
