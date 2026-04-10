<?php
/**
 * Interview structure intro and side CTA.
 *
 * Design reminder:
 * - 本文前の導線は「編集記事の前置き」と「読み進めるための目次」を分けて見せる。
 * - 右側案内カードは広告ではなく、読者の次の行動を静かに後押しする役割に留める。
 * - TOC や案内カードが欠けても、本文前の説明だけで自然に成立させる。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['structure_intro'] ) && empty( $context['show_toc'] ) ) {
	return;
}

$section         = isset( $context['structure_intro'] ) ? $context['structure_intro'] : array();
$toc_items       = isset( $context['toc_items'] ) ? $context['toc_items'] : array();
$show_toc        = ! empty( $context['show_toc'] );
$show_side_cta   = ! empty( $context['show_side_cta'] );
$side_cta_points = isset( $context['side_cta_points'] ) ? $context['side_cta_points'] : array();
$layout_class    = 'keikyo-interview-structure-intro__layout';
$layout_class   .= $show_side_cta ? ' is-with-side-cta' : ' is-no-side-cta';
?>
<section class="keikyo-interview-structure-intro">
	<div class="keikyo-interview-container">
		<div class="<?php echo esc_attr( $layout_class ); ?>">
			<div class="keikyo-interview-structure-intro__main">
				<?php if ( ! empty( $section['structure_section_label'] ) || ! empty( $section['structure_intro_title'] ) || ! empty( $section['structure_intro_body'] ) ) : ?>
					<div class="keikyo-interview-structure-intro__narrative">
						<div class="keikyo-interview-section-heading keikyo-interview-structure-intro__heading">
							<?php if ( ! empty( $section['structure_section_label'] ) ) : ?>
								<p class="keikyo-interview-section-heading__eyebrow"><?php echo esc_html( $section['structure_section_label'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $section['structure_intro_title'] ) ) : ?>
								<h2 class="keikyo-interview-section-heading__title"><?php echo esc_html( $section['structure_intro_title'] ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $section['structure_intro_body'] ) ) : ?>
								<div class="keikyo-interview-section-heading__description"><?php echo wp_kses_post( wpautop( $section['structure_intro_body'] ) ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $show_toc ) : ?>
					<nav class="keikyo-interview-toc" aria-label="記事の目次">
						<div class="keikyo-interview-toc__header">
							<p class="keikyo-interview-toc__title"><?php echo esc_html( ! empty( $section['index_title'] ) ? $section['index_title'] : 'INDEX' ); ?></p>
							<p class="keikyo-interview-toc__lead">ここから先の流れを先に確認してから読み進められます。</p>
						</div>
						<ol class="keikyo-interview-toc__list">
							<?php foreach ( $toc_items as $index => $item ) : ?>
								<li class="keikyo-interview-toc__item">
									<a href="#<?php echo esc_attr( $item['id'] ); ?>" class="keikyo-interview-toc__link">
										<span class="keikyo-interview-toc__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
										<span class="keikyo-interview-toc__label"><?php echo esc_html( $item['label'] ); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ol>
					</nav>
				<?php endif; ?>
			</div>

			<?php if ( $show_side_cta ) : ?>
				<aside class="keikyo-interview-side-cta">
					<?php if ( ! empty( $section['side_cta_eyebrow'] ) ) : ?>
						<p class="keikyo-interview-side-cta__eyebrow"><?php echo esc_html( $section['side_cta_eyebrow'] ); ?></p>
					<?php endif; ?>
					<h3 class="keikyo-interview-side-cta__title"><?php echo esc_html( $section['side_cta_title'] ); ?></h3>
					<?php if ( ! empty( $side_cta_points ) ) : ?>
						<ul class="keikyo-interview-side-cta__list">
							<?php foreach ( $side_cta_points as $point ) : ?>
								<?php if ( ! empty( $point['side_cta_point_text'] ) ) : ?>
									<li class="keikyo-interview-side-cta__item"><?php echo esc_html( $point['side_cta_point_text'] ); ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<a href="<?php echo esc_url( $section['side_cta_url'] ); ?>" class="keikyo-interview-button keikyo-interview-button--primary keikyo-interview-button--block">
						<?php echo esc_html( $section['side_cta_button_label'] ); ?>
					</a>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</section>
