<?php
/**
 * Template Name: About（慶教ゼミナールとは？）
 *
 * @package keikyo-theme
 */

// about.css をこのテンプレートのみで読み込む
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'keikyo-about',
        get_template_directory_uri() . '/assets/css/pages/about.css',
        [],
        '1.0.0'
    );
} );

get_header();
?>

<!-- ========================================
     SECTION 01: HERO
     ======================================== -->
<section class="about-hero">
  <div class="shell about-hero__inner">

    <div class="about-hero__content">
      <span class="about-hero__pill">総合型選抜専門塾</span>
      <h1 class="about-hero__title">
        <span>脱偏差値、</span>
        <span>個性満開。</span>
      </h1>
      <p class="about-hero__subtitle">個性を、大学に届く合格理由へ。</p>
      <p class="about-hero__text">
        慶教ゼミナールは、総合型選抜のための専門設計の学び場。<br>
        偏差値では測れないあなたの強みを、大学に伝わる言葉と戦略に変えます。
      </p>
      <div class="about-hero__cta">
        <a href="/contact/" class="btn btn--red">無料受験相談</a>
        <a href="/diagnosis/" class="btn btn--outline-light">総合型選抜適性診断</a>
      </div>
      <a href="/interview/" class="text-link text-link--light">合格者体験談を見る →</a>
    </div>

    <div class="about-hero__cards">
      <div class="about-hero__card">
        <div class="about-hero__card-icon">◎</div>
        <p class="about-hero__card-text">
          <strong>全国オンライン対応</strong> —
          通学ハードルを下げ、全国から受験生が集まる環境で全国基準の視点を持てます。
        </p>
      </div>
      <div class="about-hero__card">
        <div class="about-hero__card-icon">◉</div>
        <p class="about-hero__card-text">
          <strong>経験者による指導</strong> —
          総合型選抜を実際に経験・理解している講師陣が、一次情報に基づいた戦略を設計します。
        </p>
      </div>
      <div class="about-hero__card">
        <div class="about-hero__card-icon">▣</div>
        <p class="about-hero__card-text">
          <strong>専門職体制</strong> —
          入試設計、合格戦略、メンタルサポート。役割を分けた専門性で伴走します。
        </p>
      </div>
    </div>

  </div>
</section>

<!-- ========================================
     SECTION 02: PHILOSOPHY
     ======================================== -->
<section class="about-philosophy">
  <div class="shell">
    <div class="about-philosophy__inner">
      <span class="kicker">Philosophy</span>
      <h2 class="section-heading">総合型選抜とは何か</h2>
      <p class="about-philosophy__message">
        総合型選抜は、<strong>学力入試</strong>でも<strong>特権入試</strong>でもありません。<br>
        <strong>個の特性</strong>が重要になる特色入試です。
      </p>
      <div class="about-philosophy__cards">
        <div class="about-philosophy__card">
          <h3 class="about-philosophy__card-title">「脱偏差値」の意味</h3>
          <p class="about-philosophy__card-text">
            偏差値という単一の物差しでは測れない、あなただけの強みや経験がある。
            総合型選抜は、その個性を正当に評価する入試制度です。
            数字ではなく、あなた自身の言葉で語る力が問われます。
          </p>
        </div>
        <div class="about-philosophy__card">
          <h3 class="about-philosophy__card-title">「個性満開」の意味</h3>
          <p class="about-philosophy__card-text">
            隠れていた個性、まだ言語化されていない強み。
            それらを引き出し、大学に伝わる「合格理由」へと磨き上げる。
            慶教ゼミナールは、あなたの個性が花開く場所です。
          </p>
        </div>
      </div>
      <p class="about-philosophy__note">
        慶教ゼミナールは、総合型選抜の本質に正面から向き合うオンライン専門塾です。
        偏差値では測れない強みを、大学に伝わる言葉と戦略に変えることを得意とします。
      </p>
    </div>
  </div>
</section>

<!-- ========================================
     SECTION 03: WHY CHOOSE US
     ======================================== -->
