<?php
get_header();
?>
<main id="single-main" class="single-main">
<?php
	if (function_exists('yoast_breadcrumb') && !is_front_page()) {
	?>
		<div class="breadcramb"><?php yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?></div>
	<?php } ?>
	<section id="page">
		<?php
		if (have_posts()) {

			// ループ開始
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content');
			}
		} else {
			// コンテンツがない場合
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</section>
</main><!-- #site-main -->
<?php

get_footer();