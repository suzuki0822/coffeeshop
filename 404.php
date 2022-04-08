<?php
get_header();
?>
<main id="single-main" class="single-main">
<?php
	if (function_exists('yoast_breadcrumb') && !is_front_page()) {
	?>
		<div class="breadcramb"><?php yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?></div>
	<?php } ?>
	<section id="single">
		<main id="site-main" class="site-main" role="main">
			<p>ページが見つかりませんでした。</p>
		</main><!-- #site-main -->
		<?php get_sidebar(); ?>
	</section>
	<?php the_post_navigation(); ?>
</main><!-- #site-main -->
<?php

get_footer();
