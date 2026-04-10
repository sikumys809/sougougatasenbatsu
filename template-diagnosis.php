<?php
/**
 * Template Name: 総合型選抜適性診断
 * @package keikyo-theme
 */
get_header();
?>

<div id="diagnosis-container" class="diagnosis-wrapper">

  <!-- 診断開始画面 -->
  <section id="diagnosis-intro" class="diagnosis-section active">

    <div class="intro-content">
      <p class="intro-kicker">Aptitude Diagnosis</p>
      <h1 class="intro-title">総合型選抜<br>適性診断</h1>
      <div class="intro-badges">
        <span class="intro-badge">完全無料</span>
        <span class="intro-badge">約3分</span>
        <span class="intro-badge">15問</span>
        <span class="intro-badge">登録不要</span>
      </div>
      <div class="intro-features">
        <p class="intro-features-title">この診断で分かること：</p>
        <ul class="intro-features-list">
          <li><span class="check-icon">✓</span>あなたの適性タイプ（4タイプ分類）</li>
          <li><span class="check-icon">✓</span>総合型選抜に向いている強み</li>
          <li><span class="check-icon">✓</span>おすすめの活動・準備課題</li>
          <li><span class="check-icon">✓</span>向いている学部・学科の方向性</li>
        </ul>
      </div>
      <button id="start-diagnosis-btn" class="diagnosis-btn diagnosis-btn--red">
        今すぐ無料で診断スタート →
      </button>
      <p class="intro-note">※ 登録不要・個人情報の入力なし</p>
    </div>
  </section>

  <!-- 診断クイズ画面 -->
  <section id="diagnosis-quiz" class="diagnosis-section">
    <div class="quiz-content">
      <div class="diagnosis-progress-bar">
        <div id="progress-fill" class="diagnosis-progress-fill"></div>
      </div>
      <p class="quiz-progress-text">
        質問 <span id="current-question">1</span> / 15
      </p>

      <div class="diagnosis-content-box">
        <h2 id="question-text" class="diagnosis-question-text"></h2>
        <div id="answers-container" class="diagnosis-answer-container"></div>

        <div class="diagnosis-navigation">
          <button id="prev-btn" class="diagnosis-btn" style="display:none;">
            ← 前の質問へ
          </button>
          <button id="next-btn" class="diagnosis-btn diagnosis-btn--red" disabled>
            次の質問へ →
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- 診断結果画面 -->
  <section id="diagnosis-result" class="diagnosis-section">
    <div class="result-content">
      <div class="result-header">
        <p class="result-label">診断結果</p>
        <div id="result-type-badge" class="diagnosis-result-badge"></div>
        <h2 class="result-type-name" id="result-type-name"></h2>
      </div>

      <div class="result-section">
        <p class="result-section-title">あなたのタイプ</p>
        <p id="result-description"></p>
      </div>

      <div class="result-section">
        <p class="result-section-title">強み</p>
        <ul id="result-strengths" class="result-list"></ul>
      </div>

      <div class="result-section">
        <p class="result-section-title">おすすめの活動</p>
        <ul id="result-activities" class="result-list"></ul>
      </div>

      <div class="result-section">
        <p class="result-section-title">総合型選抜に向けて準備すべきこと</p>
        <div id="result-preparation"></div>
      </div>

      <div class="result-section">
        <p class="result-section-title">向いている学部例</p>
        <div id="result-faculties" class="result-faculties"></div>
      </div>

      <div class="result-cta">
        <p class="result-cta-text">あなたに合った対策を、一緒に考えましょう。</p>
        <p class="result-cta-sub">今すぐ無料受験相談で、戦略を設計する。</p>
        <div class="result-cta-buttons">
          <a href="https://line.me/R/ti/p/@712gzjgo"
             class="diagnosis-btn diagnosis-btn--line"
             target="_blank" rel="noopener noreferrer">
            LINE で相談する
          </a>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
             class="diagnosis-btn diagnosis-btn--red">
            無料受験相談を予約する →
          </a>
          <button id="restart-btn" class="diagnosis-btn">
            もう一度診断する
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- ローディング -->
  <div id="diagnosis-loading" class="diagnosis-loading" style="display:none;">
    <div class="diagnosis-spinner"></div>
    <p class="loading-text">診断結果を計算中...</p>
  </div>

</div>

<script>
var diagnosisAjax = {
  ajaxurl: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
  nonce:   '<?php echo wp_create_nonce( 'diagnosis-nonce' ); ?>'
};
</script>

<?php get_footer(); ?>
