<?php
/**
 * Interview timeline section.
 *
 * Design reminder:
 * - Story Timeline は Excel 定義の4項目だけで構成する。
 * - 中央の軸に沿ってカードを左右交互に並べ、時系列の読みやすさを優先する。
 * - 見出し文言は固定表示とし、管理画面入力には依存しない。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['timeline'] ) ) {
	return;
}

$items = isset( $context['timeline_items'] ) ? $context['timeline_items'] : array();
?>
<section id="timeline" class="keikyo-interview-timeline">
	<div class="keikyo-interview-container">
		<header class="keikyo-interview-timeline__header keikyo-interview-section-heading keikyo-interview-section-heading--centered">
			<p class="keikyo-interview-section-heading__eyebrow">STORY TIMELINE</p>
			<h2 class="keikyo-interview-section-heading__title">原体験から合格までの軌跡</h2>
		</header>

		<ol class="keikyo-interview-timeline__list">
			<?php foreach ( $items as $index => $item ) : ?>
				<?php $position_class = 0 === $index % 2 ? ' is-left' : ' is-right'; ?>
				<li class="keikyo-interview-timeline__item<?php echo esc_attr( $position_class ); ?>">
					<div class="keikyo-interview-timeline__marker" aria-hidden="true"></div>
					<article class="keikyo-interview-timeline__card">
						<?php if ( ! empty( $item['timeline_keyword'] ) ) : ?>
							<p class="keikyo-interview-timeline__keyword"><?php echo esc_html( $item['timeline_keyword'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $item['timeline_period'] ) ) : ?>
							<p class="keikyo-interview-timeline__period"><?php echo esc_html( $item['timeline_period'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $item['timeline_item_title'] ) ) : ?>
							<h3 class="keikyo-interview-timeline__title"><?php echo esc_html( $item['timeline_item_title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $item['timeline_item_body'] ) ) : ?>
							<div class="keikyo-interview-timeline__body"><?php echo wp_kses_post( wpautop( $item['timeline_item_body'] ) ); ?></div>
						<?php endif; ?>
					</article>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
