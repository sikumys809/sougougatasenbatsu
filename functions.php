<?php
require_once get_template_directory() . '/inc-interview.php';
/**
 * Keikyo Theme - functions.php
 * テーマの基盤となる全設定をこのファイルで管理する
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ============================================================
// 1. 定数定義
// ============================================================

define( 'KEIKYO_VERSION', '1.0.0' );
define( 'KEIKYO_DIR',     get_template_directory() );
define( 'KEIKYO_URI',     get_template_directory_uri() );


// ============================================================
// 2. テーマサポート
// ============================================================

add_action( 'after_setup_theme', function() {

    load_theme_textdomain( 'keikyo', KEIKYO_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style',
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );

    add_image_size( 'keikyo-card',      640, 400, true );
    add_image_size( 'keikyo-interview', 800, 800, true );
    add_image_size( 'keikyo-hero',     1440, 720, true );

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

    wp_enqueue_style( 'keikyo-base',       KEIKYO_URI . '/assets/css/base.css',       [], $v );
    wp_enqueue_style( 'keikyo-layout',     KEIKYO_URI . '/assets/css/layout.css',     [ 'keikyo-base' ], $v );
    wp_enqueue_style( 'keikyo-components', KEIKYO_URI . '/assets/css/components.css', [ 'keikyo-layout' ], $v );

    $page_styles = [
        'front-page'             => 'pages/front-page.css',
        'page-about'             => 'pages/about.css',
        'page-keikyo-about'      => 'pages/about.css',
        'page-lp'                => 'pages/page-lp.css',
        'page-navi'              => 'pages/navi.css',
        'template-diagnosis'     => 'pages/diagnosis.css',
        'page-performance'       => 'pages/performance.css',
        'page-gokakusha-jisseki-lp' => 'pages/performance.css',
        'single-interview'       => 'pages/single-interview.css',
        'archive-interview'      => 'pages/interview.css',
        'single'                 => 'pages/single.css',
        'page'                   => 'pages/single.css',  // ← 固定ページ汎用
        'archive'                => 'pages/archive.css',
        'category'               => 'pages/category.css',
        'tag'                    => 'pages/tag.css',
        'taxonomy-interview-tag' => 'pages/taxonomy-interview-tag.css',
    ];

    foreach ( $page_styles as $template => $path ) {
        if ( is_page_template( $template . '.php' )
            || ( 'front-page' === $template && is_front_page() )
            || ( 'single-interview' === $template && is_singular( 'interview' ) )
            || ( 'archive-interview' === $template && is_post_type_archive( 'interview' ) )
            || ( 'single' === $template && is_singular( 'post' ) )
            || ( 'page' === $template && is_page() && ! is_page_template() )  // ← 追加
            || ( 'archive' === $template && is_post_type_archive() )
            || ( 'category' === $template && is_category() )
            || ( 'tag' === $template && is_tag() )
            || ( 'taxonomy-interview-tag' === $template && is_tax( 'interview_tag' ) )
            || ( 'page-lp' === $template && is_page_template( 'page-lp.php' ) )
        ) {
            wp_enqueue_style( 'keikyo-' . $template, KEIKYO_URI . '/assets/css/' . $path, [ 'keikyo-components' ], $v );
        }
    }

    wp_enqueue_script( 'keikyo-main', KEIKYO_URI . '/assets/js/main.js', [ 'jquery' ], $v, true );

    if ( is_category() || is_tax() ) {
        wp_enqueue_script( 'keikyo-filter', KEIKYO_URI . '/assets/js/category-filter.js', [ 'keikyo-main' ], $v, true );
    }

    if ( is_page_template( 'template-diagnosis.php' ) ) {
        wp_enqueue_script( 'keikyo-diagnosis', KEIKYO_URI . '/assets/js/diagnosis.js', [ 'jquery' ], $v, true );
    }

    wp_localize_script( 'keikyo-main', 'keikyoVars', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'keikyo_nonce' ),
        'homeUrl' => home_url(),
    ] );

} );

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
        'has_archive'        => 'interview',
        'rewrite'            => [ 'slug' => 'interview' ],
        'show_in_rest'       => true,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-chat',
        'taxonomies'         => [ 'category', 'post_tag' ],
    ] );

} );


// ============================================================
// 5. カスタムタクソノミー
// ============================================================

add_action( 'init', function() {

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

} );


// ============================================================
// 6. pre_get_posts：カテゴリー・タクソノミークエリ拡張
// ============================================================

add_action( 'pre_get_posts', function( WP_Query $query ) {

    if ( is_admin() || ! $query->is_main_query() ) return;

    if ( $query->is_category() ) {
        $query->set( 'post_type', [ 'post', 'interview' ] );
    }

    if ( $query->is_tax( 'interview_tag' ) ) {
        $query->set( 'post_type', 'interview' );
    }

} );


// ============================================================
// 7. ヘッダー・フッター切り替えヘルパー
// ============================================================
//   get_header();     → header.php
//   get_header('lp'); → header-lp.php
//   get_footer();     → footer.php
//   get_footer('lp'); → footer-lp.php


// ============================================================
// 8. カテゴリーページ：子カテゴリー取得ヘルパー
// ============================================================

function keikyo_get_child_categories(): array {
    $current_cat = get_queried_object();
    if ( ! $current_cat instanceof WP_Term ) return [];

    return get_terms( [
        'taxonomy'   => 'category',
        'parent'     => $current_cat->term_id,
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ] );
}


// ============================================================
// 9. カテゴリーページ：interview投稿取得ヘルパー
// ============================================================

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
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'template_redirect', 'rest_output_link_header', 11 );
} );

add_filter( 'the_generator', '__return_empty_string' );


// ============================================================
// 11. 管理画面：カテゴリーUIを検索式に変更
// ============================================================

add_action( 'admin_head', function() {
    $screen = get_current_screen();
    if ( ! $screen ) return;
    if ( ! in_array( $screen->post_type, [ 'post', 'interview' ], true ) ) return;
    ?>
    <style>
        #categorydiv .categorychecklist,
        #category-interview .categorychecklist {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
    <?php
} );


// ============================================================
// 12. SEO：title タグカスタマイズ
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

function keikyo_part( string $slug, array $args = [] ): void {
    get_template_part( 'template-parts/' . $slug, null, $args );
}

// ============================================================
// 固定ページ・投稿：SEOディスクリプション メタボックス
// ============================================================
add_action( 'add_meta_boxes', function() {
    add_meta_box(
        'keikyo_seo_description',
        'SEOディスクリプション（検索結果の説明文）',
        function( $post ) {
            $desc = get_post_meta( $post->ID, '_keikyo_seo_description', true );
            wp_nonce_field( 'keikyo_seo_desc_nonce', 'keikyo_seo_desc_nonce' );
            echo '<p style="margin-bottom:8px;color:#666;font-size:12px;">120〜160字目安。未入力の場合は抜粋が使われます。</p>';
            echo '<textarea name="keikyo_seo_description" rows="4" style="width:100%;">' . esc_textarea( $desc ) . '</textarea>';
        },
        array( 'post', 'page' ),
        'normal',
        'high'
    );
});

add_action( 'save_post', function( $post_id ) {
    if ( ! isset( $_POST['keikyo_seo_desc_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['keikyo_seo_desc_nonce'], 'keikyo_seo_desc_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( isset( $_POST['keikyo_seo_description'] ) ) {
        update_post_meta( $post_id, '_keikyo_seo_description', sanitize_textarea_field( $_POST['keikyo_seo_description'] ) );
    }
});

// ============================================================
// 管理画面でメディアアップローダーを有効化
// ============================================================
add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( $hook === 'term.php' || $hook === 'edit-tags.php' ) {
        wp_enqueue_media();
    }
});

// ============================================================
// タクソノミー：アイキャッチ画像フィールド
// 対象: category, post_tag, interview_category, interview_university, interview_admission_type
// ============================================================
$keikyo_tax_list = array( 'category', 'post_tag', 'interview_category', 'interview_university', 'interview_admission_type' );

foreach ( $keikyo_tax_list as $tax ) {
    // 新規追加フォーム
    add_action( "{$tax}_add_form_fields", function() {
        wp_nonce_field( 'keikyo_term_image_nonce', 'keikyo_term_image_nonce' );
        echo '<div class="form-field">';
        echo '<label>アイキャッチ画像</label>';
        echo '<input type="text" id="keikyo_term_image_url" name="keikyo_term_image_url" value="" style="width:80%;" placeholder="画像URL" />';
        echo '<button type="button" class="button" onclick="keikyo_open_media(\'keikyo_term_image_url\')">メディアを選択</button>';
        echo '<p class="description">一覧ページ等で使うサムネイル画像</p>';
        echo '</div>';
        echo '<script>function keikyo_open_media(field_id){var frame=wp.media({title:"画像を選択",button:{text:"この画像を使用"},multiple:false});frame.on("select",function(){var att=frame.state().get("selection").first().toJSON();document.getElementById(field_id).value=att.url;});frame.open();}</script>';
    });

    // 編集フォーム
    add_action( "{$tax}_edit_form_fields", function( $term ) {
        $img = get_term_meta( $term->term_id, 'keikyo_term_image', true );
        wp_nonce_field( 'keikyo_term_image_nonce', 'keikyo_term_image_nonce' );
        echo '<tr class="form-field"><th scope="row"><label>アイキャッチ画像</label></th><td>';
        if ( $img ) echo '<img src="' . esc_url($img) . '" style="max-width:200px;display:block;margin-bottom:8px;" />';
        echo '<input type="text" id="keikyo_term_image_url" name="keikyo_term_image_url" value="' . esc_attr($img) . '" style="width:80%;" />';
        echo '<button type="button" class="button" onclick="keikyo_open_media(\'keikyo_term_image_url\')">メディアを選択</button>';
        echo '<p class="description">一覧ページ等で使うサムネイル画像</p>';
        echo '</td></tr>';
        echo '<script>function keikyo_open_media(field_id){var frame=wp.media({title:"画像を選択",button:{text:"この画像を使用"},multiple:false});frame.on("select",function(){var att=frame.state().get("selection").first().toJSON();document.getElementById(field_id).value=att.url;});frame.open();}</script>';
    });

    // 保存
    add_action( "created_{$tax}", 'keikyo_save_term_image' );
    add_action( "edited_{$tax}", 'keikyo_save_term_image' );
}

function keikyo_save_term_image( $term_id ) {
    if ( ! isset( $_POST['keikyo_term_image_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['keikyo_term_image_nonce'], 'keikyo_term_image_nonce' ) ) return;
    if ( isset( $_POST['keikyo_term_image_url'] ) ) {
        update_term_meta( $term_id, 'keikyo_term_image', esc_url_raw( $_POST['keikyo_term_image_url'] ) );
    }
}

// ============================================================
// タクソノミー画像の取得ヘルパー
// 使い方: keikyo_get_term_image( $term_id )
// ============================================================
function keikyo_get_term_image( $term_id ) {
    return get_term_meta( $term_id, 'keikyo_term_image', true );
}
