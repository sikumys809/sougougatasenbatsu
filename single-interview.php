<?php
/**
 * single-interview.php
 * 合格者対談 個別ページ
 * CSS: assets/css/pages/single-interview.css
 * フィールド: inc-interview.php（MetaBox）
 */

get_header();

if ( ! have_posts() ) { get_footer(); exit; }
while ( have_posts() ) : the_post();

$post_id = get_the_ID();

// ── データ取得 ────────────────────────────────────────────
$hero     = keikyo_iv_get_group( $post_id, 'hero_section' );
$contents = keikyo_iv_get_group( $post_id, 'contents_section' );
$kp       = keikyo_iv_get_group( $post_id, 'key_points_section' );
$profile  = keikyo_iv_get_group( $post_id, 'profile_section' );
$timeline = keikyo_iv_get_group( $post_id, 'timeline_section' );
$message  = keikyo_iv_get_group( $post_id, 'message_section' );
$cta_sec  = keikyo_iv_get_group( $post_id, 'final_cta_section' );

$consultation_url = 'https://bit.ly/4us051J';
$line_url         = 'https://line.me/R/ti/p/@712gzjgo'; // LINE公式アカウントURL

// Hero
$hero_title    = keikyo_iv_val( $hero, 'hero_display_title' );
$hero_subtitle = keikyo_iv_val( $hero, 'hero_display_subtitle' );
$hero_lead     = keikyo_iv_val( $hero, 'hero_lead_text' );
$hero_img_url  = keikyo_iv_image_url( keikyo_iv_val( $hero, 'hero_image', [] ), 'full' );
$hero_school   = keikyo_iv_val( $hero, 'hero_info_school' );
$hero_result   = keikyo_iv_val( $hero, 'hero_info_result' );
$hero_type     = keikyo_iv_val( $hero, 'hero_info_admission_type' );
$hero_period   = keikyo_iv_val( $hero, 'hero_info_period' );

// Contents
$c_story    = keikyo_iv_val( $contents, 'contents_story' );
$c_inquiry  = keikyo_iv_val( $contents, 'contents_inquiry' );
$c_reason   = keikyo_iv_val( $contents, 'contents_reason' );
$c_strategy = keikyo_iv_val( $contents, 'contents_strategy' );
$c_youtube  = keikyo_iv_val( $contents, 'contents_youtube_url' );
$c_recs     = keikyo_iv_normalize_repeater( keikyo_iv_val( $contents, 'contents_recommended_items', [] ), ['recommended_text'] );
$youtube_id = '';
if ( $c_youtube && preg_match( '#(?:youtu\.be/|v=|embed/|shorts/)([A-Za-z0-9_-]{11})#', $c_youtube, $m ) ) {
    $youtube_id = $m[1];
}

// Key Points
$key_points = [];
foreach ( [
    [ 'num' => '01', 'title_key' => 'key_point_1_title', 'body_key' => 'key_point_1_body' ],
    [ 'num' => '02', 'title_key' => 'key_point_2_title', 'body_key' => 'key_point_2_body' ],
    [ 'num' => '03', 'title_key' => 'key_point_3_title', 'body_key' => 'key_point_3_body' ],
] as $kp_def ) {
    $t = keikyo_iv_val( $kp, $kp_def['title_key'] );
    $b = keikyo_iv_val( $kp, $kp_def['body_key'] );
    if ( $t && $b ) $key_points[] = [ 'num' => $kp_def['num'], 'title' => $t, 'body' => $b ];
}

