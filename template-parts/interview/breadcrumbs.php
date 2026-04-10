<?php
/**
 * Interview breadcrumbs.
 *
 * Design reminder:
 * - 情報量を絞り、ヒーロー後の呼吸を整える役割として使う。
 * - 既存テーマに馴染むよう、装飾は控えめだが視線誘導は明確にする。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();
$items   = function_exists( 'keikyo_interview_get_breadcrumb_items' ) ? keikyo_interview_get_breadcrumb_items( $context ) : array();

if ( empty( $items ) ) {
	return;
}
?>
<nav class="keikyo-interview-breadcrumbs" aria-label="パンくず">
	<div class="keikyo-interview-container">
		<ol class="keikyo-interview-breadcrumbs__list">
			<?php foreach ( $items as $index => $item ) : ?>
				<li class="keikyo-interview-breadcrumbs__item">
					<?php if ( ! empty( $item['url'] ) && $index !== count( $items ) - 1 ) : ?>
						<a href="<?php echo esc_url( $item['url'] ); ?>" class="keikyo-interview-breadcrumbs__link"><?php echo esc_html( $item['label'] ); ?></a>
					<?php else : ?>
						<span class="keikyo-interview-breadcrumbs__current"><?php echo esc_html( $item['label'] ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</nav>
