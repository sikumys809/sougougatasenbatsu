<?php
/**
 * Interview hero.
 *
 * Design reminder:
 * - Excelで定義されたファーストビュー項目だけを使う。
 * - 左に本文、右に人物写真、その下に4項目の簡易情報カードを置く。
 * - 完成見本の導線に合わせ、CTAは「記事を読む」「無料相談を見る」の2つに絞る。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['hero'] ) ) {
	return;
}

$hero              = isset( $context['hero_section'] ) ? $context['hero_section'] : array();
$post_title        = isset( $context['post_id'] ) ? get_the_title( (int) $context['post_id'] ) : get_the_title();
$display_title     = isset( $hero['hero_display_title'] ) ? trim( (string) $hero['hero_display_title'] ) : '';
$legacy_title      = isset( $hero['hero_page_title'] ) ? trim( (string) $hero['hero_page_title'] ) : '';
$display_subtitle  = isset( $hero['hero_display_subtitle'] ) ? trim( (string) $hero['hero_display_subtitle'] ) : '';
$title             = '' !== $display_title ? $display_title : $legacy_title;
$lead_text         = isset( $hero['hero_lead_text'] ) ? $hero['hero_lead_text'] : '';
$image             = isset( $hero['hero_image'] ) ? $hero['hero_image'] : array();
$image_url         = function_exists( 'keikyo_interview_get_image_url' ) ? keikyo_interview_get_image_url( $image, 'full' ) : '';
$image_alt         = function_exists( 'keikyo_interview_get_image_alt' ) ? keikyo_interview_get_image_alt( $image, $title ) : $title;
$resolved_h1_title = '' !== trim( (string) $post_title ) ? $post_title : $title;
$info_items = array(
	array(
		'label' => '出身高校',
		'value' => isset( $hero['hero_info_school'] ) ? $hero['hero_info_school'] : '',
	),
	array(
		'label' => '合格先',
		'value' => isset( $hero['hero_info_result'] ) ? $hero['hero_info_result'] : '',
	),
	array(
		'label' => '入試方式',
		'value' => isset( $hero['hero_info_admission_type'] ) ? $hero['hero_info_admission_type'] : '',
	),
	array(
		'label' => '準備期間',
		'value' => isset( $hero['hero_info_period'] ) ? $hero['hero_info_period'] : '',
	),
);
?>
<section id="hero" class="keikyo-interview-hero">
	<div class="keikyo-interview-container">
		<div class="keikyo-interview-hero__container">
			<div class="keikyo-interview-hero__main">
				<p class="keikyo-interview-hero__eyebrow-wrap">
					<span class="keikyo-interview-hero__eyebrow">INTERVIEW FEATURE</span>
					<span class="keikyo-interview-hero__eyebrow-sub">合格者インタビュー</span>
				</p>

				<h1 class="screen-reader-text"><?php echo esc_html( $resolved_h1_title ); ?></h1>
				<div class="keikyo-interview-hero__headline" aria-hidden="true">
					<p class="keikyo-interview-hero__title"><?php echo esc_html( $title ); ?></p>
					<?php if ( '' !== $display_subtitle ) : ?>
						<p class="keikyo-interview-hero__subtitle"><?php echo esc_html( $display_subtitle ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( '' !== trim( wp_strip_all_tags( (string) $lead_text ) ) ) : ?>
					<div class="keikyo-interview-hero__lead"><?php echo wp_kses_post( wpautop( $lead_text ) ); ?></div>
				<?php endif; ?>

				<div class="keikyo-interview-hero__actions">
					<a href="#contents" class="keikyo-interview-hero__primary-cta">記事を読む</a>
					<a href="#message" class="keikyo-interview-hero__secondary-cta">無料相談を見る</a>
				</div>

				<p class="keikyo-interview-hero__scroll">↓ SCROLL</p>
			</div>

			<div class="keikyo-interview-hero__visual-area">
				<?php if ( '' !== $image_url ) : ?>
					<figure class="keikyo-interview-hero__figure">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="keikyo-interview-hero__image" loading="eager" />
					</figure>
				<?php endif; ?>

				<div class="keikyo-interview-hero__info-card">
					<dl class="keikyo-interview-hero__info-grid">
						<?php foreach ( $info_items as $item ) : ?>
							<?php if ( '' === trim( (string) $item['value'] ) ) : ?>
								<?php continue; ?>
							<?php endif; ?>
							<div class="keikyo-interview-hero__info-item">
								<dt class="keikyo-interview-hero__info-label"><?php echo esc_html( $item['label'] ); ?></dt>
								<dd class="keikyo-interview-hero__info-value"><?php echo esc_html( $item['value'] ); ?></dd>
							</div>
						<?php endforeach; ?>
					</dl>
				</div>
			</div>
		</div>
	</div>
</section>