// Profile
$p_img_url     = keikyo_iv_image_url( keikyo_iv_val( $profile, 'student_profile_image', [] ), 'large' );
$p_quote       = keikyo_iv_val( $profile, 'student_quote' );
$p_name        = keikyo_iv_val( $profile, 'student_name' );
$p_kana        = keikyo_iv_val( $profile, 'student_name_kana' );
$p_chips       = keikyo_iv_normalize_repeater( keikyo_iv_val( $profile, 'student_activity_chips', [] ), [] );
$p_detail_rows = [];
foreach ( [
    '出身高校' => 'student_school', '合格大学・学部' => 'student_result',
    '入試方式' => 'student_admission_type', '第一志望' => 'student_first_choice',
    '英語資格' => 'student_english_score', '評定平均' => 'student_gpa',
    '最終評定平均' => 'student_final_gpa', '部活' => 'student_club',
    '準備期間' => 'student_prep_period', '併願戦略' => 'student_other_choices',
    '３教科偏差値' => 'student_deviation_3', '５教科偏差値' => 'student_deviation_5',
] as $label => $key ) {
    $v = keikyo_iv_val( $profile, $key );
    if ( $v ) $p_detail_rows[] = [ 'label' => $label, 'value' => $v ];
}

// Timeline
$tl_items = [];
foreach ( (array) keikyo_iv_val( $timeline, 'timeline_items', [] ) as $row ) {
    if ( ! is_array( $row ) ) continue;
    if ( keikyo_iv_val($row,'timeline_keyword') || keikyo_iv_val($row,'timeline_item_title') || keikyo_iv_val($row,'timeline_item_body') ) {
        $tl_items[] = $row;
    }
}

// Message
$msg_img_url = keikyo_iv_image_url( keikyo_iv_val( $message, 'message_advisor_image', [] ), 'medium_large' );
$msg_youtube = keikyo_iv_val( $message, 'message_youtube_url' );
$msg_yt_id   = '';
if ( $msg_youtube && preg_match( '#(?:youtu\.be/|v=|embed/|shorts/)([A-Za-z0-9_-]{11})#', $msg_youtube, $m ) ) {
    $msg_yt_id = $m[1];
}

// 本文
$content = get_post_field( 'post_content', $post_id );
$has_content = '' !== trim( wp_strip_all_tags( (string)$content ) );
?>

