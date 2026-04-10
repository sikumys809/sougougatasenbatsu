<?php
/**
 * Template Name: 総合型選抜適性診断
 * Description: 15問の4択診断システム
 * Version: 1.2.2
 */

get_header();
?>

<div id="diagnosis-container" class="diagnosis-wrapper">
    
    <!-- 診断開始画面 -->
    <section id="diagnosis-intro" class="diagnosis-section diagnosis-intro active">
        
        <!-- バナー画像 -->
        <div class="diagnosis-banner">
            <img src="https://www.keikyo-seminar.jp/wp-content/uploads/2026/03/eikichi_shindan.jpeg" 
                 alt="総合型選抜適性診断システム" 
                 class="diagnosis-banner-img">
        </div>
        
        <div class="diagnosis-content-box">
            <h1 class="diagnosis-title">総合型選抜適性診断</h1>
            <p class="diagnosis-description">
                15問の質問に答えて、あなたに最適な総合型選抜のタイプを見つけましょう！<br>
                所要時間：約3〜4分
            </p>
            
            <button id="start-diagnosis-btn" class="diagnosis-btn diagnosis-btn-primary">
                診断をスタート
            </button>
        </div>
    </section>
    
    <!-- 診断クイズ画面 -->
    <section id="diagnosis-quiz" class="diagnosis-section diagnosis-quiz">
        <div class="diagnosis-progress-container">
            <div class="diagnosis-progress-bar">
                <div id="progress-fill" class="diagnosis-progress-fill"></div>
            </div>
            <p class="diagnosis-progress-text">
                質問 <span id="current-question">1</span> / 15
            </p>
        </div>
        
        <div class="diagnosis-content-box">
            <h2 id="question-text" class="diagnosis-question-text"></h2>
            <div id="answers-container" class="diagnosis-answer-container"></div>
            
            <div class="diagnosis-navigation">
                <button id="prev-btn" class="diagnosis-btn diagnosis-btn-secondary" style="display: none;">
                    ← 前の質問へ
                </button>
                <button id="next-btn" class="diagnosis-btn diagnosis-btn-primary" disabled>
                    次の質問へ →
                </button>
            </div>
        </div>
    </section>
    
    <!-- 診断結果画面 -->
    <section id="diagnosis-result" class="diagnosis-section diagnosis-result">
        <div class="diagnosis-content-box">
            <h2 class="diagnosis-result-title">診断結果</h2>
            <div id="result-type-badge" class="diagnosis-result-badge"></div>
            
            <div class="diagnosis-result-section">
                <h3>あなたのタイプ</h3>
                <p id="result-description"></p>
            </div>
            
            <div class="diagnosis-result-section">
                <h3>強み</h3>
                <div id="result-strengths"></div>
            </div>
            
            <div class="diagnosis-result-section">
                <h3>おすすめの活動</h3>
                <div id="result-activities"></div>
            </div>
            
            <div class="diagnosis-result-section">
                <h3>総合型選抜に向けて準備すべきこと</h3>
                <div id="result-preparation"></div>
            </div>
            
            <div class="diagnosis-result-section">
                <h3>向いている学部例</h3>
                <div id="result-faculties"></div>
            </div>
            
            <div class="diagnosis-cta">
                <p>あなたに合った総合型選抜対策を詳しく知りたい方は、LINEでご相談ください。</p>
                <a href="https://line.me/R/ti/p/@712gzjgo" 
                   class="diagnosis-btn diagnosis-btn-line" 
                   target="_blank" rel="noopener">
                    LINE で相談する
                </a>
            </div>
            
            <button id="restart-btn" class="diagnosis-btn diagnosis-btn-secondary">
                もう一度診断する
            </button>
        </div>
    </section>
    
    <!-- ローディング表示 -->
    <div id="diagnosis-loading" class="diagnosis-loading">
        <div class="diagnosis-spinner"></div>
        <p>診断結果を計算中...</p>
    </div>
    
</div>

<script>
// WordPress Ajax 設定をJavaScriptに渡す
var diagnosisAjax = {
    ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
    nonce: '<?php echo wp_create_nonce('diagnosis-nonce'); ?>'
};
</script>

<?php get_footer(); ?>
