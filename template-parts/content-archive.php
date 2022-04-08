<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
		<?php if ( is_home() ) : ?>
			<p class="entry-date">投稿日: <time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y年n月j日' ); ?></time></p>
			<p class="entry-category">カテゴリー: <?php the_category( ' ' ); ?></p>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( ! is_post_type_archive( 'beans' ) ) {
			the_excerpt();
		}
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
