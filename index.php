<?php
get_header();
?>
<main id="site-main" class="site-main" role="main">

<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header default-max-width">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->
<?php endif; ?>
<?php
if ( have_posts() ) {

	// ループ開始
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}

	// ページネーション
	the_posts_pagination();
	the_post_navigation();

} else {
	// コンテンツがない場合
	echo '<p>コンテンツがありません。</p>';

}
?>
</main><!-- #site-main -->
<?php
get_sidebar();
get_footer();
