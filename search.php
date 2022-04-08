<?php
get_header();
?>

<main id="site-main" class="site-main" role="main">
<?php
	if (function_exists('yoast_breadcrumb') && !is_front_page()) {
	?>
		<div class="breadcramb"><?php yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?></div>
	<?php } ?>
	<section id="single">
		<div class="search" style="flex: 1;">

			<section id="archive">
				<div class="padding">
					<header class="archive-header default-max-width">
						<h1 class="page-title">
							「<span class="page-description search-term"><?php echo esc_html(get_search_query()); ?></span>」の検索結果
						</h1>
					</header>
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<!-- //(whileと　the_postは必ずセット) -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<a href="<?php the_permalink(); ?>">
									<h2 class="post-title">
										<?php the_title(); ?>
									</h2>
									<h3 class="post-subtitle">
										<?php the_excerpt(); ?>
									</h3>
								</a>
								<p class="entry-date">投稿日: <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年n月j日'); ?></time></p>
								<p class="entry-category">カテゴリー: <?php the_category(' '); ?></p>
								<div class="entry-content">
									<?php
									if (!is_post_type_archive('beans')) {
										the_excerpt();
									}
									?>
								</div><!-- .entry-content -->
							</article>
						<?php endwhile; ?>

						<?php
						$link = get_previous_posts_link('&larr; 新しい記事へ');
						if ($link) {
							$link = str_replace('<a', '<a class="btn-new"', $link);
							echo $link;
						}
						?>
						<?php
						$link = get_next_posts_link('古い記事へ &rarr;');
						if ($link) {
							$link = str_replace('<a', '<a class="btn-old"', $link);
							echo $link;
						}
						?>

					<?php else : ?>
						<p>記事が見つかりませんでした</p>
					<?php endif; ?>
				</div>

				<?php get_sidebar(); ?>

			</section>

</main><!-- #site-main -->
<?php
get_footer();