<section class="about-why">
  <div class="shell">
    <div class="about-why__header">
      <span class="kicker">Why Choose Us</span>
      <h2 class="section-heading">オンラインだから、結果が出る。その根拠と実績。</h2>
      <p class="about-why__lead">「オンラインで本当に合格できるのか」その答えは実績が証明しています。</p>
    </div>
    <div class="about-why__stats">
      <div class="stat-card">
        <div class="stat-card__value">100%</div>
        <div class="stat-card__label">全体合格率（第3志望以内）</div>
      </div>
      <div class="stat-card">
        <div class="stat-card__value">93.3%</div>
        <div class="stat-card__label">難関大学合格率</div>
      </div>
      <div class="stat-card">
        <div class="stat-card__value">100%</div>
        <div class="stat-card__label">難関国公立大学合格率</div>
      </div>
      <div class="stat-card">
        <div class="stat-card__value">100%</div>
        <div class="stat-card__label">慶應SFC 2次試験突破率</div>
      </div>
    </div>
    <p class="about-why__note">※ 慶教ゼミナール・ブルーアカデミーを含むグループ全体実績</p>
    <div class="about-why__reasons">
      <div class="reason-card">
        <div class="reason-card__num">01</div>
        <h3 class="reason-card__title">全国基準の切磋琢磨</h3>
        <p class="reason-card__text">
          全国から受験生が集まる環境だから、本当のライバルとの差が分かる。
          地方にいても東京と同じ質の戦略が作れる。
        </p>
      </div>
      <div class="reason-card">
        <div class="reason-card__num">02</div>
        <h3 class="reason-card__title">合格事例の蓄積密度</h3>
        <p class="reason-card__text">
          全国の合格データがグループ全体で蓄積される。
          どの大学・学部にどんな戦略が通じるか、一次情報ベースで精度高く設計できる。
        </p>
      </div>
      <div class="reason-card">
        <div class="reason-card__num">03</div>
        <h3 class="reason-card__title">通塾時間ゼロ。その時間を戦略に使う。</h3>
        <p class="reason-card__text">
          校舎に通う往復1〜2時間は、探究活動・志望理由書の深化・自己分析に使える時間。
          オンラインだから、受験に本当に必要なことだけに集中できる。
        </p>
      </div>
    </div>
    <div class="about-why__cta">
      <a href="/results/" class="text-link text-link--light">合格実績を見る →</a>
      <a href="/contact/" class="btn btn--red">無料受験相談を予約する →</a>
    </div>
  </div>
</section>

<!-- ========================================
     SECTION 04: INSTRUCTORS
     ======================================== -->
<section class="about-instructors">
  <div class="shell">
    <div class="about-instructors__header">
      <span class="kicker">Instructors</span>
      <h2 class="section-heading">講師・運営メンバー紹介</h2>
      <p class="about-instructors__sub">
        総合型選抜は比較的新しい制度で、実際に経験した大人が少ない中、<br>
        慶教ゼミナールには制度を実際に経験・理解している講師がいます。
      </p>
    </div>
    <div class="about-instructors__grid">

      <div class="instructor-card">
        <?php
        $photo_1 = get_template_directory_uri() . '/assets/images/instructor-kamibayashiyama.jpg';
        ?>
        <div class="instructor-card__photo">
          <img src="<?php echo esc_url( $photo_1 ); ?>" alt="上林山 大吉" loading="lazy">
        </div>
        <div class="instructor-card__body">
          <p class="instructor-card__role">塾長</p>
          <p class="instructor-card__name">上林山 大吉</p>
          <span class="instructor-card__badge">京都大学 経済学部 総合型選抜入学</span>
          <p class="instructor-card__bio">
            自分が総合型選抜で京都大学に入った立場から、受験生の不安を一次情報ベースで解決する。
            進路設計・出願戦略の全体を俯瞰して伴走。
          </p>
        </div>
      </div>

      <div class="instructor-card">
        <?php
        $photo_2 = get_template_directory_uri() . '/assets/images/instructor-mizuno.jpg';
        ?>
        <div class="instructor-card__photo">
          <img src="<?php echo esc_url( $photo_2 ); ?>" alt="水野 永吉" loading="lazy">
        </div>
        <div class="instructor-card__body">
          <p class="instructor-card__role">講師</p>
          <p class="instructor-card__name">水野 永吉</p>
          <span class="instructor-card__badge">慶應高校推薦入試2期生・会社経営17年</span>
          <p class="instructor-card__bio">
            推薦入試の経験と17年の経営経験を持つ。受験だけでなく「社会で通じる力」も見据えた指導で、
            受験生の経験を伝わる言葉へ変える。
          </p>
        </div>
      </div>

      <div class="instructor-card">
        <?php
        $photo_3 = get_template_directory_uri() . '/assets/images/instructor-kanzaki.jpg';
        ?>
        <div class="instructor-card__photo">
          <img src="<?php echo esc_url( $photo_3 ); ?>" alt="神崎 真桜" loading="lazy">
        </div>
        <div class="instructor-card__body">
          <p class="instructor-card__role">講師</p>
          <p class="instructor-card__name">神崎 真桜</p>
          <span class="instructor-card__badge">元アクセンチュア株式会社</span>
          <p class="instructor-card__bio">
            世界最大のコンサルティングファームで培った言語化・論理構成の技術を志望理由書に全て使う。
            「伝わる言葉」を作る専門家。
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ========================================
     SECTION 05: PROFESSIONAL TEAM
     ======================================== -->