<div class="iv-page">

  <!-- ===== HERO ===== -->
  <section class="iv-hero">
    <div class="iv-shell iv-hero__inner">
      <div class="iv-hero__content">
        <p class="iv-hero__label">Interview Feature / 合格者インタビュー</p>
        <?php if ( $hero_title ) : ?>
          <h1 class="iv-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
        <?php else : ?>
          <h1 class="iv-hero__title"><?php the_title(); ?></h1>
        <?php endif; ?>
        <?php if ( $hero_subtitle ) : ?>
          <p class="iv-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
        <?php endif; ?>
        <?php if ( $hero_lead ) : ?>
          <p class="iv-hero__lead"><?php echo nl2br( esc_html( $hero_lead ) ); ?></p>
        <?php endif; ?>
        <div class="iv-hero__cta">
          <a href="#iv-contents" class="iv-btn iv-btn--navy">記事を読む ↓</a>
          <a href="<?php echo esc_url( $consultation_url ); ?>" class="iv-btn iv-btn--red" target="_blank" rel="noopener noreferrer">無料相談を見る →</a>
        </div>
        <p class="iv-hero__scroll">↓ SCROLL</p>
      </div>
      <div class="iv-hero__visual">
        <?php if ( $hero_img_url ) : ?>
          <div class="iv-hero__photo">
            <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php echo esc_attr( $hero_title ?: get_the_title() ); ?>" loading="eager" />
          </div>
        <?php else : ?>
          <div class="iv-hero__photo iv-hero__photo--placeholder">PHOTO</div>
        <?php endif; ?>
        <?php if ( $hero_school || $hero_result || $hero_type || $hero_period ) : ?>
        <div class="iv-hero__info-card">
          <dl>
            <?php if ( $hero_school )  : ?><dt>出身高校</dt><dd><?php echo esc_html( $hero_school ); ?></dd><?php endif; ?>
            <?php if ( $hero_result )  : ?><dt>合格先</dt><dd><?php echo esc_html( $hero_result ); ?></dd><?php endif; ?>
            <?php if ( $hero_type )    : ?><dt>入試方式</dt><dd><?php echo esc_html( $hero_type ); ?></dd><?php endif; ?>
            <?php if ( $hero_period )  : ?><dt>準備期間</dt><dd><?php echo esc_html( $hero_period ); ?></dd><?php endif; ?>
          </dl>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ===== INLINE CTA（無料相談）===== -->
  <section class="iv-inline-cta">
    <div class="iv-shell iv-inline-cta__inner">
      <p class="iv-inline-cta__text">総合型選抜について、まず無料で相談してみませんか？</p>
      <a href="<?php echo esc_url( $consultation_url ); ?>" class="iv-btn iv-btn--red" target="_blank" rel="noopener noreferrer">無料受験相談を申し込む →</a>
    </div>
  </section>

  <!-- ===== CONTENTS ===== -->
  <?php if ( $c_story || $c_inquiry || $c_reason || $c_strategy ) : ?>
  <section class="iv-contents" id="iv-contents">
    <div class="iv-shell">
      <div class="iv-contents__header">
        <p class="iv-eyebrow">Contents</p>
        <h2 class="iv-section-title">この記事でわかること</h2>
      </div>
      <div class="iv-contents__grid">
        <?php if ( $c_story )    : ?><div class="iv-contents__card"><div class="iv-contents__card-icon">◫</div><h3 class="iv-contents__card-title">リアルなストーリー</h3><p class="iv-contents__card-text"><?php echo esc_html( $c_story ); ?></p></div><?php endif; ?>
        <?php if ( $c_inquiry )  : ?><div class="iv-contents__card"><div class="iv-contents__card-icon">◌</div><h3 class="iv-contents__card-title">探究活動の作り方</h3><p class="iv-contents__card-text"><?php echo esc_html( $c_inquiry ); ?></p></div><?php endif; ?>
        <?php if ( $c_reason )   : ?><div class="iv-contents__card"><div class="iv-contents__card-icon">▣</div><h3 class="iv-contents__card-title">志望理由書の秘訣</h3><p class="iv-contents__card-text"><?php echo esc_html( $c_reason ); ?></p></div><?php endif; ?>
        <?php if ( $c_strategy ) : ?><div class="iv-contents__card"><div class="iv-contents__card-icon">◎</div><h3 class="iv-contents__card-title">受験戦略と面接対策</h3><p class="iv-contents__card-text"><?php echo esc_html( $c_strategy ); ?></p></div><?php endif; ?>
      </div>
      <?php if ( $youtube_id || ! empty( $c_recs ) ) : ?>
      <div class="iv-contents__bottom<?php echo ! $youtube_id ? ' iv-contents__bottom--no-video' : ''; ?>">
        <?php if ( $youtube_id ) : ?>
        <div class="iv-contents__video">
          <iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" title="合格者対談動画" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $c_recs ) ) : ?>
        <div class="iv-contents__recommend">
          <h3>こんな人におすすめ</h3>
          <ul>
            <?php foreach ( $c_recs as $rec ) : ?>
              <li><?php echo esc_html( $rec['recommended_text'] ); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== KEY POINTS ===== -->
  <?php if ( ! empty( $key_points ) ) : ?>
  <section class="iv-keypoints">
    <div class="iv-shell">
      <div class="iv-keypoints__header">
        <p class="iv-eyebrow iv-eyebrow--red">Key Points</p>
        <h2 class="iv-section-title iv-section-title--white">今回の合格を支えたポイント</h2>
      </div>
      <div class="iv-keypoints__grid">
        <?php foreach ( $key_points as $pt ) : ?>
        <div class="iv-keypoints__card">
          <span class="iv-keypoints__card-num"><?php echo esc_html( $pt['num'] ); ?></span>
          <p class="iv-keypoints__card-label">Point <?php echo esc_html( $pt['num'] ); ?></p>
          <h3 class="iv-keypoints__card-title"><?php echo esc_html( $pt['title'] ); ?></h3>
          <p class="iv-keypoints__card-text"><?php echo esc_html( $pt['body'] ); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== PROFILE ===== -->
  <?php if ( $p_name ) : ?>
  <section class="iv-profile">
    <div class="iv-shell">
      <div class="iv-profile__header">
        <p class="iv-eyebrow">Profile</p>
        <h2 class="iv-section-title">合格者プロフィール</h2>
      </div>
      <div class="iv-profile__inner">
        <div class="iv-profile__visual">
          <?php if ( $p_img_url ) : ?>
            <div class="iv-profile__photo"><img src="<?php echo esc_url( $p_img_url ); ?>" alt="<?php echo esc_attr( $p_name ); ?>" loading="lazy" /></div>
          <?php else : ?>
            <div class="iv-profile__photo iv-profile__photo--placeholder">PHOTO</div>
          <?php endif; ?>
          <?php if ( $p_quote ) : ?>
            <blockquote class="iv-profile__quote">「<?php echo esc_html( $p_quote ); ?>」</blockquote>
          <?php endif; ?>
        </div>
        <div class="iv-profile__info">
          <h3 class="iv-profile__name"><?php echo esc_html( $p_name ); ?></h3>
          <?php if ( $p_kana ) : ?><p class="iv-profile__furigana"><?php echo esc_html( $p_kana ); ?></p><?php endif; ?>
          <?php if ( ! empty( $p_detail_rows ) ) : ?>
          <div class="iv-profile__table">
            <dl>
              <?php foreach ( $p_detail_rows as $row ) : ?>
                <dt><?php echo esc_html( $row['label'] ); ?></dt>
                <dd><?php echo esc_html( $row['value'] ); ?></dd>
              <?php endforeach; ?>
            </dl>
          </div>
          <?php endif; ?>
          <?php if ( ! empty( $p_chips ) ) : ?>
          <div class="iv-profile__chips">
            <?php foreach ( $p_chips as $chip ) : ?>
              <span class="iv-profile__chip"><?php echo esc_html( $chip['activity_chip_label'] ); ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== INLINE CTA（LINE）===== -->
  <section class="iv-inline-cta iv-inline-cta--line">
    <div class="iv-shell iv-inline-cta__inner">
      <div class="iv-inline-cta__left">
        <span class="iv-inline-cta__icon">💬</span>
        <div>
          <p class="iv-inline-cta__text">公式LINEで合格情報を受け取る</p>
          <p class="iv-inline-cta__sub">合格事例・対策情報を無料配信中</p>
        </div>
      </div>
      <a href="<?php echo esc_url( $line_url ); ?>" class="iv-btn iv-btn--white-line" target="_blank" rel="noopener noreferrer">LINE登録はこちら →</a>
    </div>
  </section>

  <!-- ===== ARTICLE BODY（本文）===== -->
  <?php if ( $has_content ) : ?>
  <section class="iv-article-body">
    <div class="iv-shell">
      <div class="iv-article-body__header">
        <p class="iv-eyebrow">Story</p>
        <h2 class="iv-section-title">合格者のストーリー</h2>
      </div>
      <div class="iv-article-body__content entry-content">
        <?php echo apply_filters( 'the_content', $content ); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== INLINE CTA（無料相談・再掲）===== -->
  <section class="iv-inline-cta">
    <div class="iv-shell iv-inline-cta__inner">
      <p class="iv-inline-cta__text">総合型選抜について、まず無料で相談してみませんか？</p>
      <a href="<?php echo esc_url( $consultation_url ); ?>" class="iv-btn iv-btn--red" target="_blank" rel="noopener noreferrer">無料受験相談を申し込む →</a>
    </div>
  </section>

  <!-- ===== STORY TIMELINE ===== -->
  <?php if ( ! empty( $tl_items ) ) : ?>
  <section class="iv-timeline">
    <div class="iv-shell">
      <div class="iv-timeline__header">
        <p class="iv-eyebrow">Story Timeline</p>
        <h2 class="iv-section-title">原体験から合格までの軌跡</h2>
      </div>
      <div class="iv-timeline__track">
        <?php foreach ( $tl_items as $i => $item ) : ?>
        <div class="iv-timeline__item">
          <div class="iv-timeline__card">
            <?php $kw = keikyo_iv_val($item,'timeline_keyword'); if($kw): ?><span class="iv-timeline__badge"><?php echo esc_html($kw); ?></span><?php endif; ?>
            <?php $per = keikyo_iv_val($item,'timeline_period'); if($per): ?><p class="iv-timeline__period"><?php echo esc_html($per); ?></p><?php endif; ?>
            <?php $ttl = keikyo_iv_val($item,'timeline_item_title'); if($ttl): ?><h3 class="iv-timeline__title"><?php echo esc_html($ttl); ?></h3><?php endif; ?>
            <?php $bdy = keikyo_iv_val($item,'timeline_item_body'); if($bdy): ?><p class="iv-timeline__text"><?php echo esc_html($bdy); ?></p><?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== MESSAGE ===== -->
  <?php if ( $msg_img_url || $msg_yt_id ) : ?>
  <section class="iv-message">
    <div class="iv-shell">
      <div class="iv-message__header">
        <p class="iv-eyebrow">Message</p>
        <h2 class="iv-section-title">塾長からのメッセージ</h2>
      </div>
      <div class="iv-message__inner">
        <?php if ( $msg_yt_id ) : ?>
        <div class="iv-message__video">
          <iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $msg_yt_id ); ?>" title="塾長からのメッセージ" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <?php else : ?>
        <div class="iv-message__video iv-message__video--placeholder">動画</div>
        <?php endif; ?>
        <div class="iv-message__content">
          <div class="iv-message__profile">
            <?php if ( $msg_img_url ) : ?>
              <div class="iv-message__photo"><img src="<?php echo esc_url( $msg_img_url ); ?>" alt="上林山 大吉" loading="lazy" /></div>
            <?php else : ?>
              <div class="iv-message__photo iv-message__photo--placeholder">PHOTO</div>
            <?php endif; ?>
            <div>
              <h3 class="iv-message__name">上林山 大吉</h3>
              <p class="iv-message__role">慶教ゼミナール 塾長</p>
            </div>
          </div>
          <p class="iv-message__bio">京都大学経済学部に総合型選抜で合格。自身の経験をもとに、受験生一人ひとりの「言葉」を磨くサポートを行っています。</p>
          <p class="iv-message__list-title">無料相談でできること</p>
          <ul class="iv-message__list">
            <li>あなたの経験・成績・志望校から合格可能性を診断</li>
            <li>活動実績の整理・言語化のアドバイス</li>
            <li>志望理由書の方向性や構成案の相談</li>
            <li>面接対策のポイントと練習方法</li>
            <li>総合型選抜のスケジュールと準備計画</li>
          </ul>
        </div>
      </div>
      <div class="iv-message__cta">
        <a href="<?php echo esc_url( $consultation_url ); ?>" class="iv-btn iv-btn--red-large" target="_blank" rel="noopener noreferrer">無料受験相談を申し込む →</a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== FINAL CTA ===== -->
  <section class="iv-final-cta">
    <div class="iv-shell">
      <div class="iv-final-cta__line"></div>
      <p class="iv-eyebrow">Free Consultation</p>
      <h2 class="iv-final-cta__title">無料受験相談のお申込みはこちら</h2>
      <p class="iv-final-cta__text">総合型選抜について、まずは無料で相談してみませんか？あなたの状況に合わせた最適な戦略をご提案します。</p>
      <div class="iv-final-cta__benefits">
        <span class="iv-final-cta__benefit">完全無料</span>
        <span class="iv-final-cta__benefit">オンライン対応</span>
        <span class="iv-final-cta__benefit">強引な勧誘なし</span>
      </div>
      <a href="<?php echo esc_url( $consultation_url ); ?>" class="iv-btn iv-btn--red-large" target="_blank" rel="noopener noreferrer">無料受験相談を申し込む →</a>
      <p class="iv-final-cta__note">相談は完全無料・オンライン対応可能です</p>
    </div>
  </section>

</div><!-- /.iv-page -->

<?php endwhile; get_footer(); ?>
