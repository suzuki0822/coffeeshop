<?php
get_header();
?>
<main id="site-main" class="site-main" role="main">
	<section id="beans-archive">
		<?php
		if (function_exists('yoast_breadcrumb') && !is_front_page()) {
		?>
			<div class="breadcramb"><?php yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?></div>
		<?php } ?>
		<header class="archive-header default-max-width">
			<?php the_archive_title('<h1 class="archive-title default-max-width">', '</h1>'); ?>
		</header>
		<?php
		if (have_posts()) {

			echo '<div class="wp-block-query">';
			echo '<ul class="is-flex-container columns-3 wp-block-post-template">';

			// ループ開始
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content-beans');
			}

			echo '</ul>';
			echo '</div>';

			// ページネーション
			the_posts_pagination();
		} else {
			// コンテンツがない場合
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</section>
</main><!-- #site-main -->
<?php
get_footer();
