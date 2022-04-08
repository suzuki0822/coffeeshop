
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} elseif ( is_single() ) {
				echo '<img src="' . esc_attr( get_template_directory_uri() ) . '/assets/images/thumbnail-default.jpg">';
			}
			?>
			<?php the_title( '<h1 class="entry-title default-max-width">', '</h1>' ); ?>
			<?php if ( is_singular( 'post' ) ) : ?>
				<p class="entry-date">投稿日: <time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y年n月j日' ); ?></time></p>
				<p class="entry-category">カテゴリー: <?php the_category( ' ' ); ?></p>
			<?php endif; ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		if ( is_single() ) {
			// ページ分割への対応
			$link_pages_args = array(
				'before'         => '<p class="entry-link-pages">',
				'next_or_number' => 'next',
			);
			wp_link_pages( $link_pages_args );
		}
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
