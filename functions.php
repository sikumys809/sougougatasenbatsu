<?php
/**
 * Keikyo Theme - functions.php
 * テーマの基盤となる全設定をこのファイルで管理する
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ============================================================
// 1. 定数定義
// ============================================================

define( 'KEIKYO_VERSION', '2.0.0' );
define( 'KEIKYO_DIR',     get_template_directory() );
define( 'KEIKYO_URI',     get_template_directory_uri() );


// ============================================================
// 2. テーマサポート
// ============================================================

add_action( 'after_setup_theme', function() {

    // 翻訳ファイル読み込み
    load_theme_textdomain( 'keikyo', KEIKYO_DIR . '/languages' );

    // 基本サポート
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style',
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // アイキャッチ画像サイズ
    add_image_size( 'keikyo-card',      640, 400, true );  // 記事カード用
    add_image_size( 'keikyo-interview', 800, 800, true );  // 合格者対談用（正方形）
    add_image_size( 'keikyo-hero',     1440, 720, true );  // LP ヒーロー用

    // ナビゲーションメニュー
    register_nav_menus( [
        'global-header' => 'グローバルヘッダー',
        'footer-main'   => 'フッターメインメニュー',
        'footer-legal'  => 'フッター法務メニュー',
    ] );

} );


// ============================================================
// 3. CSS / JS 読み込み
// ============================================================

add_action( 'wp_enqueue_scripts', function() {

    $v = KEIKYO_VERSION;

    // --- CSS ---
    wp_enqueue_style( 'keikyo-base',       KEIKYO_URI . '/assets/css/base.css',       [], $v );
    wp_enqueue_style( 'keikyo-layout',     KEIKYO_URI . '/assets/css/layout.css',     [ 'keikyo-base' ], $v );
    wp_enqueue_style( 'keikyo-components', KEIKYO_URI . '/assets/css/components.css', [ 'keikyo-layout' ], $v );

    // ページ別CSS（テンプレートファイル名をキーにして読み込み）
    $page_styles = [
        'front-page'           => 'pages/front-page.css',
        'page-about'           => 'pages/about.css',
        'page-keikyo-about'    => 'pages/about.css',
        'page-performance'     => 'pages/performance.css',
        'page-lp'              => 'pages/page-lp.css',
        'single-interview'     => 'pages/single-interview.css',
        'single'               => 'pages/single.css',
        'archive'              => 'pages/archive.css',
        'category'             => 'pages/category.css',
        'taxonomy-interview-tag' => 'pages/taxonomy-interview-tag.css',
    ];

    foreach ( $page_styles as $template => $path ) {
        if ( is_page_template( $template . '.php' )
            || ( 'front-page' === $template && is_front_page() )
            || ( 'single-interview' === $template && is_singular( 'interview' ) )
            || ( 'single' === $template && is_singular( 'post' ) )
            || ( 'archive' === $template && is_post_type_archive() )
            || ( 'category' === $template && is_category() )
            || ( 'taxonomy-interview-tag' === $template && is_tax( 'interview_tag' ) )
            || ( 'page-lp' === $template && is_page_template( 'page-lp.php' ) )
        ) {
            wp_enqueue_style( 'keikyo-' . $template, KEIKYO_URI . '/assets/css/' . $path, [ 'keikyo-components' ], $v );
        }
    }

    // --- JS ---
    // jQuery は WordPress 同梱のものを使う（wp_enqueue_script で自動登録済み）
    wp_enqueue_script( 'keikyo-main', KEIKYO_URI . '/assets/js/main.js', [ 'jquery' ], $v, true );

    // カテゴリーページのみ絞り込みJSを読み込む
    if ( is_category() || is_tax() ) {
        wp_enqueue_script( 'keikyo-filter', KEIKYO_URI . '/assets/js/category-filter.js', [ 'keikyo-main' ], $v, true );
    }

    // JS に WordPress 情報を渡す
    wp_localize_script( 'keikyo-main', 'keikyoVars', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'keikyo_nonce' ),
        'homeUrl' => home_url(),
    ] );

} );

// 管理画面用CSS
add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style( 'keikyo-admin', KEIKYO_URI . '/assets/css/admin.css', [], KEIKYO_VERSION );
} );


// ============================================================
// 4. カスタム投稿タイプ：interview（合格者対談）
// ============================================================

add_action( 'init', function() {

    register_post_type( 'interview', [
        'labels' => [
            'name'               => '合格者対談',
            'singular_name'      => '合格者対談',
            'add_new'            => '新規追加',
            'add_new_item'       => '合格者対談を追加',
            'edit_item'          => '合格者対談を編集',
            'new_item'           => '新しい合格者対談',
            'view_item'          => '合格者対談を見る',
            'search_items'       => '合格者対談を検索',
            'not_found'          => '合格者対談が見つかりません',
            'not_found_in_trash' => 'ゴミ箱に合格者対談はありません',
        ],
        'public'             => true,
        'has_archive'        => 'interview',       // /interview/ でアーカイブページを生成
        'rewrite'            => [ 'slug' => 'interview' ],
        'show_in_rest'       => true,              // ブロックエディタ対応
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-chat',
        // ★ 通常投稿と同じカテゴリーを共有する
        'taxonomies'         => [ 'category' ],
    ] );

} );


// ============================================================
// 5. カスタムタクソノミー
// ============================================================

add_action( 'init', function() {

    // --- interview_tag（合格者対談専用タグ）---
    // 通常投稿の post_tag とは別管理
    register_taxonomy( 'interview_tag', [ 'interview' ], [
        'labels' => [
            'name'              => '対談タグ',
            'singular_name'     => '対談タグ',
            'search_items'      => '対談タグを検索',
            'all_items'         => 'すべての対談タグ',
            'edit_item'         => '対談タグを編集',
            'update_item'       => '対談タグを更新',
            'add_new_item'      => '新しい対談タグを追加',
            'new_item_name'     => '新しい対談タグ名',
            'menu_name'         => '対談タグ',
        ],
        'hierarchical'      => false,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'interview-tag' ],
        'show_admin_column' => true,
    ] );

    // --- 通常投稿の post_tag は WordPress 標準のまま使う ---
    // 別途 register_taxonomy 不要

} );


// ============================================================
// 6. カテゴリーの共有設定補足
// ============================================================
// interview CPT は register_post_type の taxonomies で category を指定済み。
// カテゴリーアーカイブ（category.php）で両方の投稿タイプを取得するため、
// pre_get_posts フックでクエリを拡張する。

add_action( 'pre_get_posts', function( WP_Query $query ) {

    // 管理画面・メインクエリ以外はスキップ
    if ( is_admin() || ! $query->is_main_query() ) return;

    // カテゴリーアーカイブで interview も取得する
    if ( $query->is_category() ) {
        $query->set( 'post_type', [ 'post', 'interview' ] );
    }

    // タクソノミーアーカイブ（interview_tag）は interview のみ
    if ( $query->is_tax( 'interview_tag' ) ) {
        $query->set( 'post_type', 'interview' );
    }

} );


// ============================================================
// 7. ヘッダー・フッター切り替えヘルパー
// ============================================================
// テンプレートで get_header('lp') のように呼ぶと
// header-lp.php を読み込む。指定なしで header.php を使う。
//
// 使い方（テンプレートファイル内）:
//   get_header();        → header.php（共通）
//   get_header('lp');    → header-lp.php（LP用：ナビなし）
//   get_footer();        → footer.php（共通）
//   get_footer('lp');    → footer-lp.php（LP用：シンプル）


// ============================================================
// 8. カテゴリーページ：子カテゴリー取得ヘルパー
// ============================================================

/**
 * 現在のカテゴリーの子カテゴリーを返す
 * 記事が1件以上存在するものだけ取得（空カテゴリーを除外）
 *
 * @return WP_Term[]
 */
