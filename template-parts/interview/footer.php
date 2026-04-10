<?php
/**
 * Interview footer.
 *
 * Design reminder:
 * - 完成見本どおり、濃紺背景に4カラムでブランド・ナビ・サポート・SNSを配置する。
 * - リンクは既存の慶教ゼミナール公開導線に合わせ、記事ページ単体でも完結する構成にする。
 * - フッターはCTAの余韻を受けつつ、過不足なく静かに閉じる。
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
				<a href="https://www.keikyo-seminar.jp/" target="_blank" rel="noopener noreferrer">ホーム</a>
				<a href="https://www.keikyo-seminar.jp/archives/tag/interview-with-successful-candidates" target="_blank" rel="noopener noreferrer">合格者インタビュー</a>
				<a href="https://www.keikyo-seminar.jp/contact" target="_blank" rel="noopener noreferrer">コース案内</a>
				<a href="https://www.keikyo-seminar.jp/contact" target="_blank" rel="noopener noreferrer">講師紹介</a>
			</nav>

			<nav class="keikyo-interview-site-footer__column" aria-label="フッターサポート">
				<h3 class="keikyo-interview-site-footer__heading">SUPPORT</h3>
				<a href="https://www.keikyo-seminar.jp/faq/" target="_blank" rel="noopener noreferrer">よくある質問</a>
				<a href="https://www.keikyo-seminar.jp/contact" target="_blank" rel="noopener noreferrer">お問い合わせ</a>
				<a href="https://www.keikyo-seminar.jp/privacy" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>
				<a href="https://www.keikyo-seminar.jp/law" target="_blank" rel="noopener noreferrer">運営会社</a>
			</nav>

			<div class="keikyo-interview-site-footer__column keikyo-interview-site-footer__social-column">
				<h3 class="keikyo-interview-site-footer__heading">FOLLOW US</h3>
				<div class="keikyo-interview-site-footer__socials">
					<a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">YouTube</a>
					<a href="https://x.com/" target="_blank" rel="noopener noreferrer" aria-label="X">X</a>
					<a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">Instagram</a>
					<a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer" aria-label="TikTok">TikTok</a>
				</div>
			</div>
		</div>

		<div class="keikyo-interview-site-footer__bottom">
			<p>© 2026 慶教ゼミナール. All rights reserved.</p>
		</div>
	</div>
</footer>
