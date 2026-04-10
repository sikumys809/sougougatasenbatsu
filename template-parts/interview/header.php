<?php
/**
 * Interview sticky header.
 *
 * Design reminder:
 * - 受験導線の主要リンクと記事内導線を同じヘッダーで扱い、単記事でも一覧でも迷わせない。
 * - モバイルでは右上のタップボタンから軽く開くオーバーレイ型ナビにし、CTAを邪魔しない。
 * - 内部セクションリンクと外部リンクを混在できる構造にして再利用性を保つ。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context   = isset( $args['context'] ) ? $args['context'] : array();
$nav_items = isset( $args['nav_items'] ) && is_array( $args['nav_items'] ) ? $args['nav_items'] : array();
$menu_id   = 'keikyo-interview-mobile-nav';

$nav_items = array_values(
	array_filter(
		$nav_items,
		static function ( $item ) {
			return is_array( $item );
		}
	)
);
?>
<header class="keikyo-interview-header">
	<div class="keikyo-interview-header__inner">
		<div class="keikyo-interview-header__brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="keikyo-interview-header__brand-link" aria-label="慶教ゼミナール トップページへ戻る">
				<img src="https://www.keikyo-seminar.jp/wp-content/uploads/2025/10/LOGOTYPE.png" alt="慶教ゼミナール" class="keikyo-interview-header__brand-logo" />
			</a>
		</div>

		<?php if ( ! empty( $nav_items ) ) : ?>
			<nav class="keikyo-interview-header__nav" aria-label="合格者対談ナビゲーション">
				<ul class="keikyo-interview-header__nav-list">
					<?php foreach ( $nav_items as $item ) : ?>
						<?php
						if ( ! is_array( $item ) ) {
							continue;
						}

						$label  = isset( $item['label'] ) ? (string) $item['label'] : '';
						$url    = isset( $item['url'] ) ? (string) $item['url'] : '';
						$target = ! empty( $item['target'] ) ? (string) $item['target'] : '';
						$rel    = ! empty( $item['rel'] ) ? (string) $item['rel'] : '';

						if ( '' === $url && ! empty( $item['id'] ) ) {
							$url = '#' . ltrim( (string) $item['id'], '#' );
						}

						if ( '' === $label || '' === $url ) {
							continue;
						}
						?>
						<li class="keikyo-interview-header__nav-item">
							<a href="<?php echo esc_url( $url ); ?>" class="keikyo-interview-header__nav-link"<?php echo '' !== $target ? ' target="' . esc_attr( $target ) . '"' : ''; ?><?php echo '' !== $rel ? ' rel="' . esc_attr( $rel ) . '"' : ''; ?>>
								<?php echo esc_html( $label ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>

	<div class="keikyo-interview-header__actions">
				<button class="keikyo-interview-header__menu-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $menu_id ); ?>" aria-label="ナビゲーションを開く">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<div class="keikyo-interview-header__cta-group">
					<a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="keikyo-interview-header__cta keikyo-interview-header__cta--secondary">総合型選抜適性診断</a>
					<a href="https://lp.keikyo-seminar.jp/main01/" class="keikyo-interview-header__cta keikyo-interview-header__cta--primary" target="_blank" rel="noopener noreferrer">無料受験相談</a>
				</div>
			</div>
	</div>

	<?php if ( ! empty( $nav_items ) ) : ?>
		<div id="<?php echo esc_attr( $menu_id ); ?>" class="keikyo-interview-header__mobile-panel" hidden>
			<div class="keikyo-interview-header__mobile-panel-inner">
				<div class="keikyo-interview-header__mobile-panel-head">
					<p class="keikyo-interview-header__mobile-label">MENU</p>
					<button class="keikyo-interview-header__mobile-close" type="button" aria-label="ナビゲーションを閉じる">×</button>
				</div>
				<nav class="keikyo-interview-header__mobile-nav" aria-label="モバイルナビゲーション">
					<ul class="keikyo-interview-header__mobile-nav-list">
							<?php foreach ( $nav_items as $item ) : ?>
								<?php
								if ( ! is_array( $item ) ) {
									continue;
								}

								$label  = isset( $item['label'] ) ? (string) $item['label'] : '';

							$url    = isset( $item['url'] ) ? (string) $item['url'] : '';
							$target = ! empty( $item['target'] ) ? (string) $item['target'] : '';
							$rel    = ! empty( $item['rel'] ) ? (string) $item['rel'] : '';

							if ( '' === $url && ! empty( $item['id'] ) ) {
								$url = '#' . ltrim( (string) $item['id'], '#' );
							}

							if ( '' === $label || '' === $url ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( $url ); ?>" class="keikyo-interview-header__mobile-nav-link"<?php echo '' !== $target ? ' target="' . esc_attr( $target ) . '"' : ''; ?><?php echo '' !== $rel ? ' rel="' . esc_attr( $rel ) . '"' : ''; ?>>
									<?php echo esc_html( $label ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
					<div class="keikyo-interview-header__mobile-cta-wrap">
						<a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="keikyo-interview-header__mobile-cta keikyo-interview-header__mobile-cta--secondary">総合型選抜適性診断</a>
						<a href="https://lp.keikyo-seminar.jp/main01/" class="keikyo-interview-header__mobile-cta keikyo-interview-header__mobile-cta--primary" target="_blank" rel="noopener noreferrer">無料受験相談</a>
					</div>
			</div>
		</div>
	<?php endif; ?>
</header>