<section class="about-pro-team">
  <div class="shell">
    <div class="about-pro-team__header">
      <span class="kicker">Professional Team</span>
      <h2 class="section-heading">専門職体制が、本番に強い理由。</h2>
      <p class="about-pro-team__lead">
        総合型選抜の面接は、一人の教授を納得させれば終わりではない。
        複数の教授が異なる視点で評価する場です。だから慶教ゼミナールも、
        一人の講師が全てを見る体制をとらない。異なる専門性を持つ複数のプロがあなたを
        多角的に鍛えるから、どの教授にも通じる言葉と論理が育つ。
      </p>
    </div>
    <div class="about-pro-team__grid">
      <div class="role-card">
        <div class="role-card__num">01</div>
        <h3 class="role-card__title">入試設計アドバイザー</h3>
        <p class="role-card__text">
          志望校・入試方式の選定から出願スケジュールまで戦略的に設計する。
        </p>
      </div>
      <div class="role-card">
        <div class="role-card__num">02</div>
        <h3 class="role-card__title">合格戦略コーチ</h3>
        <p class="role-card__text">
          志望理由書・小論文・面接の戦略を立案し、本番まで伴走する。
        </p>
      </div>
      <div class="role-card">
        <div class="role-card__num">03</div>
        <h3 class="role-card__title">受験メンタルパートナー</h3>
        <p class="role-card__text">
          複数教授への対応力は精神的タフさも必要。
          受験期の不安・プレッシャーを専門スタッフがサポートする。
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ========================================
     SECTION 06: SUCCESS STORIES
     ======================================== -->
