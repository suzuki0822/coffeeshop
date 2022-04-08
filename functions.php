<?php

function add_stylesheet() {
	wp_enqueue_style(
		'main', // mainという名前を設定
		get_template_directory_uri().'/style.css', // パス
		array(), // style.cssより先に読み込むCSSは無いので配列は空
	);
  }
  add_action('wp_enqueue_scripts', 'add_stylesheet');

/**
 * テーマ初期設定
 *
 * テーマサポートの読み込み
 * カスタムメニューの設定
 */
function wpro_setup() {

	// RSSリンクの出力
	add_theme_support( 'automatic-feed-links' );

	// タイトルタグの出力
	add_theme_support( 'title-tag' );

	// アイキャッチの利用
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1568, 9999 );

	// html5形式での出力
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// カスタムロゴの設定
	$logo_width  = 200;
	$logo_height = 85;

	add_theme_support(
		'custom-logo',
		array(
			'height'               => $logo_height,
			'width'                => $logo_width,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => true,
		)
	);

	// テーマカスタマイザーよりウィジェットを設定した際にリロードする
	add_theme_support( 'customize-selective-refresh-widgets' );

	// ブロックエディター用の基本CSSの読み込み
	add_theme_support( 'wp-block-styles' );

	// 全幅と幅広への利用
	add_theme_support( 'align-wide' );

	// 管理画面ブロックエディター用のCSSの読み込み
	add_theme_support( 'editor-styles' );

	// 管理画面用の独自CSSの読み込み
	$editor_stylesheet_path = './assets/css/style-editor.css';
	add_editor_style( $editor_stylesheet_path );

	// テキスト設定のフォントサイズの設定
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => '小',
				'shortName' => 'S',
				'size'      => 13,
				'slug'      => 'small',
			),
			array(
				'name'      => '中',
				'shortName' => 'M',
				'size'      => 16,
				'slug'      => 'normal',
			),
			array(
				'name'      => '大',
				'shortName' => 'L',
				'size'      => 36,
				'slug'      => 'large',
			),
		)
	);

	// レスポンシブに対応した埋め込みのサポート
	add_theme_support( 'responsive-embeds' );

	// 行間のカスタマイズのサポート
	add_theme_support( 'custom-line-height' );

	// 段落、見出し、グループ、列、メディアおよびテキストブロックのリンクカラー設定のサポート
	add_theme_support( 'experimental-link-color' );

	// カバーブロックの余白設定のサポート
	add_theme_support( 'custom-spacing' );

	// カバーブロックの高さの単位の設定をサポート
	add_theme_support( 'custom-units' );

	// カスタムメニューの追加
	register_nav_menus(
		array(
			'primary' => 'メインナビゲーション',
		)
	);

}
add_action( 'after_setup_theme', 'wpro_setup' );

/**
 * ウィジェットの追加
 */
function wpro_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'サイドバー',
			'id'            => 'main-sidebar',
			'description'   => 'サイドバーで表示する内容をウィジェットで指定します',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wpro_widgets_init' );

/**
 * 投稿詳細にて、「制作事例」という文字列が本文内に含まれている場合、自動でリンクを付与する
 *
 * @param string $content 現在の投稿の本文
 */
function wpro_replace_showcase_single( $content ) {
	if ( is_singular( 'post' ) && in_the_loop() && is_main_query() ) {
		$content = str_replace( 'コーヒー豆', '<a href="/beans/">コーヒー豆</a>', $content );
	}
	return $content;
}
add_filter( 'the_content', 'wpro_replace_showcase_single', 12 );

/**
 * 制作事例のアーカイブページにて、表示する事例の数を全件に変更
 *
 * @param WP_Query $query WP_Query インスタンス
 */
function wpro_show_all_posts_showcase_archive( $query ) {
	if ( ! is_admin() && $query->is_post_type_archive( 'beans' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', -1 );
	}
}
add_action( 'pre_get_posts', 'wpro_show_all_posts_showcase_archive' );

/**
 * WordPress のバージョン情報を非表示にする
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * ショートコード「related_showcase」
 *
 * @param array  $atts ショートコードに渡されたパラメータ
 * @param string $content ショートコードに囲われたテキスト（このショートコードでは利用しません）
 */
function wpro_shortcode_related_showcase( $atts, $content = null ) {
	$return = '';
	$atts   = shortcode_atts(
		array(
			'slug'   => '',
			'title'  => '関連するページ',
			'button' => '詳しく見る',
		),
		$atts
	);

	// slug の指定がない場合は何も出力しない
	if ( ! $atts['slug'] ) {
		return $return;
	}

	// 指定の slug から制作事例を取得
	$related_post_args  = array(
		'post_type'      => 'beans',
		'post_status'    => 'publish',
		'name'           => $atts['slug'],
		'posts_per_page' => 1,
	);
	$related_post_query = new WP_Query( $related_post_args );

	// 該当する制作事例がない場合は何も出力しない
	if ( ! $related_post_query->have_posts() ) {
		return $return;
	}

	$return .= '<h2>' . esc_html( $atts['title'] ) . '</h2>';
	while ( $related_post_query->have_posts() ) {
		$related_post_query->the_post();
		$return .= '<div class="wp-block-media-text is-stacked-on-mobile">';
		if ( has_post_thumbnail() ) {
			$return .= '<figure class="wp-block-media-text__media">' . get_the_post_thumbnail() . '</figure>';
		}
		$return .= '<div class="wp-block-media-text__content">';
		$return .= '<h3>' . esc_html( get_the_title() ) . '<h3>' . get_the_excerpt() . '<div class="wp-block-buttons"><div class="wp-block-button"><a class="wp-block-button__link">' . esc_html( $atts['button'] ) . '</a></div></div>';
		$return .= '</div>';
		$return .= '</div>';
	}
	wp_reset_postdata();

	return $return;
}
add_shortcode( 'related_showcase', 'wpro_shortcode_related_showcase' );



add_action('init', function(){
    register_post_type('beans',[
        'label' => 'コーヒー豆',
        'public' => true,
        'menu_icon' =>'dashicons-welcome-write-blog
        ',
        'supports' => ['thumbnail','title','editor'] ,
        'has_archive' => true,
        'show_in_rest' => true,
    ]);
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'gloval-nav' => 'グローバルナビゲーション'
    ]);
});