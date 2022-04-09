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
		<section id="single-beans">
			<?php
			if (have_posts()) {

				// ループ開始
				while (have_posts()) {
					the_post();
					get_template_part('template-parts/content');
				}


				// 関連する制作事例
				$related_posts_args = array(
					'post_type'      => 'beans',
					'post_status'    => 'publish',
					'posts_per_page' => 3,
					'orderby'        => 'rand',
					'post__not_in'   => array($post->ID),
					'tax_query'      => array(
						array(
							'taxonomy' => 'genre',
							'fields'   => 'term_id',
							'terms'    => wp_get_object_terms($post->ID, 'genre', array('fields' => 'ids')),
						),
					),
				);
				$related_posts_query = new WP_Query($related_posts_args);
				if ($related_posts_query->have_posts()) :
			?>
					<div class="related_posts">
						<h2>関連する制作事例</h2>
						<div class="wp-block-query">
							<ul class="is-flex-container columns-3 wp-block-post-template">
								<?php
								while ($related_posts_query->have_posts()) :
									$related_posts_query->the_post();
								?>
									<li>
										<div class="wp-block-group">
											<div class="wp-block-group__inner-container">
												<?php if (has_post_thumbnail()) { ?>
													<figure class="wp-block-post-featured-image">
														<?php the_post_thumbnail(); ?>
													</figure>
												<?php } ?>
												<h3 class="wp-block-post-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
											</div>
										</div>
									</li>
								<?php
								endwhile;
								wp_reset_postdata();
								?>
							</ul>
						</div>
					</div>
			<?php
				endif;
			} else {
				// コンテンツがない場合
				echo '<p>コンテンツがありません。</p>';
			}
			?>
		</section>
		<?php get_sidebar(); ?>
	</section>
	<?php the_post_navigation(); ?>
</main><!-- #site-main -->
<?php
get_footer();
