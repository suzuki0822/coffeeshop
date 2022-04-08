<?php

get_header();
?>
<main id="site-main" class="site-main" role="main">
<?php
if ( have_posts() ) {

	// ループ開始
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}

} else {
	// コンテンツがない場合
	echo '<p>コンテンツがありません。</p>';

}
?>
</main><!-- #site-main -->
<?php
get_sidebar();
get_footer();
