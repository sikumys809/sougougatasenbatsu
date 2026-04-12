<?php
/**
 * Template Name: 合格実績（Performance）
 *
 * @package keikyo-theme
 */
get_header();
?>

<!-- SECTION 01: HERO -->
<section class="perf-hero">
  <div class="shell perf-hero__inner">
    <div>
      <p class="kicker kicker--light">2025 Performance</p>
      <h1 class="perf-hero__h1">2025年度<br><span>合格者実績</span></h1>
      <p class="perf-hero__lead">総合型選抜で、難関大学合格を実現。</p>
      <p class="perf-hero__sub">ブルーアカデミーを含むグループ全体の合格実績を掲載しています。</p>
      <div class="perf-hero__cta">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--red">無料で受験相談する</a>
        <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="btn btn--outline-light">まずは適性診断を受ける</a>
      </div>
    </div>
    <div class="perf-hero__cards">
      <div class="perf-hero__card perf-hero__card--red">
        <div class="perf-hero__card-value">100%</div>
        <div class="perf-hero__card-label">現役合格率</div>
        <div class="perf-hero__card-note">2025年度 グループ全体実績</div>
      </div>
      <div class="perf-hero__card perf-hero__card--navy">
        <div class="perf-hero__card-value">93.3%</div>
        <div class="perf-hero__card-label">難関大学合格率</div>
        <div class="perf-hero__card-note">2025年度 グループ全体実績</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 02: 数字で見る実績 -->
<section class="numbers">
  <div class="shell">
    <h2 class="numbers__h2">数字で見る、2025年度の合格実績</h2>
    <div class="numbers__grid">
      <div class="numbers__card numbers__card--red">
        <div class="numbers__card-value">100%</div>
        <div class="numbers__card-label">現役合格率</div>
      </div>
      <div class="numbers__card numbers__card--navy">
        <div class="numbers__card-value">93.3%</div>
        <div class="numbers__card-label">難関大学合格率</div>
      </div>
      <div class="numbers__card numbers__card--red">
        <div class="numbers__card-value">100%</div>
        <div class="numbers__card-label">難関国公立大学合格率</div>
      </div>
      <div class="numbers__card numbers__card--navy">
        <div class="numbers__card-value">100%</div>
        <div class="numbers__card-label">慶應SFC 2次試験突破率</div>
      </div>
      <div class="numbers__card numbers__card--red">
        <div class="numbers__card-value">30+</div>
        <div class="numbers__card-label">合格大学・学部数</div>
      </div>
      <div class="numbers__card numbers__card--navy">
        <div class="numbers__card-value">全国</div>
        <div class="numbers__card-label">離島・地方からも合格実績</div>
      </div>
    </div>
    <p class="numbers__note">※ 慶教ゼミナール・ブルーアカデミーを含むグループ全体実績</p>
  </div>
</section>

