<?php


if ( is_active_sidebar( 'main-sidebar' ) ) : ?>

	<aside id="site-aside" class="site-aside">
		<?php
		if ( is_active_sidebar( 'main-sidebar' ) ) {
			?>
				<div class="widget-column main-sidebar">
				<?php dynamic_sidebar( 'main-sidebar' ); ?>
				</div>
			<?php
		}
		?>
	</aside><!-- .widget-area -->

<?php endif; ?>
