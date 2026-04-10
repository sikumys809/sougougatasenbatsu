<?php
/**
 * Interview signature quote.
 *
 * Design reminder:
 * - 一言の強さを見せるセクションなので、余白とタイポグラフィで格を出す。
 * - 情報が少ない場合は無理に飾らず、引用文だけで成立させる。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['signature_quote'] ) ) {
	return;
}

$quote_group = isset( $context['signature_quote_group'] ) ? $context['signature_quote_group'] : array();
$quote       = isset( $quote_group['signature_quote'] ) ? $quote_group['signature_quote'] : '';
$author      = isset( $quote_group['signature_quote_author'] ) ? $quote_group['signature_quote_author'] : '';
?>
<section class="keikyo-interview-signature-quote">
	<div class="keikyo-interview-container">
		<blockquote class="keikyo-interview-signature-quote__body">
			<p class="keikyo-interview-signature-quote__text"><?php echo nl2br( esc_html( $quote ) ); ?></p>
			<?php if ( ! empty( $author ) ) : ?>
				<footer class="keikyo-interview-signature-quote__author"><?php echo esc_html( $author ); ?></footer>
			<?php endif; ?>
		</blockquote>
	</div>
</section>
