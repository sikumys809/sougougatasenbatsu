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

$consultation_url = 'https://utage-system.com/p/02V953EOfqJm';

// LINE公式アカウント。導線ごとに mtid を分けて、どこ経由の登録かを Utage 側で見分ける。
// ※ 現状は全導線が同じIDなので、Utageで発行し直したら下の3つを差し替えること。
$line_base = 'https://utage-system.com/line/open/jtjYajI0XOEm';
$line_mtid = [
    'inline' => 'DN561e5ZtUTf', // 本文中バナー
    'gift'   => 'DN561e5ZtUTf', // 読了直後の特典CTA
    'dock'   => 'DN561e5ZtUTf', // 追従バー
];
$line_url  = static function ( $key ) use ( $line_base, $line_mtid ) {
    $id = $line_mtid[ $key ] ?? reset( $line_mtid );
    return $line_base . '?mtid=' . rawurlencode( $id );
};

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

// ── 本文の前処理（目次・章番号・本文中バナー）────────────────
$toc       = [];
$body_html = '';
if ( $has_content ) {
    $body_html = (string) apply_filters( 'the_content', $content );

    // h2 に ID と章番号を付けながら目次を作る
    $body_html = preg_replace_callback(
        '#<h2\b([^>]*)>(.*?)</h2>#is',
        static function ( $m ) use ( &$toc ) {
            $n     = count( $toc ) + 1;
            $id    = 'iv-h' . $n;
            $attrs = preg_replace( '#\s*id\s*=\s*("[^"]*"|\'[^\']*\')#i', '', $m[1] );
            $toc[] = [ 'id' => $id, 'text' => trim( wp_strip_all_tags( $m[2] ) ) ];
            return '<h2 id="' . $id . '"' . $attrs . '><span class="iv-h2num">CHAPTER '
                 . sprintf( '%02d', $n ) . '</span>' . $m[2] . '</h2>';
        },
        $body_html
    );

    // 「▶」で始まる引用は本人の言葉ではなく案内文なので、別スタイルに振り分ける
    $body_html = preg_replace_callback(
        '#<blockquote\b([^>]*)>(.*?)</blockquote>#is',
        static function ( $m ) {
            if ( false === strpos( $m[2], '▶' ) ) {
                return $m[0];
            }
            $attrs = $m[1];
            if ( preg_match( '#class\s*=\s*"#i', $attrs ) ) {
                $attrs = preg_replace( '#class\s*=\s*"([^"]*)"#i', 'class="$1 iv-note"', $attrs, 1 );
            } else {
                $attrs .= ' class="iv-note"';
            }
            return '<blockquote' . $attrs . '>' . $m[2] . '</blockquote>';
        },
        $body_html
    );

    // 本文中のLINE導線は1箇所だけ。章数の中ほどの見出し直前に差し込む。
    $h2_count = count( $toc );
    if ( $h2_count >= 3 ) {
        $banner = '<a class="iv-linebar" href="' . esc_url( $line_url( 'inline' ) ) . '" target="_blank" rel="noopener noreferrer">'
                . '<span><span class="iv-linebar__t">同じ壁で止まっている人へ</span>'
                . '<span class="iv-linebar__s">『必勝 小論文基礎問題集』ほか、電子書籍PDF全8冊をLINEで無料配布中</span></span>'
                . '<span class="iv-linebar__arw">→</span></a>';
        $parts = preg_split( '#(?=<h2\b)#i', $body_html );
        $at    = (int) ceil( $h2_count / 2 ) + 1; // $parts[0] は最初のh2より前
        if ( isset( $parts[ $at ] ) ) {
            $parts[ $at ] = $banner . $parts[ $at ];
            $body_html    = implode( '', $parts );
        }
    }
}

