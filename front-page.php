<?php
/**
 * front-page.php - 採用版（v0-adopted完全対応）
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$consultation_url = 'https://lp.keikyo-seminar.jp/main01/';
$line_url         = 'https://lin.ee/XXXXXXX';
$diagnosis_url    = home_url( '/diagnosis/' );
$performance_url  = home_url( '/performance/' );
$about_url        = home_url( '/about/' );
$stories_url      = home_url( '/interview/' );
$nav_url          = home_url( '/archives/category/navigation/' );

$stories_query = new WP_Query([
    'post_type'      => 'interview',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
]);

$nav_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
    'category_name'  => 'navigation',
]);

get_header();
?>
<main>

<!-- HEADER -->

<!-- SECTION 01: HERO -->
<section class="hero">
  <div class="shell hero__inner">
    <div class="hero__content">
      <span class="hero__badge">総合型選抜専門 × 完全オンライン</span>
      <h1 class="hero__h1">塾が近くになくても、</h1>
      <h1 class="hero__h1 hero__h1--accent">難関大学に合格できる。</h1>
      <p class="hero__sub">完全オンライン × 総合型選抜専門。現役合格率100%。</p>
      <p class="hero__lead">沖縄・小笠原・北海道・山陰——「近くに総合型選抜の塾がない」地域から、毎年問い合わせが届き、合格者が生まれている。慶教ゼミナールは完全オンラインだから、「近くに良い塾がない」という地域格差を根本からなくす。全国から受験生が集まるから、本当のライバルとの差が分かり、東京と同じ質の戦略が、どこにいても作れる。</p>
      <div class="hero__stats">
        <div class="hero__stat"><div class="hero__stat-value">100%</div><div class="hero__stat-label">現役合格率</div></div>
        <div class="hero__stat"><div class="hero__stat-value">93.3%</div><div class="hero__stat-label">難関大学合格率</div></div>
        <div class="hero__stat"><div class="hero__stat-value">全国</div><div class="hero__stat-label">離島・地方からも合格実績</div></div>
      </div>
      <div class="hero__cta">
        <a href="<?php echo esc_url($consultation_url); ?>" class="btn btn--red" target="_blank" rel="noopener noreferrer">無料受験相談を予約する →</a>
        <a href="<?php echo esc_url($about_url); ?>" class="btn btn--outline-light">慶教ゼミナールとは？ →</a>
      </div>
      <p class="hero__meta">完全無料　登録不要　日本全国対応</p>
    </div>
    <div class="hero__visual">
      <div class="hero-slideshow" id="heroSlideshow">
        <?php for ( $i = 1; $i <= 6; $i++ ) : $active = $i === 1 ? ' hero-slide--active' : ''; ?>
        <div class="hero-slide<?php echo $active; ?>">
          <div class="hero-slide__placeholder">PHOTO <?php echo $i; ?> / 6</div>
        </div>
        <?php endfor; ?>
        <div class="hero-slide__dots">
          <?php for ( $i = 0; $i < 6; $i++ ) : ?>
          <span class="dot<?php echo $i === 0 ? ' dot--active' : ''; ?>"></span>
          <?php endfor; ?>
        </div>
      </div>
      <div class="hero__overlay-card">
        <div class="hero__card-kicker">Editorial mentorship</div>
        <p class="hero__card-text">受験準備を、単なる対策ではなく「自分の言葉を磨く時間」へ。</p>
        <div class="hero__card-stats">
          <div><span class="hero__card-value">100%</span><span class="hero__card-label">現役合格率</span></div>
          <div><span class="hero__card-value">93.3%</span><span class="hero__card-label">難関大合格率</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 02: WHY ONLINE WINS -->
<section class="why-online">
  <div class="shell why-online__inner">
    <div class="why-online__heading">
      <p class="kicker">Why Online Wins</p>
      <h2 class="why-online__h2">近くに塾がなくても、<span>全国基準</span>で戦える理由。</h2>
      <p class="why-online__lead">総合型選抜は相対評価の入試。だから全国の受験生と一緒に学ぶことが、正確な現在地の把握につながる。校舎型の塾では得られない視点がある。</p>
    </div>
    <div>
      <div class="why-online__cards">
        <div class="compare-card compare-card--gray">
          <div class="compare-card__header">
            <span class="compare-card__label">地方の一般塾</span>
            <span class="compare-badge compare-badge--ng">× 非専門</span>
          </div>
          <p class="compare-card__text">総合型選抜の専門知識がない。近隣の生徒としか比較できず、全国での立ち位置が分からない。</p>
        </div>
        <div class="compare-card compare-card--dark">
          <div class="compare-card__header">
            <span class="compare-card__label">校舎型の総合型専門塾</span>
            <span class="compare-badge compare-badge--mid">△ 地域限定</span>
          </div>
          <p class="compare-card__text">通える地域が限定される。近隣の生徒のみのため、全国レベルの相対評価ができない。</p>
        </div>
        <div class="compare-card compare-card--red">
          <div class="compare-card__header">
            <span class="compare-card__label" style="color:#c0392b;">慶教ゼミナール</span>
            <span class="compare-badge compare-badge--ok">◎ 全国対応</span>
          </div>
          <p class="compare-card__text">全国から受験生が集まるオンライン専門塾。どこに住んでいても全国基準で現在地を把握し、難関大学合格への最短ルートを設計できる。</p>
        </div>
      </div>
      <div class="why-online__cta">
        <a href="<?php echo esc_url($consultation_url); ?>" class="btn btn--red" target="_blank" rel="noopener noreferrer">無料受験相談を予約する →</a>
        <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line" target="_blank" rel="noopener noreferrer">LINEで合格バイブル6点を無料受け取り →</a>
      </div>
    </div>
  </div>
</section>

<!-- STATS TICKER ① -->
<div class="stats-ticker">
  <div class="shell stats-ticker__inner">
    <div class="stats-ticker__item"><span class="stats-ticker__value">100%</span><span class="stats-ticker__label">現役合格率</span></div>
    <div class="stats-ticker__divider">|</div>
    <div class="stats-ticker__item"><span class="stats-ticker__value">93.3%</span><span class="stats-ticker__label">難関大学合格率</span></div>
    <div class="stats-ticker__divider">|</div>
    <div class="stats-ticker__item"><span class="stats-ticker__value">全国</span><span class="stats-ticker__label">47都道府県対応</span></div>
    <div class="stats-ticker__divider">|</div>
    <div class="stats-ticker__item"><span class="stats-ticker__value">1対1</span><span class="stats-ticker__label">伴走型個別指導</span></div>
  </div>
</div>

<!-- SECTION 03: PERFORMANCE -->
<section class="performance">
  <div class="shell performance__inner">
    <div class="performance__heading">
      <p class="kicker">Performance</p>
      <h2 class="performance__h2">数字だけで終わらせない、<span>戦略と伴走の実績</span>。</h2>
      <p class="performance__text">早慶上理、難関国公立、MARCH、芸術系まで。オンラインだから全国から集まる受験生と切磋琢磨し、本番レベルの準備ができる。</p>
      <blockquote class="performance__quote">「総合型選抜経験 × 社会人経験」を持つ伴走者が、受験生の背景を単なるプロフィール情報ではなく、志望理由書や面接で届く強みに再編集することが、慶教ゼミナールの核です。</blockquote>
      <a href="<?php echo esc_url($performance_url); ?>" class="performance__link">合格実績を見る →</a>
    </div>
    <div class="performance__metrics">
      <div class="metric-card">
        <div class="metric-card__value">100%</div>
        <div class="metric-card__content"><p class="metric-card__label">現役合格率</p><p class="metric-card__note">基礎固めから出願設計まで一貫して支援</p></div>
      </div>
      <div class="metric-card">
        <div class="metric-card__value">93.3%</div>
        <div class="metric-card__content"><p class="metric-card__label">難関大学合格率</p><p class="metric-card__note">早慶上理・難関国公立・MARCHまで対応</p></div>
      </div>
      <div class="metric-card">
        <div class="metric-card__value">1対1</div>
        <div class="metric-card__content"><p class="metric-card__label">伴走型個別指導</p><p class="metric-card__note">対話を通じて言葉と戦略を磨く</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 大学ロゴスライダー -->
<div class="university-logo-slider-wrapper">
  <p class="university-logo-slider__label">合格実績大学（一部）</p>
  <div class="university-logo-track">
    <?php
    $universities = ['慶應義塾大学','早稲田大学','上智大学','東京理科大学','明治大学','青山学院大学','立教大学','中央大学','法政大学','同志社大学','関西学院大学','立命館大学','広島大学','大阪公立大学','京都府立大学','関西大学'];
    foreach ( array_merge($universities,$universities) as $u ) :
    ?><div class="university-logo-card"><?php echo esc_html($u); ?></div><?php endforeach; ?>
  </div>
</div>

<!-- SECTION 04: INSTRUCTORS -->
<section class="instructors">
  <div class="shell">
    <div class="instructors__heading">
      <p class="kicker instructors__kicker">Instructors</p>
      <h2 class="instructors__h2">総合型選抜を<span>自ら経験した</span>講師が伴走する。</h2>
      <p class="instructors__lead">「受験だけ知ってる人」ではなく、その先の社会まで知っている人間が教える。それが慶教ゼミナールの根本にある。</p>
    </div>
    <div class="instructors__grid">
      <?php
      $instructors = [
        ['role'=>'塾長','name'=>'上林山 大吉','badge'=>'京都大学 経済学部 総合型選抜入学','bio'=>'自分が総合型選抜で京都大学に入った立場から、受験生の不安を一次情報ベースで解決する。進路設計・出願戦略の全体を俯瞰して伴走。','img'=>'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/%E4%B8%8A%E6%9E%97%E5%B1%B1%E5%A4%A7%E5%90%89.png'],
        ['role'=>'講師','name'=>'水野 永吉','badge'=>'慶應高校推薦入試2期生・会社経営17年','bio'=>'推薦入試の経験と17年の経営経験を持つ。受験だけでなく「社会で通じる力」も見据えた指導で、受験生の経験を伝わる言葉へ変える。','img'=>'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/%E6%B0%B4%E9%87%8E%E6%B0%B8%E5%90%89.png'],
        ['role'=>'講師','name'=>'神崎 真桜','badge'=>'元アクセンチュア株式会社','bio'=>'世界最大のコンサルティングファームで培った言語化・論理構成の技術を志望理由書に全て使う。「伝わる言葉」を作る専門家。','img'=>'https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/%E7%A5%9E%E5%B4%8E%E7%9C%9F%E6%A1%9C.png'],
      ];
      foreach ( $instructors as $inst ) : ?>
      <div class="instructor-card">
        <div class="instructor-card__photo">
          <?php if (!empty($inst['img'])) : ?><img src="<?php echo esc_url($inst['img']); ?>" alt="<?php echo esc_attr($inst['name']); ?>"><?php else : ?>PHOTO<?php endif; ?>
        </div>
        <div class="instructor-card__content">
          <p class="instructor-card__role"><?php echo esc_html($inst['role']); ?></p>
          <p class="instructor-card__name"><?php echo esc_html($inst['name']); ?></p>
          <span class="instructor-card__badge"><?php echo esc_html($inst['badge']); ?></span>
          <p class="instructor-card__bio"><?php echo esc_html($inst['bio']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="instructor-timeline">
      <div class="timeline-track">
        <div class="timeline-node"><div class="timeline-node__dot"></div><div class="timeline-node__label">京大<br>総合型合格</div></div>
        <div class="timeline-line"></div>
        <div class="timeline-node"><div class="timeline-node__dot"></div><div class="timeline-node__label">慶應<br>推薦入試</div></div>
        <div class="timeline-line"></div>
        <div class="timeline-node"><div class="timeline-node__dot"></div><div class="timeline-node__label">アクセンチュア<br>入社</div></div>
        <div class="timeline-line"></div>
        <div class="timeline-node timeline-node--current"><div class="timeline-node__dot timeline-node__dot--red"></div><div class="timeline-node__label" style="color:#c0392b;font-weight:600;">慶教ゼミナール<br>創設</div></div>
      </div>
      <p class="timeline-caption">受験経験 × 社会人経験 × コンサル知見。3つの強みが慶教ゼミナールに集結。</p>
    </div>
    <div class="instructors__cta">
      <a href="<?php echo esc_url($about_url); ?>" class="btn btn--outline-light">慶教ゼミナールについて詳しく見る</a>
    </div>
  </div>
</section>

<!-- SECTION 05: STORIES -->
<section class="stories">
  <div class="shell">
    <div class="stories__header">
      <div>
        <p class="kicker">Success Stories</p>
        <h2 class="stories__h2">合格者のリアルから、<span>自分の戦略</span>を学ぶ。</h2>
        <p class="stories__sub">数字だけでは伝わらない、合格までの思考・行動・逆転の記録。先輩たちのストーリーが、あなたの地図になる。</p>
      </div>
      <a href="<?php echo esc_url($stories_url); ?>" class="stories__link">合格者ストーリー一覧を見る →</a>
    </div>
    <div class="stories__grid">
    <?php
    $origins = ['沖縄県','北海道','島根県'];
    $n = 1;
    if ( $stories_query->have_posts() ) :
      while ( $stories_query->have_posts() ) : $stories_query->the_post();
        $hd     = function_exists('keikyo_iv_get_group') ? keikyo_iv_get_group(get_the_ID(), 'hero_section') : [];
        $title  = !empty($hd['hero_display_title']) ? $hd['hero_display_title'] : get_the_title();
        $result = !empty($hd['hero_info_result']) ? $hd['hero_info_result'] : '';
        $img    = '';
        if (!empty($hd['hero_image'])) {
            $img = function_exists('keikyo_iv_image_url') ? keikyo_iv_image_url($hd['hero_image'], 'large') : '';
        }
        if (!$img && has_post_thumbnail()) $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $desc   = !empty($hd['hero_description']) ? $hd['hero_description'] : get_the_excerpt();
    ?>
      <div class="story-card">
        <div class="story-card__image">
          <?php if ($img): ?><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy"><?php else: ?><div class="story-card__image-placeholder">STORY PHOTO</div><?php endif; ?>
          <span class="story-card__badge">Story 0<?php echo $n; ?></span>
          <?php if ($result): ?><span class="story-card__origin"><?php echo esc_html($result); ?></span><?php endif; ?>
          <div class="story-card__profile">
            <p class="story-card__name"><?php echo esc_html($title); ?></p>
            <?php if ($desc): ?><p class="story-card__school"><?php echo esc_html( mb_substr($desc, 0, 60) ); ?></p><?php endif; ?>
          </div>
        </div>
      </div>
    <?php $n++; endwhile; wp_reset_postdata();
    else: ?>
      <div class="story-card"><div class="story-card__image"><div class="story-card__image-placeholder">STORY PHOTO</div><span class="story-card__badge">Story 01</span><span class="story-card__origin">出身：沖縄県</span><div class="story-card__profile"><p class="story-card__name">合格者ストーリー準備中</p></div></div></div>
      <div class="story-card"><div class="story-card__image"><div class="story-card__image-placeholder">STORY PHOTO</div><span class="story-card__badge">Story 02</span><span class="story-card__origin">出身：北海道</span><div class="story-card__profile"><p class="story-card__name">合格者ストーリー準備中</p></div></div></div>
      <div class="story-card"><div class="story-card__image"><div class="story-card__image-placeholder">STORY PHOTO</div><span class="story-card__badge">Story 03</span><span class="story-card__origin">出身：島根県</span><div class="story-card__profile"><p class="story-card__name">合格者ストーリー準備中</p></div></div></div>
    <?php endif; ?>
    </div>
  </div>
</section>

<!-- STATS TICKER ② -->
<div class="stats-ticker">
  <div class="shell stats-ticker__inner">
    <div class="stats-ticker__item"><span class="stats-ticker__value">100%</span><span class="stats-ticker__label">現役合格率</span></div>
    <div class="stats-ticker__divider">|</div>
    <div class="stats-ticker__item"><span class="stats-ticker__value">93.3%</span><span class="stats-ticker__label">難関大学合格率</span></div>
    <div class="stats-ticker__divider">|</div>
    <div class="stats-ticker__item"><span class="stats-ticker__value">全国</span><span class="stats-ticker__label">47都道府県対応</span></div>
    <div class="stats-ticker__divider">|</div>
    <div class="stats-ticker__item"><span class="stats-ticker__value">1対1</span><span class="stats-ticker__label">伴走型個別指導</span></div>
  </div>
</div>

<!-- SECTION 06: CONSULTATION -->
<section class="consultation">
  <div class="shell consultation__inner">
    <div>
      <p class="kicker">Free Consultation</p>
      <h2 class="consultation__h2">無料受験相談で<span>できること</span>。</h2>
      <p class="consultation__sub">相談はオンライン・完全無料。保護者の方からのご相談も歓迎しています。</p>
      <div class="consultation__list">
        <?php
        $items = [
          ['num'=>'01','title'=>'あなたの経験・成績・志望校から合格可能性を診断','text'=>'偏差値や評定だけでは分からない「総合型選抜での勝ち筋」を一緒に見つける'],
          ['num'=>'02','title'=>'志望理由書に向くテーマの方向性を提案','text'=>'今の段階でどんな切り口が有効か、専門家の視点でフィードバック'],
          ['num'=>'03','title'=>'他塾との違いを正直にお伝えする','text'=>'慶教が合う人・合わない人を包み隠さずお話しします'],
          ['num'=>'04','title'=>'何から始めるべきかを明確にする','text'=>'今すぐやるべきこと・やらなくていいことを整理してお渡しします'],
        ];
        foreach ($items as $item) : ?>
        <div class="consultation__item">
          <span class="consultation__num"><?php echo esc_html($item['num']); ?></span>
          <div>
            <p class="consultation__item-title"><?php echo esc_html($item['title']); ?></p>
            <p class="consultation__item-text"><?php echo esc_html($item['text']); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="consultation__panel">
      <div class="consultation__card">
        <h3 class="consultation__card-title">まず話すだけで、戦略が見えてくる。</h3>
        <p class="consultation__card-text">総合型選抜という選択肢を、一緒に考えてみませんか。今の状況を整理し、何から始めるべきかを一緒に明確にします。</p>
        <a href="<?php echo esc_url($consultation_url); ?>" class="btn btn--red" target="_blank" rel="noopener noreferrer" style="width:100%;justify-content:center;">無料受験相談を予約する →</a>
        <p class="consultation__note">完全無料・オンライン対応・登録不要</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 07: DIAGNOSIS -->
<section class="diagnosis">
  <div class="shell diagnosis__inner">
    <div>
      <p class="kicker kicker--light">Diagnosis</p>
      <h2 class="diagnosis__h2">まずは、あなたの個性が<span>総合型選抜でどう活きるか</span>を知る。</h2>
      <p class="diagnosis__text">相談の前に、自分の強みの方向性を把握したい人へ。適性診断は、慶教ゼミナールの思想をもっとも体験しやすい入口です。</p>
      <div class="diagnosis__chips">
        <span class="diagnosis__chip">完全無料</span>
        <span class="diagnosis__chip">3分</span>
        <span class="diagnosis__chip">20問</span>
        <span class="diagnosis__chip">登録不要</span>
      </div>
    </div>
    <div>
      <div class="diagnosis__checklist">
        <?php
        $checks = ['自分の個性が総合型選抜でどう活きるか分かる','志望理由書に向きやすいテーマの方向性が見える','総合型選抜に向く強みと準備課題を整理できる','登録不要で、まず気軽に相性を確かめられる'];
        foreach ($checks as $c) : ?>
        <div class="diagnosis__check">
          <span class="diagnosis__check-icon">✓</span>
          <p><?php echo esc_html($c); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="diagnosis__cta">
        <a href="<?php echo esc_url($diagnosis_url); ?>" class="btn btn--red">適性診断をはじめる →</a>
        <a href="<?php echo esc_url($diagnosis_url); ?>" class="btn btn--outline-light">診断の流れを見る</a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 08: LINE -->
<section class="line-section">
  <div class="shell line-section__inner">
    <div>
      <p class="kicker kicker--light">LINE 限定プレゼント</p>
      <h2 class="line-section__h2">総合型選抜合格の「バイブル」を、無料でお届けします。</h2>
      <p class="line-section__text">LINE登録するだけで、慶教ゼミナールが厳選した合格のための必読資料6点を無料プレゼント。まずは読むだけでも、戦略の全体像が見えてきます。</p>
    </div>
    <div class="line-section__panel">
      <div class="line-gifts-grid">
        <?php
        $gifts = [
          ['num'=>'01','title'=>'逆転合格事例集'],
          ['num'=>'02','title'=>'必勝小論文基礎問題集'],
          ['num'=>'03','title'=>'自学自習用面接質問集50選'],
          ['num'=>'04','title'=>'合格者の志望理由参考例10選'],
          ['num'=>'05','title'=>'自己分析シート'],
          ['num'=>'06','title'=>'自分史作成<br>無料体験授業'],
        ];
        foreach ($gifts as $g) : ?>
        <div class="gift-card">
          <div class="gift-card__num"><?php echo esc_html($g['num']); ?></div>
          <div class="gift-card__title"><?php echo $g['title']; ?></div>
        </div>
        <?php endforeach; ?>
      </div>
      <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line" target="_blank" rel="noopener noreferrer">LINEで無料受け取り →</a>
      <p class="line-section__note">登録無料・勧誘なし・いつでも解除可能</p>
    </div>
  </div>
</section>

<!-- SECTION 09: FINAL CTA -->
<section class="final-cta">
  <div class="shell">
    <div class="final-cta__card">
      <div>
        <p class="kicker final-cta__kicker">Final Consultation</p>
        <h2 class="final-cta__h2">総合型選抜という選択肢を、<span>まず正しく知る</span>ところから。</h2>
        <p class="final-cta__text">受験生ご本人だけでなく、保護者の方からのご相談も歓迎しています。今の状況を整理し、何から始めるべきかを一緒に明確にします。</p>
      </div>
      <div class="final-cta__buttons">
        <a href="<?php echo esc_url($consultation_url); ?>" class="btn btn--red" target="_blank" rel="noopener noreferrer">無料受験相談へ進む →</a>
        <a href="<?php echo esc_url($diagnosis_url); ?>" class="btn btn--outline-light">総合型選抜適性診断を受ける →</a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 10: NAVIGATION -->
<section class="navigation">
  <div class="shell">
    <div class="navigation__header">
      <div>
        <p class="kicker">Navigation</p>
        <h2 class="navigation__h2">総合型選抜合格ナビ</h2>
        <p class="navigation__sub">合格への道筋を、記事で学ぶ。受験生が今すぐ使える情報を届けます。</p>
      </div>
      <a href="<?php echo esc_url($nav_url); ?>" class="navigation__link">記事一覧を見る →</a>
    </div>
    <div class="navigation__grid">
    <?php if ( $nav_query->have_posts() ) :
      while ( $nav_query->have_posts() ) : $nav_query->the_post();
        $thumb = get_the_post_thumbnail_url(get_the_ID(),'medium') ?: '';
        $cats  = get_the_category(); $cat_name = $cats ? $cats[0]->name : '総合型選抜';
    ?>
      <div class="article-card">
        <div class="article-card__image"><?php if ($thumb): ?><img src="<?php echo esc_url($thumb); ?>" alt="" loading="lazy"><?php else: ?>THUMBNAIL<?php endif; ?></div>
        <div class="article-card__body">
          <div class="article-card__meta">
            <span class="article-card__cat"><?php echo esc_html($cat_name); ?></span>
            <span class="article-card__date"><?php echo get_the_date('Y.m.d'); ?></span>
          </div>
          <h3 class="article-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p class="article-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 40, '…'); ?></p>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata();
    else: ?>
      <?php
      $dummy_articles = [
        ['cat'=>'総合型選抜','date'=>'2026.04.01','title'=>'総合型選抜とは？一般入試との違いと対策の始め方','excerpt'=>'総合型選抜の基本から、一般入試との違い、そして効果的な対策の始め方まで詳しく解説します。'],
        ['cat'=>'志望理由書','date'=>'2026.03.25','title'=>'志望理由書で落ちる人・受かる人の決定的な差','excerpt'=>'合格する志望理由書と不合格になる志望理由書の違いを、実例を交えて解説します。'],
        ['cat'=>'面接対策','date'=>'2026.03.18','title'=>'面接で必ず聞かれる質問と、評価される答え方','excerpt'=>'面接官が見ているポイントと、高評価につながる回答の作り方を具体的に紹介します。'],
      ];
      foreach ($dummy_articles as $a) : ?>
      <div class="article-card">
        <div class="article-card__image">THUMBNAIL</div>
        <div class="article-card__body">
          <div class="article-card__meta">
            <span class="article-card__cat"><?php echo esc_html($a['cat']); ?></span>
            <span class="article-card__date"><?php echo esc_html($a['date']); ?></span>
          </div>
          <h3 class="article-card__title"><?php echo esc_html($a['title']); ?></h3>
          <p class="article-card__excerpt"><?php echo esc_html($a['excerpt']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>
  </div>
</section>

</main>

<script>
(function() {
  var slides = document.querySelectorAll('#heroSlideshow .hero-slide');
  var dots   = document.querySelectorAll('#heroSlideshow .dot');
  if (!slides.length) return;
  var current = 0;
  setInterval(function() {
    slides[current].classList.remove('hero-slide--active');
    dots[current].classList.remove('dot--active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('hero-slide--active');
    dots[current].classList.add('dot--active');
  }, 4000);
})();
</script>

<?php get_footer(); ?>

</html>
