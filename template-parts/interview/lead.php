<?php
/**
 * Interview contents section.
 *
 * Design reminder:
 * - 完成見本どおり、上段は4つの要点カード、下段は左に動画・右におすすめ枠の2カラムで構成する。
 * - 可変項目はExcel定義のContents入力のみを使い、固定見出しと補足文で読み始めの整理感を出す。
 * - 対談動画が未入力でも、上段カードとおすすめ枠だけで自然に成立させる。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = isset( $args['context'] ) ? $args['context'] : array();

if ( empty( $context['sections_visibility']['lead'] ) ) {
	return;
}

$lead              = isset( $context['lead_section'] ) ? $context['lead_section'] : array();
$recommended_items = isset( $context['recommended_items'] ) ? $context['recommended_items'] : array();
$video_url         = isset( $lead['contents_youtube_url'] ) ? trim( (string) $lead['contents_youtube_url'] ) : '';
$youtube_id        = '';

if ( '' !== $video_url && preg_match( '#(?:youtu\.be/|v=|embed/|shorts/)([A-Za-z0-9_-]{11})#', $video_url, $matches ) ) {
	$youtube_id = $matches[1];
}

$content_cards = array(
	array(
		'icon'  => '◫',
		'title' => 'リアルなストーリー',
		'body'  => isset( $lead['contents_story'] ) ? $lead['contents_story'] : '',
	),
	array(
		'icon'  => '◌',
		'title' => '探究活動の作り方',
		'body'  => isset( $lead['contents_inquiry'] ) ? $lead['contents_inquiry'] : '',
	),
	array(
		'icon'  => '▣',
		'title' => '志望理由書の秘訣',
		'body'  => isset( $lead['contents_reason'] ) ? $lead['contents_reason'] : '',
	),
	array(
		'icon'  => '◎',
		'title' => '受験戦略と面接対策',
		'body'  => isset( $lead['contents_strategy'] ) ? $lead['contents_strategy'] : '',
	),
);

$has_cards = false;
foreach ( $content_cards as $card ) {
	if ( '' !== trim( (string) $card['body'] ) ) {
		$has_cards = true;
		break;
	}
}
?>
<section id="contents" class="keikyo-interview-lead keikyo-interview-contents">
	<div class="keikyo-interview-container">
		<div class="keikyo-interview-section-heading keikyo-interview-section-heading--centered">
			<p class="keikyo-interview-section-heading__eyebrow">CONTENTS</p>
			<h2 class="keikyo-interview-section-heading__title">この記事でわかること</h2>
		</div>

		<?php if ( $has_cards ) : ?>
			<div class="keikyo-interview-contents__cards">
				<?php foreach ( $content_cards as $card ) : ?>
					<?php if ( '' === trim( (string) $card['body'] ) ) : ?>
						<?php continue; ?>
					<?php endif; ?>
					<article class="keikyo-interview-contents__card">
						<p class="keikyo-interview-contents__card-icon" aria-hidden="true"><?php echo esc_html( $card['icon'] ); ?></p>
						<h3 class="keikyo-interview-contents__card-title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="keikyo-interview-contents__card-body"><?php echo esc_html( $card['body'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( '' !== $youtube_id || ! empty( $recommended_items ) ) : ?>
			<div class="keikyo-interview-contents__lower<?php echo '' === $youtube_id ? ' is-no-video' : ''; ?>">
				<?php if ( '' !== $youtube_id ) : ?>
					<div class="keikyo-interview-contents__video-block">
						<h3 class="keikyo-interview-contents__subheading">対談動画で見る合格ストーリー</h3>
						<div class="keikyo-interview-contents__video-embed">
							<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" title="対談動画で見る合格ストーリー" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<p class="keikyo-interview-contents__video-note">本記事は上記の対談動画の内容をもとに、合格要因を解説した記事です</p>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $recommended_items ) ) : ?>
					<aside class="keikyo-interview-contents__recommended">
						<h3 class="keikyo-interview-contents__recommended-title">こんな人におすすめ</h3>
						<ul class="keikyo-interview-contents__recommended-list">
							<?php foreach ( $recommended_items as $item ) : ?>
								<li class="keikyo-interview-contents__recommended-item"><?php echo esc_html( $item['recommended_text'] ); ?></li>
							<?php endforeach; ?>
						</ul>
					</aside>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