// 記事ナビのタブ（対象セクションが無いものは出さない）
$iv_tabs = [];
if ( $has_content )          { $iv_tabs[] = [ 'id' => 'iv-read',    'label' => '本文' ]; }
if ( ! empty( $key_points ) ) { $iv_tabs[] = [ 'id' => 'iv-summary', 'label' => 'まとめ' ]; }
if ( $p_name )                { $iv_tabs[] = [ 'id' => 'iv-profile', 'label' => 'プロフィール' ]; }
?>

<div class="iv-page">

  <?php if ( count( $iv_tabs ) > 1 ) : ?>
  <nav class="iv-navbar" id="iv-navbar" aria-label="記事内ナビゲーション">
    <div class="iv-navbar__tabs">
      <?php foreach ( $iv_tabs as $i => $tab ) : ?>
        <a class="iv-navbar__tab<?php echo 0 === $i ? ' is-on' : ''; ?>"
           href="#<?php echo esc_attr( $tab['id'] ); ?>"
           data-iv-tab="<?php echo esc_attr( $tab['id'] ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
      <?php endforeach; ?>
    </div>
    <div class="iv-navbar__progress"><div class="iv-navbar__bar" id="iv-progress"></div></div>
  </nav>
  <?php endif; ?>

  <article>

    <!-- ===== HERO ===== -->
    <div class="iv-hero">
      <div class="iv-wrap">
        <p class="iv-eyebrow">INTERVIEW ／ 合格者インタビュー</p>
        <h1 class="iv-hero__title"><?php echo esc_html( $hero_title ?: get_the_title() ); ?></h1>
        <?php if ( $hero_subtitle ) : ?>
          <p class="iv-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
        <?php endif; ?>
      </div>

      <?php if ( $hero_img_url ) : ?>
      <figure class="iv-hero__fig">
        <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php echo esc_attr( $hero_title ?: get_the_title() ); ?>" loading="eager" />
      </figure>
      <?php endif; ?>

      <div class="iv-wrap">
        <?php if ( $hero_result || $hero_type || $hero_period ) : ?>
        <div class="iv-hero__meta">
          <?php if ( $hero_result ) : ?><span class="iv-chip iv-chip--accent"><?php echo esc_html( $hero_result ); ?></span><?php endif; ?>
          <?php if ( $hero_type )   : ?><span class="iv-chip"><?php echo esc_html( $hero_type ); ?></span><?php endif; ?>
          <?php if ( $hero_period ) : ?><span class="iv-chip"><?php echo esc_html( $hero_period ); ?></span><?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="iv-byline">
          <?php if ( $p_name ) : ?><span><?php echo esc_html( $p_name ); ?>さん</span><span class="iv-byline__dot"></span><?php endif; ?>
          <span><?php echo esc_html( get_the_date( 'Y.m' ) ); ?> 取材</span>
        </div>
      </div>
    </div>

    <!-- ===== リード ===== -->
    <?php if ( $hero_lead ) : ?>
    <div class="iv-wrap iv-lede">
      <?php foreach ( array_filter( array_map( 'trim', preg_split( '/\R/u', (string) $hero_lead ) ) ) as $para ) : ?>
        <p><?php echo esc_html( $para ); ?></p>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- ===== 目次 ===== -->
    <?php if ( count( $toc ) >= 3 ) : ?>
    <div class="iv-wrap">
      <details class="iv-toc" open>
        <summary>この記事の流れ（<?php echo count( $toc ); ?>章）</summary>
        <ul class="iv-toc__list">
          <?php foreach ( $toc as $item ) : ?>
            <li><a href="#<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </details>
    </div>
    <?php endif; ?>

    <!-- ===== 本文 ===== -->
    <?php if ( $has_content ) : ?>
    <div class="iv-body" id="iv-read">
      <div class="iv-wrap">
        <div class="iv-body__content entry-content"><?php echo $body_html; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
      </div>
    </div>
    <?php endif; ?>

  </article>

  <!-- ===== 特典CTA（読了直後）===== -->
  <section class="iv-gift" id="iv-gift">
    <div class="iv-gift__shotwrap">
      <img class="iv-gift__shot"
           src="<?php echo esc_url( KEIKYO_URI . '/assets/img/line-gift-books.jpg' ); ?>"
           alt="特典の電子書籍8冊：自己分析完全攻略、必勝小論文基礎問題集、逆転合格の思考法、面接質問集50選、志望理由書大公開ほか"
           loading="lazy" width="880" height="340" />
    </div>
    <div class="iv-gift__body">
      <div class="iv-wrap">
        <div class="iv-gift__badges">
          <span class="iv-badge iv-badge--red">有料級・非売品</span>
          <span class="iv-badge iv-badge--out">全8冊・電子書籍PDF</span>
        </div>
        <h2 class="iv-gift__title">総合型選抜の「8大特典」を、<br />LINE登録だけで無料プレゼント。</h2>
        <p class="iv-gift__lead">合格者が実際に使った小論文の「型」も、面接の想定問答も、この8冊に入っています。登録したその場で、すべてPDFでお届けします。</p>
        <ul class="iv-gift__list">
          <li><b>01</b><span>武器が見つかる 自己分析完全攻略<em>／書き込み式ワークブック</em></span></li>
          <li><b>02</b><span>必勝 小論文基礎問題集<em>／プロ講師が厳選</em></span></li>
          <li><b>03</b><span>総合型選抜 逆転合格の思考法<em>／オリジナル電子書籍</em></span></li>
          <li><b>04</b><span>面接質問集50選<em>／回答例つき</em></span></li>
          <li><b>05</b><span>志望理由書 大公開<em>／実物ベース・参考例10選</em></span></li>
          <li><b>+3</b><span class="iv-gift__more">ほか3点をまとめてお届け</span></li>
        </ul>
        <a class="iv-btn-line" href="<?php echo esc_url( $line_url( 'gift' ) ); ?>" target="_blank" rel="noopener noreferrer">LINEで8大特典を受け取る</a>
        <p class="iv-gift__note">登録無料・勧誘なし・いつでも解除可能</p>
      </div>
    </div>
  </section>

  <!-- ===== 資料ゾーン ===== -->
  <div class="iv-zone">
    <div class="iv-zone__head"><p>DATA ＆ PROFILE</p></div>

    <!-- Key Points -->
    <?php if ( ! empty( $key_points ) ) : ?>
    <section class="iv-sect" id="iv-summary">
      <div class="iv-wrap">
        <p class="iv-sect__label">KEY POINTS</p>
        <h2 class="iv-sect__title">今回の合格を支えたポイント</h2>
        <ol class="iv-kp">
          <?php foreach ( $key_points as $pt ) : ?>
          <li>
            <span class="iv-kp__num"><?php echo esc_html( $pt['num'] ); ?></span>
            <div>
              <h3 class="iv-kp__title"><?php echo esc_html( $pt['title'] ); ?></h3>
              <p class="iv-kp__text"><?php echo esc_html( $pt['body'] ); ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>
    <?php endif; ?>

    <!-- この記事でわかること -->
    <?php if ( $c_story || $c_inquiry || $c_reason || $c_strategy || $youtube_id ) : ?>
    <section class="iv-sect">
      <div class="iv-wrap">
        <p class="iv-sect__label">CONTENTS</p>
        <h2 class="iv-sect__title">この記事でわかること</h2>
        <?php if ( $c_story || $c_inquiry || $c_reason || $c_strategy ) : ?>
        <ul class="iv-learn">
          <?php
          $learn_rows = [
              [ '01', 'リアルなストーリー', $c_story ],
              [ '02', '探究活動の作り方',   $c_inquiry ],
              [ '03', '志望理由書の秘訣',   $c_reason ],
              [ '04', '受験戦略と面接対策', $c_strategy ],
          ];
          foreach ( $learn_rows as $row ) :
              if ( ! $row[2] ) { continue; }
          ?>
          <li>
            <h3 class="iv-learn__title"><span><?php echo esc_html( $row[0] ); ?></span><?php echo esc_html( $row[1] ); ?></h3>
            <p class="iv-learn__text"><?php echo esc_html( $row[2] ); ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php if ( $youtube_id ) : ?>
        <div class="iv-video">
          <iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" title="合格者対談動画" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- こんな人におすすめ -->
    <?php if ( ! empty( $c_recs ) ) : ?>
    <section class="iv-sect">
      <div class="iv-wrap">
        <p class="iv-sect__label">FOR YOU</p>
        <h2 class="iv-sect__title">こんな人におすすめ</h2>
        <div class="iv-forwho">
          <ul>
            <?php foreach ( $c_recs as $rec ) : ?>
              <li><?php echo esc_html( $rec['recommended_text'] ); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- プロフィール -->
    <?php if ( $p_name ) : ?>
    <section class="iv-sect" id="iv-profile">
      <div class="iv-wrap">
        <p class="iv-sect__label">PROFILE</p>
        <h2 class="iv-sect__title">合格者プロフィール</h2>
        <div class="iv-prof__head">
          <?php if ( $p_img_url ) : ?>
            <img class="iv-prof__photo" src="<?php echo esc_url( $p_img_url ); ?>" alt="<?php echo esc_attr( $p_name ); ?>" loading="lazy" />
          <?php endif; ?>
          <div>
            <p class="iv-prof__name"><?php echo esc_html( $p_name ); ?></p>
            <?php if ( $p_kana ) : ?><p class="iv-prof__kana"><?php echo esc_html( $p_kana ); ?></p><?php endif; ?>
          </div>
        </div>
        <?php if ( $p_quote ) : ?>
          <p class="iv-prof__quote">「<?php echo esc_html( $p_quote ); ?>」</p>
        <?php endif; ?>
        <?php if ( ! empty( $p_detail_rows ) ) : ?>
        <dl class="iv-dl">
          <?php foreach ( $p_detail_rows as $row ) : ?>
            <div class="iv-dl__row">
              <dt><?php echo esc_html( $row['label'] ); ?></dt>
              <dd><?php echo esc_html( $row['value'] ); ?></dd>
            </div>
          <?php endforeach; ?>
        </dl>
        <?php endif; ?>
        <?php if ( ! empty( $p_chips ) ) : ?>
        <div class="iv-tags">
          <?php foreach ( $p_chips as $chip ) : ?>
            <span class="iv-tag"><?php echo esc_html( $chip['activity_chip_label'] ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- 年表 -->
    <?php if ( ! empty( $tl_items ) ) : ?>
    <section class="iv-sect">
      <div class="iv-wrap">
        <p class="iv-sect__label">TIMELINE</p>
        <h2 class="iv-sect__title">原体験から合格までの軌跡</h2>
        <ul class="iv-tl">
          <?php foreach ( $tl_items as $item ) : ?>
          <li>
            <?php $kw = keikyo_iv_val( $item, 'timeline_keyword' ); if ( $kw ) : ?>
              <span class="iv-tl__badge"><?php echo esc_html( $kw ); ?></span>
            <?php endif; ?>
            <?php $per = keikyo_iv_val( $item, 'timeline_period' ); if ( $per ) : ?>
              <p class="iv-tl__period"><?php echo esc_html( $per ); ?></p>
            <?php endif; ?>
            <?php $ttl = keikyo_iv_val( $item, 'timeline_item_title' ); if ( $ttl ) : ?>
              <h3 class="iv-tl__title"><?php echo esc_html( $ttl ); ?></h3>
            <?php endif; ?>
            <?php $bdy = keikyo_iv_val( $item, 'timeline_item_body' ); if ( $bdy ) : ?>
              <p class="iv-tl__text"><?php echo esc_html( $bdy ); ?></p>
            <?php endif; ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
    <?php endif; ?>

    <!-- 塾長からのメッセージ -->
    <?php if ( $msg_img_url || $msg_yt_id ) : ?>
    <section class="iv-sect">
      <div class="iv-wrap">
        <p class="iv-sect__label">MESSAGE</p>
        <h2 class="iv-sect__title">塾長からのメッセージ</h2>
        <?php if ( $msg_yt_id ) : ?>
        <div class="iv-video">
          <iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $msg_yt_id ); ?>" title="塾長からのメッセージ" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <?php endif; ?>
        <div class="iv-msg__profile">
          <?php if ( $msg_img_url ) : ?>
            <img class="iv-msg__photo" src="<?php echo esc_url( $msg_img_url ); ?>" alt="上林山 大吉" loading="lazy" />
          <?php endif; ?>
          <div>
            <p class="iv-msg__name">上林山 大吉</p>
            <p class="iv-msg__role">慶教ゼミナール 塾長</p>
          </div>
        </div>
        <p class="iv-msg__bio">京都大学経済学部に総合型選抜で合格。自身の経験をもとに、受験生一人ひとりの「言葉」を磨くサポートを行っています。</p>
        <p class="iv-msg__list-title">無料相談でできること</p>
        <ul class="iv-msg__list">
          <li>あなたの経験・成績・志望校から合格可能性を診断</li>
          <li>活動実績の整理・言語化のアドバイス</li>
          <li>志望理由書の方向性や構成案の相談</li>
          <li>面接対策のポイントと練習方法</li>
          <li>総合型選抜のスケジュールと準備計画</li>
        </ul>
      </div>
    </section>
    <?php endif; ?>

    <?php if ( $has_content ) : ?>
    <div class="iv-wrap"><a class="iv-backtop" href="#iv-read">↑ 本文に戻る</a></div>
    <?php endif; ?>
  </div><!-- /.iv-zone -->

  <!-- ===== 最終CTA（無料相談）===== -->
  <section class="iv-final">
    <div class="iv-wrap">
      <p class="iv-eyebrow">FREE CONSULTATION</p>
      <h2 class="iv-final__title">自分の経験が受験で武器になるか、話してみませんか</h2>
      <p class="iv-final__text">課外活動・部活・海外経験。何が「合格につながる強み」になるかは、一人ひとり違います。あなたの状況に合わせた最適な戦略をご提案します。</p>
      <div class="iv-final__benefits">
        <span class="iv-final__benefit">完全無料</span>
        <span class="iv-final__benefit">オンライン対応</span>
        <span class="iv-final__benefit">強引な勧誘なし</span>
      </div>
      <a class="iv-btn-out" href="<?php echo esc_url( $consultation_url ); ?>" target="_blank" rel="noopener noreferrer">無料受験相談を予約する →</a>
      <p class="iv-final__note">相談は完全無料・オンライン対応可能です</p>
    </div>
  </section>

  <!-- ===== 追従バー（LINE）===== -->
  <a class="iv-dock" id="iv-dock" href="<?php echo esc_url( $line_url( 'dock' ) ); ?>" target="_blank" rel="noopener noreferrer">
    <span class="iv-dock__shot">
      <img src="<?php echo esc_url( KEIKYO_URI . '/assets/img/line-gift-strip.jpg' ); ?>" alt="" loading="lazy" width="820" height="132" />
      <span class="iv-dock__tag">有料級・非売品</span>
    </span>
    <span class="iv-dock__row">
      <span class="iv-dock__t">
        <b>電子書籍PDF <i>全8冊</i> を無料プレゼント</b>
        自己分析・小論文・面接質問集50選ほか
      </span>
      <span class="iv-dock__btn">LINEで受け取る</span>
    </span>
  </a>

</div><!-- /.iv-page -->

<?php endwhile; get_footer(); ?>
