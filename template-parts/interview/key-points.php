<?php
/**
 * Interview key points section.
 *
 * Design reminder:
 * - 合格要因は記事の核なので、赤のアクセントで要点を締める。
 * - 1件でも成立し、2件以上なら横展開できる可変カード構成にする。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['key_points'] ) ) {
	return;
}

$key_points = isset( $context['key_points'] ) ? $context['key_points'] : array();
$section    = isset( $context['key_success_factors'] ) ? $context['key_success_factors'] : array();
$count      = count( $key_points );
$grid_class = 'keikyo-interview-key-points__grid';
$grid_class .= 1 === $count ? ' is-single' : '';
?>
<section id="key-points" class="keikyo-interview-key-points">
	<div class="keikyo-interview-container">
		<div class="keikyo-interview-section-heading">
			<?php if ( ! empty( $section['key_points_section_label'] ) ) : ?>
				<p class="keikyo-interview-section-heading__eyebrow"><?php echo esc_html( $section['key_points_section_label'] ); ?></p>
			<?php endif; ?>
			<h2 class="keikyo-interview-section-heading__title"><?php echo esc_html( ! empty( $section['key_points_title'] ) ? $section['key_points_title'] : '今回の合格を支えたポイント' ); ?></h2>
		</div>

		<div class="<?php echo esc_attr( $grid_class ); ?>">
			<?php foreach ( $key_points as $index => $point ) : ?>
				<article class="keikyo-interview-key-point-card">
					<p class="keikyo-interview-key-point-card__number">
						<?php echo esc_html( ! empty( $point['point_label'] ) ? $point['point_label'] : ( ! empty( $point['number'] ) ? $point['number'] : sprintf( 'Point %02d', $index + 1 ) ) ); ?>
					</p>
					<h3 class="keikyo-interview-key-point-card__title"><?php echo esc_html( isset( $point['title'] ) ? $point['title'] : '' ); ?></h3>
					<div class="keikyo-interview-key-point-card__body"><?php echo wp_kses_post( wpautop( isset( $point['body'] ) ? $point['body'] : '' ) ); ?></div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
