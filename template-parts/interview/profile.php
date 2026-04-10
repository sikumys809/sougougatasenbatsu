<?php
/**
 * Interview profile section.
 *
 * Design reminder:
 * - 左側は写真と合格者の言葉、右側はプロフィール情報を積み上げる二面構成にする。
 * - 情報テーブルは固定ラベルの整然さを優先し、活動実績は下段の独立ブロックで見せる。
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$context = isset( $args['context'] ) ? $args['context'] : array();
if ( empty( $context['sections_visibility']['profile'] ) ) {
	return;
}

$profile             = isset( $context['profile_section'] ) ? $context['profile_section'] : array();
$activity_chips      = isset( $context['activity_chips'] ) ? $context['activity_chips'] : array();
$profile_detail_rows = isset( $context['profile_detail_rows'] ) ? $context['profile_detail_rows'] : array();
$image               = isset( $profile['student_profile_image'] ) ? $profile['student_profile_image'] : array();
$image_url           = function_exists( 'keikyo_interview_get_image_url' ) ? keikyo_interview_get_image_url( $image, 'large' ) : '';
$image_alt           = function_exists( 'keikyo_interview_get_image_alt' ) ? keikyo_interview_get_image_alt( $image, $profile['student_name'] ?? '' ) : ( $profile['student_name'] ?? '' );
$has_image           = ! empty( $image_url );
$quote_text          = isset( $profile['student_quote'] ) ? trim( wp_strip_all_tags( $profile['student_quote'] ) ) : '';
$has_quote           = '' !== $quote_text;
?>
<section id="profile" class="keikyo-interview-profile<?php echo $has_image ? ' is-with-image' : ' is-no-image'; ?><?php echo $has_quote ? ' is-with-quote' : ' is-no-quote'; ?>">
	<div class="keikyo-interview-container">
		<header class="keikyo-interview-profile__header keikyo-interview-section-heading keikyo-interview-section-heading--centered">
			<p class="keikyo-interview-section-heading__eyebrow">PROFILE</p>
			<h2 class="keikyo-interview-section-heading__title">合格者プロフィール</h2>
		</header>

		<div class="keikyo-interview-profile__container">
			<div class="keikyo-interview-profile__visual-column">
				<?php if ( $has_image ) : ?>
					<figure class="keikyo-interview-profile__figure">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="keikyo-interview-profile__image" loading="lazy" />
					</figure>
				<?php endif; ?>

				<?php if ( $has_quote ) : ?>
					<div class="keikyo-interview-profile__quote-box">
						<p class="keikyo-interview-profile__quote-mark" aria-hidden="true">❞</p>
						<p class="keikyo-interview-profile__quote-text"><?php echo esc_html( $quote_text ); ?></p>
					</div>
				<?php endif; ?>
			</div>

			<div class="keikyo-interview-profile__content">
				<div class="keikyo-interview-profile__identity">
					<h3 class="keikyo-interview-profile__name"><?php echo esc_html( $profile['student_name'] ?? '' ); ?></h3>
					<?php if ( ! empty( $profile['student_name_kana'] ) ) : ?>
						<p class="keikyo-interview-profile__kana"><?php echo esc_html( $profile['student_name_kana'] ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $profile_detail_rows ) ) : ?>
					<dl class="keikyo-interview-profile__details">
						<?php foreach ( $profile_detail_rows as $detail_row ) : ?>
							<div class="keikyo-interview-profile__detail-row">
								<dt class="keikyo-interview-profile__detail-label"><?php echo esc_html( $detail_row['label'] ); ?></dt>
								<dd class="keikyo-interview-profile__detail-value"><?php echo wp_kses_post( wpautop( $detail_row['value'] ) ); ?></dd>
							</div>
						<?php endforeach; ?>
					</dl>
				<?php endif; ?>

				<?php if ( ! empty( $activity_chips ) ) : ?>
					<div class="keikyo-interview-profile__activity-block">
						<p class="keikyo-interview-profile__activity-heading">主な活動実績</p>
						<ul class="keikyo-interview-profile__chips" aria-label="主な活動実績">
							<?php foreach ( $activity_chips as $chip ) : ?>
								<li class="keikyo-interview-profile__chip"><?php echo esc_html( $chip['activity_chip_label'] ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
