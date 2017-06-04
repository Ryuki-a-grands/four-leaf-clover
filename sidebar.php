			<aside>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) :
				dynamic_sidebar( 'sidebar-1' );
else : ?>
				<section>
					<h3><?php esc_html_e( 'No Widget','four-leaf-clover' );?></h3>
					<p><?php esc_html_e( 'Widget has not been set.','four-leaf-clover' );?></p>
				</section>
<?php
endif;
?>
			</aside>