<!-- SECTION 03: 合格実績大学一覧 -->
<section class="universities">
  <div class="shell">
    <h2 class="universities__h2">合格実績大学一覧</h2>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--dark">
        <span class="uni-group__title">早慶上理</span>
        <span class="uni-group__badge">難関私大</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">慶應義塾大学</span><span class="uni-item__dept">環境情報学部</span></div><span class="uni-item__rate">倍率4.5</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">慶應義塾大学</span><span class="uni-item__dept">総合政策学部</span></div><span class="uni-item__rate">倍率5.9</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">早稲田大学</span><span class="uni-item__dept">人間科学部</span></div><span class="uni-item__rate">倍率5.7</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">上智大学</span><span class="uni-item__dept">総合人間科学部</span></div><span class="uni-item__rate">倍率3.3</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">上智大学</span><span class="uni-item__dept">総合グローバル学部</span></div><span class="uni-item__rate">倍率2.5</span></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--light">
        <span class="uni-group__title">難関国公立大学</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">横浜国立大学</span><span class="uni-item__dept">経営学部</span></div><span class="uni-item__rate">倍率3.0</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">東北大学</span><span class="uni-item__dept">法学部</span></div><span class="uni-item__rate">倍率3.0</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">九州大学</span><span class="uni-item__dept">共創学部 総合</span></div><span class="uni-item__rate">倍率3.7〜5.5</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">鳥取環境大学</span><span class="uni-item__dept">環境学部環境学科</span></div><span class="uni-item__rate">倍率1.3〜2.7</span></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--dark">
        <span class="uni-group__title">MARCH</span>
        <span class="uni-group__badge">人気私大</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">明治大学</span><span class="uni-item__dept">総合数理学部</span></div><span class="uni-item__rate">倍率2.5〜5.7</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">中央大学</span><span class="uni-item__dept">法学部</span></div><span class="uni-item__rate">倍率4.2</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">中央大学</span><span class="uni-item__dept">文学部</span></div><span class="uni-item__rate">倍率3.0〜5.2</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">立教大学</span><span class="uni-item__dept">コミュニティ福祉学部</span></div><span class="uni-item__rate">倍率2.8〜5.1</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">立教大学</span><span class="uni-item__dept">経営学部</span></div><span class="uni-item__rate">倍率1.0〜15.4</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">立教大学</span><span class="uni-item__dept">社会学部</span></div><span class="uni-item__rate">倍率1.7〜15.5</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">青山学院大学</span><span class="uni-item__dept">コミュニティ人間科学部</span></div><span class="uni-item__rate">倍率5.3</span></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--light">
        <span class="uni-group__title">四工</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">千葉工業大学</span><span class="uni-item__dept">情報変革科学部 認知情報科学科</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">東京都市大学</span><span class="uni-item__dept">情報工学部 知能情報工学科</span></div></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--dark">
        <span class="uni-group__title">五美大・四芸大</span>
        <span class="uni-group__badge">芸術系</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">多摩美術大学</span><span class="uni-item__dept">芸術学科</span></div><span class="uni-item__rate">倍率2.0</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">日本大学</span><span class="uni-item__dept">芸術学部 音楽学科 情報音楽コース</span></div><span class="uni-item__rate">倍率4.4〜9.5</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">日本大学</span><span class="uni-item__dept">芸術学部 映画学科</span></div><span class="uni-item__rate">倍率2.6〜4.0</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">大阪芸術大学</span><span class="uni-item__dept">芸術学部 放送学科</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">大阪芸術大学</span><span class="uni-item__dept">芸術学部 芸術計画学科</span></div></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--light">
        <span class="uni-group__title">関関同立</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">同志社大学</span><span class="uni-item__dept">法学部</span></div><span class="uni-item__rate">倍率1.6</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">関西大学</span><span class="uni-item__dept">政策創造学部</span></div><span class="uni-item__rate">倍率4.1</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">関西大学</span><span class="uni-item__dept">法学部</span></div><span class="uni-item__rate">倍率2.6</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">関西学院大学</span><span class="uni-item__dept">人間福祉学部</span></div><span class="uni-item__rate">倍率2.6</span></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--dark">
        <span class="uni-group__title">日東駒専</span>
        <span class="uni-group__badge">中堅私大</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">日本大学</span><span class="uni-item__dept">商学部</span></div><span class="uni-item__rate">倍率2.8</span></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">専修大学</span><span class="uni-item__dept">経営学部</span></div><span class="uni-item__rate">倍率1.5〜1.7</span></div>
      </div>
    </div>

    <div class="uni-group">
      <div class="uni-group__header uni-group__header--light">
        <span class="uni-group__title">その他</span>
      </div>
      <div class="uni-group__list">
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">國學院大学</span><span class="uni-item__dept">観光まちづくり学部</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">成城大学</span><span class="uni-item__dept">社会イノベーション学部</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">武蔵野大学</span><span class="uni-item__dept">データサイエンス学部</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">立命館アジア太平洋大学</span><span class="uni-item__dept">アジア太平洋学部</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">立命館アジア太平洋大学</span><span class="uni-item__dept">国際経営学部</span></div></div>
        <div class="uni-item"><div class="uni-item__left"><span class="uni-item__name">東京国際大学</span><span class="uni-item__dept">商学部 経営学科</span></div></div>
      </div>
    </div>

  </div>
</section>

<!-- SECTION 04: SUCCESS STORIES -->
<section class="perf-stories">
  <div class="shell">
    <div class="perf-stories__header">
      <div>
        <p class="kicker">Success Stories</p>
        <h2 class="perf-stories__h2">数字の裏にある、一人ひとりのリアル。</h2>
        <p class="perf-stories__sub">合格率や大学名だけでは見えない、受験生がどう考え、どう行動して合格をつかんだか。対談記事で、その全貌を届けます。</p>
      </div>
      <a href="<?php echo esc_url( home_url( '/interview/' ) ); ?>" class="text-link">合格者対談一覧を見る →</a>
    </div>
    <div class="perf-stories__grid">
      <?php
      $story_args = [
        'post_type'      => 'interview',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
      ];
      $story_query = new WP_Query( $story_args );
      if ( $story_query->have_posts() ) :
        $n = 1;
        while ( $story_query->have_posts() ) :
          $story_query->the_post();
          $hd        = function_exists('keikyo_iv_get_group') ? keikyo_iv_get_group(get_the_ID(), 'hero_section') : [];
          $school    = !empty($hd['hero_info_result']) ? $hd['hero_info_result'] : '';
          $thumb_url = '';
          if (!empty($hd['hero_image'])) { $thumb_url = function_exists('keikyo_iv_image_url') ? keikyo_iv_image_url($hd['hero_image'], 'large') : ''; }
          if (!$thumb_url) $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
      ?>
      <article class="story-card">
        <a href="<?php the_permalink(); ?>" class="story-card__link">
          <div class="story-card__image">
            <?php if ( $thumb_url ) : ?>
              <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php else : ?>
              <div class="story-card__image-placeholder">STORY PHOTO</div>
            <?php endif; ?>
            <span class="story-card__badge">Story <?php printf( '%02d', $n ); ?></span>
            <?php if ( $school ) : ?>
              <span class="story-card__origin"><?php echo esc_html( $school ); ?></span>
            <?php endif; ?>
            <div class="story-card__profile">
              <p class="story-card__name"><?php the_title(); ?></p>

            </div>
          </div>
        </a>
      </article>
      <?php
          $n++;
        endwhile;
        wp_reset_postdata();
      else : ?>
        <p style="color:#999;">合格者ストーリーは準備中です。</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- SECTION 05: WHY RESULTS -->
