<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<header class="entry-header">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {
				echo '<img src="' . esc_attr( get_template_directory_uri() ) . '/assets/images/thumbnail-default.jpg">';
			}
			?>
			<?php the_title( '<h3 class="entry-title default-max-width">', '</h3>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	</a>
</li><!-- #post-<?php the_ID(); ?> -->
