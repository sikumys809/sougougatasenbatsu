<?php
/**
 * inc-interview.php
 * 合格者対談 カスタムフィールド定義（Meta Box / MB Group）
 * keikyo-theme 用
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ============================================================
// フィールド生成ヘルパー
// ============================================================

function keikyo_iv_text( $id, $name, $required = false, $desc = '' ) {
    return [ 'id' => $id, 'name' => $name, 'type' => 'text', 'required' => (bool)$required, 'desc' => $desc ];
}
function keikyo_iv_textarea( $id, $name, $required = false, $desc = '', $rows = 4 ) {
    return [ 'id' => $id, 'name' => $name, 'type' => 'textarea', 'required' => (bool)$required, 'desc' => $desc, 'rows' => $rows ];
}
function keikyo_iv_url( $id, $name, $required = false, $desc = '' ) {
    return [ 'id' => $id, 'name' => $name, 'type' => 'url', 'required' => (bool)$required, 'desc' => $desc ];
}
function keikyo_iv_image( $id, $name, $desc = '' ) {
    return [ 'id' => $id, 'name' => $name, 'type' => 'single_image', 'desc' => $desc, 'force_delete' => false, 'max_file_uploads' => 1 ];
}
function keikyo_iv_group( $id, $name, $fields, $args = [] ) {
    return array_merge([
        'id'            => $id,
        'name'          => $name,
        'type'          => 'group',
        'fields'        => $fields,
        'collapsible'   => true,
        'save_state'    => true,
        'default_state' => 'expanded',
    ], $args);
}

// ============================================================
// フィールド登録
// ============================================================

add_filter( 'rwmb_meta_boxes', function( $meta_boxes ) {

    $meta_boxes[] = [
        'title'      => '合格者対談ページ設定',
        'id'         => 'keikyo_interview_settings',
        'post_types' => [ 'interview' ],
        'context'    => 'normal',
        'priority'   => 'high',
        'closed'     => false,
        'autosave'   => true,
        'fields'     => [

            // ── 1. ファーストビュー ──────────────────────────────
            keikyo_iv_group( 'hero_section', '1. ファーストビュー', [
                keikyo_iv_text(     'hero_display_title',        '本番表示用タイトル',                    true,  'フロント表示専用。記事タイトル（画面最上部のタイトル入力欄）がH1として使われます。' ),
                keikyo_iv_text(     'hero_display_subtitle',     '本番表示用サブタイトル',                true,  'フロント表示専用。通常の太さでタイトル下に表示します。' ),
                keikyo_iv_textarea( 'hero_description',          'ディスクリプション',                   false, '一覧・抜粋・SEO説明文の共通原稿として使う想定です。120〜160字目安', 4 ),
                keikyo_iv_textarea( 'hero_lead_text',            'リード文',                             true,  '300文字以内', 4 ),
                keikyo_iv_image(    'hero_image',                '合格者写真',                           '必須' ),
                keikyo_iv_text(     'hero_info_school',          '合格者簡易情報1「出身校」',             true ),
                keikyo_iv_text(     'hero_info_result',          '合格者簡易情報2「合格大学/学部/学科/専攻」', true, '学部学科専攻も記載' ),
                [
                    'id'      => 'hero_info_admission_type',
                    'name'    => '合格者簡易情報3「入試方式」',
                    'type'    => 'select',
                    'required'=> true,
                    'desc'    => '選択式',
                    'options' => [ '総合型選抜' => '総合型選抜', '学校推薦型選抜' => '学校推薦型選抜', '一般選抜' => '一般選抜' ],
                ],
                keikyo_iv_text( 'hero_info_period', '合格者簡易情報4「準備期間」', true ),
            ]),

            // ── 2. Contents ─────────────────────────────────────
            keikyo_iv_group( 'contents_section', '2. Contents', [
                keikyo_iv_text( 'contents_story',    'リアルなストーリー',   true, '50字以内' ),
                keikyo_iv_text( 'contents_inquiry',  '探究活動の作り方',     true, '50字以内' ),
                keikyo_iv_text( 'contents_reason',   '志望理由書の秘訣',     true, '50字以内' ),
                keikyo_iv_text( 'contents_strategy', '受験戦略と面接対策',   true, '50字以内' ),
                keikyo_iv_group( 'contents_recommended_items', 'こんな人におすすめ（対象明記）', [
                    keikyo_iv_text( 'recommended_text', 'こんな人におすすめ（対象明記）', true, '50字以内' ),
                ], [
                    'clone'       => true,
                    'sort_clone'  => true,
                    'collapsible' => true,
                    'group_title' => '追加文章 {#}: {recommended_text}',
                    'min_clone'   => 1,
                    'add_button'  => '追加する',
                ]),
                keikyo_iv_url( 'contents_youtube_url', '合格者対談動画', false, 'YouTube URL' ),
            ]),

            // ── 3. Key Points ────────────────────────────────────
            keikyo_iv_group( 'key_points_section', '3. Key Points', [
                keikyo_iv_text(     'key_point_1_title', '合格の決め手１タイトル', true, '30字以内' ),
                keikyo_iv_textarea( 'key_point_1_body',  '合格の決め手１本文',     true, '80字以内', 3 ),
                keikyo_iv_text(     'key_point_2_title', '合格の決め手２タイトル', true, '30字以内' ),
                keikyo_iv_textarea( 'key_point_2_body',  '合格の決め手２本文',     true, '80字以内', 3 ),
                keikyo_iv_text(     'key_point_3_title', '合格の決め手３タイトル', true, '30字以内' ),
                keikyo_iv_textarea( 'key_point_3_body',  '合格の決め手３本文',     true, '80字以内', 3 ),
            ]),

            // ── 4. Profile ───────────────────────────────────────
            keikyo_iv_group( 'profile_section', '4. Profile', [
                keikyo_iv_image(    'student_profile_image', '合格者写真' ),
                keikyo_iv_textarea( 'student_quote',          '合格者の言葉',     true,  '50字以内', 3 ),
                keikyo_iv_text(     'student_name',           '氏名',             true ),
                keikyo_iv_text(     'student_name_kana',      'ふりがな',         true ),
                keikyo_iv_text(     'student_school',         '出身高校' ),
                keikyo_iv_text(     'student_result',         '合格大学・学部',   true ),
                keikyo_iv_text(     'student_admission_type', '入試方式',         true ),
                keikyo_iv_text(     'student_first_choice',   '第一志望' ),
                keikyo_iv_text(     'student_english_score',  '英語資格' ),
                keikyo_iv_text(     'student_final_gpa',      '最終評定平均' ),
                keikyo_iv_text(     'student_club',           '部活' ),
                keikyo_iv_text(     'student_prep_period',    '準備期間' ),
                keikyo_iv_text(     'student_gpa',            '評定平均' ),
                keikyo_iv_text(     'student_other_choices',  '併願戦略' ),
                keikyo_iv_text(     'student_deviation_3',    '３教科偏差値' ),
                keikyo_iv_text(     'student_deviation_5',    '５教科偏差値' ),
                keikyo_iv_group( 'student_activity_chips', '主な活動実績', [
                    keikyo_iv_text( 'activity_chip_label', '主な活動実績', false, '20字以内' ),
                ], [
                    'clone'       => true,
                    'sort_clone'  => true,
                    'collapsible' => true,
                    'group_title' => '主な活動実績 {#}: {activity_chip_label}',
                    'add_button'  => '追加する',
                ]),
            ]),

            // ── 5. Story Timeline ────────────────────────────────
            keikyo_iv_group( 'timeline_section', '5. Story Timeline', [
                keikyo_iv_group( 'timeline_items', 'ストーリー', [
                    [
                        'id'      => 'timeline_keyword',
                        'name'    => 'ストーリーキーワード',
                        'type'    => 'select',
                        'desc'    => '選択式',
                        'options' => [
                            '原点となる体験' => '原点となる体験',
                            '最大の転機'     => '最大の転機',
                            '実績のピーク'   => '実績のピーク',
                            '合格'           => '合格',
                        ],
                    ],
                    keikyo_iv_text(     'timeline_period',     'ストーリー時期',    false, '中３冬、高１夏など' ),
                    keikyo_iv_text(     'timeline_item_title', 'ストーリータイトル', false, '25字以内' ),
                    keikyo_iv_textarea( 'timeline_item_body',  'ストーリー本文',    false, '85字以内', 4 ),
                ], [
                    'clone'       => true,
                    'sort_clone'  => true,
                    'collapsible' => true,
                    'group_title' => 'ストーリー {#}: {timeline_item_title}',
                    'add_button'  => 'ストーリーを追加',
                ]),
            ]),

            // ── 6. Message ───────────────────────────────────────
            keikyo_iv_group( 'message_section', '6. Message', [
                keikyo_iv_image( 'message_advisor_image', '塾長写真' ),
                keikyo_iv_url(   'message_youtube_url', 'YouTubeメッセージ動画', false, 'https://youtu.be/pzCY6DJS0q0?si=HaB_SUkJBjjmYRVS' ),
            ]),

            // ── 7. 下段CTA ───────────────────────────────────────
            keikyo_iv_group( 'final_cta_section', '7. 下段CTA', [
                keikyo_iv_url( 'final_cta_primary_url', 'ボタンURL', false, 'https://bit.ly/4us051J' ),
            ]),

        ],
    ];

    return $meta_boxes;
});

// ============================================================
// データ取得ヘルパー（single-interview.php から使う）
// ============================================================

function keikyo_iv_get_group( $post_id, $field_name ) {
    $group = [];
    if ( function_exists( 'rwmb_meta' ) ) {
        $val = rwmb_meta( $field_name, [], $post_id );
        if ( is_array( $val ) ) $group = $val;
    }
    $raw = get_post_meta( $post_id, $field_name, true );
    if ( is_array( $raw ) && ! empty( $raw ) ) {
        $group = empty( $group ) ? $raw : array_replace_recursive( $group, $raw );
    }
    return is_array( $group ) ? $group : [];
}

function keikyo_iv_val( $source, $key, $default = '' ) {
    if ( ! is_array( $source ) || ! array_key_exists( $key, $source ) ) return $default;
    $v = $source[$key];
    if ( is_string( $v ) ) $v = trim( $v );
    return ( '' === $v || null === $v ) ? $default : $v;
}

function keikyo_iv_image_url( $image, $size = 'large' ) {
    if ( empty( $image ) ) return '';
    if ( is_array( $image ) ) {
        if ( ! empty( $image['full_url'] ) ) return $image['full_url'];
        if ( isset( $image['sizes'][$size] ) ) return $image['sizes'][$size];
        if ( ! empty( $image['url'] ) ) return $image['url'];
        if ( ! empty( $image['ID'] ) ) return wp_get_attachment_image_url( (int)$image['ID'], 'full' ) ?: '';
    }
    if ( is_numeric( $image ) ) return wp_get_attachment_image_url( (int)$image, 'full' ) ?: '';
    return is_string( $image ) ? $image : '';
}

function keikyo_iv_normalize_repeater( $rows, $required_keys = [] ) {
    if ( ! is_array( $rows ) ) return [];
    $out = [];
    foreach ( $rows as $row ) {
        if ( ! is_array( $row ) ) continue;
        $ok = true;
        foreach ( $required_keys as $k ) {
            if ( '' === keikyo_iv_val( $row, $k, '' ) ) { $ok = false; break; }
        }
        if ( $ok ) $out[] = $row;
    }
    return $out;
}

// ディスクリプションを抜粋に同期
add_action( 'save_post_interview', function( $post_id ) {
    if ( wp_is_post_revision( $post_id ) || ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) ) return;
    if ( 'interview' !== get_post_type( $post_id ) ) return;

    $hero = function_exists('rwmb_meta') ? rwmb_meta('hero_section', [], $post_id) : [];
    $desc = is_array($hero) && isset($hero['hero_description']) ? trim( wp_strip_all_tags( (string)$hero['hero_description'] ) ) : '';
    if ( '' === $desc ) return;

    $post = get_post($post_id);
    if ( $desc === trim( (string)$post->post_excerpt ) ) return;

    remove_action( 'save_post_interview', __FUNCTION__, 60 );
    wp_update_post([ 'ID' => $post_id, 'post_excerpt' => $desc ]);
    add_action( 'save_post_interview', __FUNCTION__, 60 );
}, 60 );
