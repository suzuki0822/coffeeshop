<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>Coffee Shop</title>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
	<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-2-4/css/5-2-4.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
	<!-- <link rel="stylesheet" href="C:\Users\amazo\Local Sites\coffeeshop\app\public\wp-content\themes\coffeeshop\style.css"> -->
	<?php wp_head(); ?>
</head>

<body>
	<!----- header----->
	<header>
		<div class="logo"><a href=""> <?php if (has_custom_logo()) : ?>

					<div class="site-logo"><a href="<?php echo esc_attr(home_url('/')); ?>"><?php the_custom_logo(); ?></a></div>

				<?php else : ?>
					<div class="site-logo"><a href="<?php echo esc_attr(home_url('/')); ?>"><?php bloginfo('name'); ?></a></div>
				<?php endif; ?>
			</a></div>
		<div class="openbtn4"><span></span><span></span><span></span></div>


		<!-- 
        <?php
		$menu_name = 'g-nav';
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		?>
        <nav id="g-nav">
            <ul id="main_nav">
                <?php foreach ($menu_items as $item) : ?>
                    <li class="naviation-list"><a href="<?php echo esc_attr($item->url); ?>"><?php echo esc_html($item->title); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav> -->




		<nav id="g-nav" class="primary-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'menu_class'      => 'menu-wrapper',
					'container_class' => 'primary-menu-container',
					'items_wrap'      => '<ul id="main_nav" class="%2$s">%3$s</ul>',
					'fallback_cb'     => false,
				)
			);
			?>
		</nav>
		<a href="/contact"><div class="contact_btn">
			<i class="fa fa-envelope" aria-hidden="true"></i>
			<p>CONTACT</p></a>
		</div></a>
	</header>
