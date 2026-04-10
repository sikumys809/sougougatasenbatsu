<?php
/**
 * footer.php — 慶教ゼミナール 共通フッター
 *
 * @package keikyo-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer class="keikyo-interview-site-footer">
    <div class="keikyo-interview-container keikyo-interview-site-footer__container">
        <div class="keikyo-interview-site-footer__grid">

            <div class="keikyo-interview-site-footer__brand">
                <h2 class="keikyo-interview-site-footer__brand-name">慶教ゼミナール</h2>
                <p class="keikyo-interview-site-footer__brand-text">総合型選抜対策に特化した受験塾。高校生一人ひとりの経験を武器に変え、難関大学合格への最短ルートを提案します。</p>
            </div>

            <nav class="keikyo-interview-site-footer__column" aria-label="フッターナビゲーション">
                <h3 class="keikyo-interview-site-footer__heading">NAVIGATION</h3>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">慶教ゼミナールとは？</a>
                <a href="<?php echo esc_url( home_url( '/results/' ) ); ?>">合格実績</a>
                <a href="<?php echo esc_url( home_url( '/interview/' ) ); ?>">合格者対談</a>
                <a href="<?php echo esc_url( home_url( '/navi/' ) ); ?>">合格ナビ</a>
            </nav>

            <nav class="keikyo-interview-site-footer__column" aria-label="フッターサポート">
                <h3 class="keikyo-interview-site-footer__heading">SUPPORT</h3>
                <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>">総合型選抜適性診断</a>
                <a href="https://lp.keikyo-seminar.jp/main01/" target="_blank" rel="noopener noreferrer">無料受験相談</a>
                <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">よくある質問</a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a>
                <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー</a>
            </nav>

            <div class="keikyo-interview-site-footer__column keikyo-interview-site-footer__social-column">
                <h3 class="keikyo-interview-site-footer__heading">FOLLOW US</h3>
                <div class="keikyo-interview-site-footer__socials">
                    <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer">YouTube</a>
                    <a href="https://x.com/" target="_blank" rel="noopener noreferrer">X</a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">Instagram</a>
                    <a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer">TikTok</a>
                </div>
            </div>

        </div>

        <div class="keikyo-interview-site-footer__bottom">
            <p>© <?php echo date( 'Y' ); ?> 慶教ゼミナール. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