<section class="why-results">
  <div class="shell">
    <div class="why-results__header">
      <p class="kicker kicker--light">Why Results</p>
      <h2 class="why-results__h2">なぜ、この実績が出せるのか。</h2>
      <p class="why-results__sub">合格率100%・難関大93.3%という数字は偶然ではありません。再現性のある仕組みがあります。</p>
    </div>
    <div class="why-results__grid">
      <div class="why-card">
        <span class="why-card__num">01</span>
        <h3 class="why-card__title">総合型選抜経験者が設計する戦略</h3>
        <p class="why-card__text">「受かった人間」が作る出願戦略は一次情報の密度が違う。</p>
      </div>
      <div class="why-card">
        <span class="why-card__num">02</span>
        <h3 class="why-card__title">全国データが蓄積される環境</h3>
        <p class="why-card__text">全国から集まる受験生のデータが勝ちパターンの精度を上げ続ける。</p>
      </div>
      <div class="why-card">
        <span class="why-card__num">03</span>
        <h3 class="why-card__title">複数のプロが多角的に鍛える</h3>
        <p class="why-card__text">面接は複数教授が評価する場。だから慶教も複数の専門職で伴走する。</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 06: DIAGNOSIS -->
<section class="perf-diagnosis">
  <div class="shell perf-diagnosis__inner">
    <div>
      <p class="kicker">Diagnosis</p>
      <h2 class="perf-diagnosis__h2">次はあなたの番です。</h2>
      <p class="perf-diagnosis__sub">これだけの合格者が生まれた入試方式で、あなたの個性はどう活きるか。まず3分の診断で確かめてください。</p>
      <div class="perf-diagnosis__chips">
        <span class="perf-diagnosis__chip">完全無料</span>
        <span class="perf-diagnosis__chip">3分</span>
        <span class="perf-diagnosis__chip">20問</span>
        <span class="perf-diagnosis__chip">登録不要</span>
      </div>
      <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="btn btn--red">無料で適性診断を受ける →</a>
    </div>
    <div></div>
  </div>
</section>

<!-- LINE SECTION -->
<section class="perf-line">
  <div class="shell perf-line__inner">
    <div>
      <p class="kicker kicker--light">LINE 限定プレゼント</p>
      <h2 class="perf-line__h2">総合型選抜合格の「バイブル」を、<br>無料でお届けします。</h2>
      <p class="perf-line__text">LINE登録するだけで、慶教ゼミナールが厳選した合格のための必読資料6点を無料プレゼント。</p>
    </div>
    <div class="perf-line__panel">
      <div class="perf-line__grid">
        <div class="perf-line__card"><span class="perf-line__num">01</span><span class="perf-line__title">逆転合格事例集</span></div>
        <div class="perf-line__card"><span class="perf-line__num">02</span><span class="perf-line__title">必勝小論文基礎問題集</span></div>
        <div class="perf-line__card"><span class="perf-line__num">03</span><span class="perf-line__title">自学自習用面接質問集50選</span></div>
        <div class="perf-line__card"><span class="perf-line__num">04</span><span class="perf-line__title">合格者の志望理由参考例10選</span></div>
        <div class="perf-line__card"><span class="perf-line__num">05</span><span class="perf-line__title">自己分析シート</span></div>
        <div class="perf-line__card"><span class="perf-line__num">06</span><span class="perf-line__title">自分史作成<br>無料体験授業</span></div>
      </div>
      <a href="https://line.me/R/ti/p/@712gzjgo" class="btn btn--line" target="_blank" rel="noopener noreferrer">LINEで無料受け取り →</a>
      <p class="perf-line__note">登録無料・勧誘なし・いつでも解除可能</p>
    </div>
  </div>
</section>

<!-- SECTION 07: FINAL CTA -->
<section class="perf-final-cta">
  <div class="shell">
    <div class="perf-final-cta__card">
      <div class="perf-final-cta__inner">
        <div>
          <p class="kicker kicker--light">First Step</p>
          <h2 class="perf-final-cta__h2">実績の続きを、あなたが作る番です。</h2>
          <p class="perf-final-cta__sub">慶教ゼミナールで合格した受験生は、みんな「まず話してみた」ところから始まっています。</p>
        </div>
        <div class="perf-final-cta__buttons">
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--red">無料受験相談を予約する →</a>
          <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="btn btn--outline-light">総合型選抜適性診断を受ける →</a>
          <a href="https://line.me/R/ti/p/@712gzjgo" class="btn btn--line" target="_blank" rel="noopener noreferrer">LINEで合格バイブルを受け取る →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