<section class="about-stories">
  <div class="shell">
    <div class="about-stories__header">
      <div>
        <span class="kicker">Success Stories</span>
        <h2 class="section-heading">合格者のリアルを、そのまま届ける。</h2>
        <p class="about-stories__sub">
          慶教ゼミナールの卒業生だけでなく、他塾・独学で合格した受験生の声も掲載。
          「うちの生徒の成功談だけ」ではなく、総合型選抜で合格した人たちの
          リアルな思考と行動を届けます。
        </p>
      </div>
      <a href="/interview/" class="text-link">合格者ストーリー一覧を見る →</a>
    </div>

    <div class="about-stories__grid">
      <?php
      $story_args = [
          'post_type'      => 'interview',
          'posts_per_page' => 3,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC',
      ];
      $story_query = new WP_Query( $story_args );

      if ( $story_query->have_posts() ) :
        $story_num = 1;
        while ( $story_query->have_posts() ) :
          $story_query->the_post();
          $origin     = get_post_meta( get_the_ID(), 'origin_prefecture', true );
          $school     = get_post_meta( get_the_ID(), 'accepted_university', true );
          $thumb_url  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
      ?>
      <article class="story-card">
        <a href="<?php the_permalink(); ?>" class="story-card__link">
          <div class="story-card__image">
            <?php if ( $thumb_url ) : ?>
              <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php else : ?>
              <div class="story-card__image-placeholder">STORY PHOTO</div>
            <?php endif; ?>
            <span class="story-card__badge">Story <?php printf( '%02d', $story_num ); ?></span>
            <?php if ( $origin ) : ?>
              <span class="story-card__origin">出身：<?php echo esc_html( $origin ); ?></span>
            <?php endif; ?>
            <div class="story-card__profile">
              <p class="story-card__name"><?php the_title(); ?></p>
              <?php if ( $school ) : ?>
                <p class="story-card__school"><?php echo esc_html( $school ); ?></p>
              <?php endif; ?>
            </div>
          </div>
          <div class="story-card__body">
            <h3 class="story-card__title"><?php the_title(); ?></h3>
            <p class="story-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 30, '…' ); ?></p>
          </div>
        </a>
      </article>
      <?php
          $story_num++;
        endwhile;
        wp_reset_postdata();
      else :
      ?>
        <p style="color:#999;">合格者ストーリーは準備中です。</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- ========================================
     SECTION 07: LINE 限定プレゼント
     ======================================== -->
<section class="about-line">
  <div class="shell about-line__inner">
    <div class="about-line__left">
      <span class="kicker kicker--light">LINE 限定プレゼント</span>
      <h2 class="about-line__h2">総合型選抜合格の「バイブル」を、<br>無料でお届けします。</h2>
      <p class="about-line__text">
        LINE登録するだけで、慶教ゼミナールが厳選した合格のための必読資料6点を無料プレゼント。
        まずは読むだけでも、戦略の全体像が見えてきます。
      </p>
    </div>
    <div class="about-line__panel">
      <div class="about-line__grid">
        <div class="about-line__card"><div class="about-line__num">01</div><div class="about-line__title">逆転合格事例集</div></div>
        <div class="about-line__card"><div class="about-line__num">02</div><div class="about-line__title">必勝小論文基礎問題集</div></div>
        <div class="about-line__card"><div class="about-line__num">03</div><div class="about-line__title">自学自習用<br>面接質問集50選</div></div>
        <div class="about-line__card"><div class="about-line__num">04</div><div class="about-line__title">合格者の志望理由<br>参考例10選</div></div>
        <div class="about-line__card"><div class="about-line__num">05</div><div class="about-line__title">自己分析シート</div></div>
        <div class="about-line__card"><div class="about-line__num">06</div><div class="about-line__title">自分史作成<br>無料体験授業</div></div>
      </div>
      <a href="https://line.me/R/ti/p/@712gzjgo" class="btn btn--line" target="_blank" rel="noopener noreferrer">
        LINEで無料受け取り →
      </a>
      <p class="about-line__note">登録無料・勧誘なし・いつでも解除可能</p>
    </div>
  </div>
</section>

<!-- ========================================
     SECTION 08: FINAL CTA
     ======================================== -->
<section class="about-final-cta">
  <div class="shell">
    <div class="about-final-cta__card">
      <div class="about-final-cta__inner">
        <div class="about-final-cta__content">
          <h2 class="about-final-cta__title">慶教ゼミナールで、始めてみませんか。</h2>
          <p class="about-final-cta__sub">
            ここまで読んでくださったあなたは、すでに総合型選抜を真剣に考えている。
            あとは一歩踏み出すだけです。
          </p>
        </div>
        <div class="about-final-cta__actions">
          <div class="cta-card">
            <h3 class="cta-card__title">無料受験相談</h3>
            <p class="cta-card__text">今の成績・活動から合格可能性を診断。志望校別の戦略を提案します。</p>
            <a href="/contact/" class="btn btn--red">無料受験相談を予約する →</a>
          </div>
          <div class="cta-card">
            <h3 class="cta-card__title">総合型選抜適性診断</h3>
            <p class="cta-card__text">まずは自分の個性が総合型選抜でどう活きるかを知る。</p>
            <a href="/diagnosis/" class="btn btn--outline-light">適性診断をはじめる →</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
