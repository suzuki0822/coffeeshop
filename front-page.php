<?php
get_header();
?>
<main>
    <div class="main-visual">
        <img src="http://coffeeshop.local/wp-content/uploads/2022/04/背景1.jpg" alt="">
        <h2 class="top_text">こだわりのブレンドコーヒーを</h2>
    </div>


    <section id="news" class="container">
        <h2 class="news_title">お知らせ</h2>
        <div class="news_lists">
            <?php query_posts('posts_per_page=3'); ?>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="news_box">
                        <div class="article_info">
                            <p class="article_date"><time datetime="2021-01-01"><?php the_time('Y年n月j日'); ?></time></p>
                            <p class="news_category newsletter"> <?php
                                                                    $category = get_the_category();
                                                                    if ($category[0]) {
                                                                        echo '<a href="' . get_category_link($category[0]->term_id) . '">' . '<span>' . $category[0]->name . '</span>' . '</a>';
                                                                    }
                                                                    ?></p>
                        </div>
                        <h3 class="news_box_title"><a href="<?php the_permalink(); ?>" <p><?php the_title(); ?></p></a></h3>
                    </article>
                <?php endwhile; ?>

            <?php else : ?>
                <p>記事が見つかりません</p>
            <?php endif ?>

        </div>
        <div class="top_link_btn"><a href="<?php echo esc_html('category/news/'); ?>">お知らせ一覧</a></div>
    </section>

    <section id="about" class="bg_red">
        <div class="container">
            <h1 class="tt_about">THE COFFEE SHOP</h1>
            <p>今までとは違うコーヒーの楽しみを。</p>
            <div class="top_link_btn"><a href="/about/">Coffee Shopについて</a></div>
        </div>
    </section>










    <section id="enjoy" class="column no_padding">
        <section id="athome" class="top_content">

            <picture class="picture_box">
                <img src="http://coffeeshop.local/wp-content/uploads/2022/04/athome1.jpg" alt="">
                <h2 class="picture_text">家でも美味しく淹れてみよう</h2>
                <div class="picture_box_btn"><a href="/athome/" class="picture_box_btn_text">おうちで楽しむ</a></div>
            </picture>

        </section>
        <section id="atshop" class="top_content">
            <picture class="picture_box">
                <img src="http://coffeeshop.local/wp-content/uploads/2022/04/atshop2.jpg" alt="">
                <h2 class="picture_text">お店でゆっくり</h2>
                <div class="picture_box_btn"><a href="/shop/" class="picture_box_btn_text">店舗情報</a></div>
            </picture>
        </section>
    </section>

    <section id="blend" class="top_content no_padding">
        <picture class="blend_box">
            <img src="http://coffeeshop.local/wp-content/uploads/2022/04/ブレンド-1.jpg" class="blend_img">
            <h2 class="blend_text">ブレンド COFFEE SHOPのこだわり</h2>
            <div class="picture_box_btn"><a href="/blend/" class="picture_box_btn_text">ブレンドについて</a></div>
        </picture>
    </section>





    <?php
    $args = [
        'post_type' => 'beans',
        'posts_per_page' => 8,
    ];
    $the_query = new WP_Query($args); ?>

    <section id="beans">
        <h2 class="beans_title">コーヒー豆について</h2>
        <?php if ($the_query->have_posts()) :
        ?>

            <ul class="slider">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <?php if (has_post_thumbnail()) : ?>

                        <li>
                            <article class="article_box">
                                <picture class="article_box_img">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?>
                                </picture>
                                <div class="article_box_container">
                                    <h3 class="article_box_title"><a href="<?php the_permalink(); ?>" <p><?php the_title(); ?></p></a></h3>
                                    <div class="article_info">
                                        <p class="article_date"><time><?php the_time('Y.n.j'); ?></time></p>
                                        <p class="article_author">著者：<?php the_author(); ?></p>
                                    </div>
                                    <div class="article_excerpt">
                                        <a href="<?php the_permalink(); ?>">
                                            <p><?php echo mb_substr(get_the_excerpt(), 0, 20) . '[続きを読む]'; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </li>
                    <?php else : ?>
                        <li>
                            <article class="article_box">
                                <picture class="article_box_img">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_attr(get_template_directory_uri()); ?> /assets/images/thumbnail-default.jpg"></a>
                                </picture>
                                <div class="article_box_container">
                                    <h3 class="article_box_title"><a href="<?php the_permalink(); ?>" <p><?php the_title(); ?></p></a></h3>
                                    <div class="article_info">
                                        <p class="article_date"><time><?php the_time('Y.n.j'); ?></time></p>
                                        <p class="article_author">著者：<?php the_author(); ?></p>
                                    </div>
                                    <div class="article_excerpt">
                                        <a href="<?php the_permalink(); ?>">
                                            <p><?php echo mb_substr(get_the_excerpt(), 0, 20) . ' [続きを読む]'; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </li>
                    <?php endif ?>

                <?php endwhile; ?>
            </ul>
            <div class="top_link_btn beans_btn"><a href="<?php echo esc_html('/beans'); ?>">
                    <p>記事一覧へ</p>
                </a>
            </div>
        <?php else :
        ?>
            <p>まだ記事がありません</p>
        <?php endif;
        wp_reset_postdata(); ?>
        <!--/slider-->

    </section>
</main>
<?php get_footer() ?>