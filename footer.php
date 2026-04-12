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
                <a href="https://www.keikyo-seminar.jp/" target="_blank" rel="noopener noreferrer"><img src="https://www.keikyo-seminar.jp/wp-content/uploads/2026/04/SYMBOL.png" alt="慶教ゼミナール" class="keikyo-footer-logo" /></a>
                <p class="keikyo-interview-site-footer__brand-text">総合型選抜専門 × 完全オンライン塾。全国どこからでも、難関大学合格への最短ルートを設計します。</p>
            </div>

            <nav class="keikyo-interview-site-footer__column" aria-label="フッターナビゲーション">
                <h3 class="keikyo-interview-site-footer__heading">NAVIGATION</h3>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">慶教ゼミナールとは？</a>
                <a href="<?php echo esc_url( home_url( '/results/' ) ); ?>">合格実績</a>
                <a href="<?php echo esc_url( home_url( '/interview/' ) ); ?>">合格者対談</a>
                <a href="<?php echo esc_url( home_url( '/navi/' ) ); ?>">合格ナビ</a>
            </nav>

            <nav class="keikyo-interview-site-footer__column" aria-label="フッターサポート">
                <h3 class="keikyo-interview-site-footer__heading">SUPPORT</h3>
                <a href="https://bit.ly/4us051J" target="_blank" rel="noopener noreferrer">無料受験相談</a>
                <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>">適性診断</a>
                <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー</a>
            </nav>

            <div class="keikyo-interview-site-footer__column keikyo-interview-site-footer__social-column">
                <h3 class="keikyo-interview-site-footer__heading">FOLLOW US</h3>
                <div class="keikyo-interview-site-footer__socials">
                    <a href="https://line.me/R/ti/p/@712gzjgo" target="_blank" rel="noopener noreferrer">LINE公式アカウント</a>
                </div>
            </div>

        </div>

        <div class="keikyo-interview-site-footer__bottom">
            <p>© <?php echo date( 'Y' ); ?> 慶教ゼミナール All Rights Reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
