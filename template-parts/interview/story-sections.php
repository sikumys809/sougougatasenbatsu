<?php
/**
 * Interview article body.
 *
 * Design reminder:
 * - 本文エリアは独自の構造化入力ではなく、通常のWordPress投稿本文をそのまま表示する。
 * - 見出し、段落、引用などの標準ブロックを活かし、装飾は外側の余白とタイポグラフィで整える。
 * - 本文の流れを遮る追加UIは置かず、完成イメージの読み物感を優先する。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();
$post_id = isset( $context['post_id'] ) ? (int) $context['post_id'] : get_the_ID();
$content = get_post_field( 'post_content', $post_id );

if ( '' === trim( wp_strip_all_tags( (string) $content ) ) ) {
	return;
}
?>
<section id="article-body" class="keikyo-interview-story keikyo-interview-article-body">
	<div class="keikyo-interview-container keikyo-interview-article-body__container">
		<div class="keikyo-interview-article-body__content entry-content">
			<?php echo apply_filters( 'the_content', $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