function keikyo_get_child_categories(): array {
    $current_cat = get_queried_object();
    if ( ! $current_cat instanceof WP_Term ) return [];

    return get_terms( [
        'taxonomy'   => 'category',
        'parent'     => $current_cat->term_id,
        'hide_empty' => true,   // 記事0件の子カテゴリーは非表示
        'orderby'    => 'name',
        'order'      => 'ASC',
    ] );
}


// ============================================================
// 9. カテゴリーページ：interview投稿取得ヘルパー
// ============================================================

/**
 * 指定カテゴリーの interview 投稿を取得する
 * category.php の「合格者対談ゾーン」で使用
 *
 * @param  int $cat_id  カテゴリーID
 * @param  int $limit   取得件数（デフォルト4件）
 * @return WP_Query
 */
function keikyo_get_interviews_by_category( int $cat_id, int $limit = 4 ): WP_Query {
    return new WP_Query( [
        'post_type'      => 'interview',
        'cat'            => $cat_id,
        'posts_per_page' => $limit,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => false,
    ] );
}


// ============================================================
// 10. パフォーマンス：不要なWordPress機能を無効化
// ============================================================

add_action( 'init', function() {
    // 絵文字スクリプトを無効化
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // oEmbed を無効化（外部スクリプト削減）
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // REST API ヘッダーを非表示（セキュリティ）
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'template_redirect', 'rest_output_link_header', 11 );
} );

// WordPress バージョン情報を非表示（セキュリティ）
add_filter( 'the_generator', '__return_empty_string' );

// 管理バーをフロントエンドで非表示（必要なら削除）
// add_filter( 'show_admin_bar', '__return_false' );


// ============================================================
// 11. カスタム投稿タイプの管理画面：カテゴリーUIを検索式に変更
// ============================================================
// カテゴリーが8,000件超えるため、チェックボックス一覧を廃止して
// 検索・選択式のUIに変更する

add_action( 'admin_head', function() {
    $screen = get_current_screen();
    if ( ! $screen ) return;
    // 対象: post・interview の編集画面
    if ( ! in_array( $screen->post_type, [ 'post', 'interview' ], true ) ) return;
    ?>
    <style>
        /* カテゴリーのチェックボックスリストを高さ制限してスクロール可能にする */
        #categorydiv .categorychecklist,
        #category-interview .categorychecklist {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
    <?php
} );


// ============================================================
// 12. SEO：カテゴリーページの title タグをカスタマイズ
// ============================================================

add_filter( 'document_title_parts', function( array $title ): array {
    if ( is_category() ) {
        $cat = get_queried_object();
        $title['title'] = $cat->name . ' の総合型選抜・AO入試情報';
    }
    if ( is_tax( 'interview_tag' ) ) {
        $term = get_queried_object();
        $title['title'] = $term->name . ' の合格者対談一覧';
    }
    return $title;
} );


// ============================================================
// 13. パーツテンプレート読み込みヘルパー
// ============================================================

/**
 * /template-parts/ 以下のテンプレートパーツを読み込む
 * 使い方: keikyo_part('card/interview', ['post' => $post])
 *
 * @param string $slug  template-parts/ 以下のパス（拡張子なし）
 * @param array  $args  テンプレートに渡す変数
 */
function keikyo_part( string $slug, array $args = [] ): void {
    get_template_part( 'template-parts/' . $slug, null, $args );
}
