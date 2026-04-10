<?php
/**
 * Interview message section.
 *
 * Design reminder:
 * - 完成見本どおり、左にYouTube動画、右に塾長プロフィールと相談内容カードを置く。
 * - 管理画面で可変なのは塾長写真と動画URLのみとし、文言は指示書の固定テキストを使う。
 * - 動画未設定時もカード側だけで成立するようにする。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['message'] ) ) {
	return;
}

$section     = isset( $context['message_section'] ) ? $context['message_section'] : array();
$advisor_img = isset( $section['message_advisor_image'] ) ? $section['message_advisor_image'] : array();
$advisor_url = function_exists( 'keikyo_interview_get_image_url' ) ? keikyo_interview_get_image_url( $advisor_img, 'medium_large' ) : '';
$advisor_alt = function_exists( 'keikyo_interview_get_image_alt' ) ? keikyo_interview_get_image_alt( $advisor_img, '上林山 大吉' ) : '上林山 大吉';
$video_url   = isset( $section['message_youtube_url'] ) ? trim( (string) $section['message_youtube_url'] ) : '';
$youtube_id  = '';

if ( '' !== $video_url ) {
	if ( preg_match( '#(?:youtu\.be/|v=|embed/|shorts/)([A-Za-z0-9_-]{11})#', $video_url, $matches ) ) {
		$youtube_id = $matches[1];
	}
}

$benefits = array(
	'あなたの経験・成績・志望校から合格可能性を診断',
	'活動実績の整理・言語化のアドバイス',
	'志望理由書の方向性や構成案の相談',
	'面接対策のポイントと練習方法',
	'総合型選抜のスケジュールと準備計画',
);
?>
<section id="message" class="keikyo-interview-closing-video keikyo-interview-message">
	<div class="keikyo-interview-container keikyo-interview-closing-video__container">
		<div class="keikyo-interview-section-heading keikyo-interview-section-heading--centered">
			<p class="keikyo-interview-section-heading__eyebrow">MESSAGE</p>
			<h2 class="keikyo-interview-section-heading__title">塾長からのメッセージ</h2>
			<p class="keikyo-interview-section-heading__description">無料相談で、あなたの可能性を診断しませんか？</p>
		</div>

		<div class="keikyo-interview-closing-video__layout<?php echo '' === $youtube_id ? ' is-no-video' : ''; ?>">
			<?php if ( '' !== $youtube_id ) : ?>
				<div class="keikyo-interview-closing-video__media">
					<div class="keikyo-interview-closing-video__embed">
						<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" title="塾長からのメッセージ" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</div>
			<?php endif; ?>

			<div class="keikyo-interview-closing-video__content">
				<div class="keikyo-interview-advisor-card keikyo-interview-message__advisor-card">
					<?php if ( '' !== $advisor_url ) : ?>
						<div class="keikyo-interview-advisor-card__visual">
							<img src="<?php echo esc_url( $advisor_url ); ?>" alt="<?php echo esc_attr( $advisor_alt ); ?>" class="keikyo-interview-advisor-card__image" loading="lazy" />
						</div>
					<?php endif; ?>
					<div class="keikyo-interview-advisor-card__content">
						<p class="keikyo-interview-advisor-card__title">塾長</p>
						<h3 class="keikyo-interview-advisor-card__name">上林山 大吉</h3>
						<p class="keikyo-interview-message__advisor-credentials">京都大学 経済学部 経済経営学科卒</p>
						<div class="keikyo-interview-message__advisor-background">
							<p>東大寺学園高等学校卒。総合型選抜（AO入試）にて京都大学経済学部に現役合格。高校時代は生徒会長として学校運営に携わる。知性を競う全国放送のクイズ番組「Qさま!!」出演。</p>
						</div>
					</div>
				</div>

				<div class="keikyo-interview-closing-video__benefits keikyo-interview-message__benefits">
					<h3 class="keikyo-interview-closing-video__benefits-title">無料相談でできること</h3>
					<ul class="keikyo-interview-closing-video__benefits-list">
						<?php foreach ( $benefits as $benefit ) : ?>
							<li class="keikyo-interview-closing-video__benefit-item"><?php echo esc_html( $benefit ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
