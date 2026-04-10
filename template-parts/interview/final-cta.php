<?php
/**
 * Interview final CTA.
 *
 * Design reminder:
 * - 完成見本どおり、濃紺背景の中央寄せ構成で締める。
 * - 文言は指示書の固定テキストを優先し、可変なのは遷移先URLのみとする。
 * - ベネフィット3点と注記を明確に見せ、相談導線を最優先にする。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['final_cta'] ) ) {
	return;
}

$section      = isset( $context['final_cta_section'] ) ? $context['final_cta_section'] : array();
$primary_url  = ! empty( $section['final_cta_primary_url'] ) ? $section['final_cta_primary_url'] : 'https://lp.keikyo-seminar.jp/main01/';
$benefits     = array(
	'あなたの「強み」を一緒に見つけ、難関大学合格への最短ルートをご提案',
	'経験・成績・志望校をヒアリングし、合格可能性を無料診断',
	'「誇れるものがない…」という方にこそ、プロの視点からの発見がある',
);
?>
<section id="final-cta" class="keikyo-interview-final-cta">
	<div class="keikyo-interview-container keikyo-interview-final-cta__container">
		<div class="keikyo-interview-final-cta__center">
			<div class="keikyo-interview-final-cta__line" aria-hidden="true"></div>
			<p class="keikyo-interview-final-cta__eyebrow">逆転合格の扉は、あなたにも開かれています</p>
			<h2 class="keikyo-interview-final-cta__title">無料受験相談のお申込みはこちら</h2>
			<div class="keikyo-interview-final-cta__body">
				<p>総合型選抜は、単なる「AO入試」ではなく、あなたの人生経験すべてが評価される、最も公平な入試形式です。当塾では、堀井さんのような挫折を合格に導く支援をしてきた実績があります。</p>
			</div>

			<div class="keikyo-interview-final-cta__benefit-panel">
				<ul class="keikyo-interview-final-cta__benefits">
					<?php foreach ( $benefits as $benefit ) : ?>
						<li class="keikyo-interview-final-cta__benefit"><?php echo esc_html( $benefit ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="keikyo-interview-final-cta__actions">
				<a href="<?php echo esc_url( $primary_url ); ?>" class="keikyo-interview-button keikyo-interview-button--primary keikyo-interview-button--large keikyo-interview-final-cta__button">無料受験相談を申し込む</a>
			</div>

			<p class="keikyo-interview-final-cta__note">相談は完全無料・オンライン対応可能です</p>
		</div>
	</div>
</section>
