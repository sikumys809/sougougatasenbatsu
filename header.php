<?php
/**
 * header.php — 慶教ゼミナール 共通ヘッダー
 * @package keikyo-theme
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Noto+Sans+JP:wght@400;500;600;700&display=swap" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="keikyo-interview-header" id="site-header">
  <div class="keikyo-interview-header__inner">

    <div class="keikyo-interview-header__brand">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="keikyo-interview-header__brand-link" aria-label="慶教ゼミナール トップへ">
        <img src="https://www.keikyo-seminar.jp/wp-content/uploads/2026/01/LOGO.png" alt="慶教ゼミナール" class="keikyo-interview-header__brand-logo">
      </a>
    </div>

    <nav class="keikyo-interview-header__nav" aria-label="グローバルナビゲーション">
      <ul class="keikyo-interview-header__nav-list">
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="keikyo-interview-header__nav-link<?php echo is_page('about') ? ' is-current' : ''; ?>">慶教ゼミナールとは？</a></li>
        <li><a href="<?php echo esc_url( home_url( '/results/' ) ); ?>" class="keikyo-interview-header__nav-link">合格実績</a></li>
        <li><a href="<?php echo esc_url( home_url( '/interview/' ) ); ?>" class="keikyo-interview-header__nav-link">合格者対談</a></li>
        <li><a href="<?php echo esc_url( home_url( '/navi/' ) ); ?>" class="keikyo-interview-header__nav-link">合格ナビ</a></li>
      </ul>
    </nav>

    <div class="keikyo-interview-header__actions">
      <button class="keikyo-interview-header__menu-toggle" type="button" aria-expanded="false" aria-controls="keikyo-mobile-nav" aria-label="メニューを開く">
        <span></span><span></span><span></span>
      </button>
      <div class="keikyo-interview-header__cta-group">
        <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="keikyo-interview-header__cta keikyo-interview-header__cta--secondary">総合型選抜適性診断</a>
        <a href="https://bit.ly/4us051J" class="keikyo-interview-header__cta keikyo-interview-header__cta--primary" target="_blank" rel="noopener noreferrer">無料受験相談</a>
      </div>
    </div>

  </div>

  <div id="keikyo-mobile-nav" class="keikyo-interview-header__mobile-panel" hidden>
    <div class="keikyo-interview-header__mobile-panel-inner">
      <div class="keikyo-interview-header__mobile-panel-head">
        <p class="keikyo-interview-header__mobile-label">MENU</p>
        <button class="keikyo-interview-header__mobile-close" type="button" aria-label="メニューを閉じる">×</button>
      </div>
      <nav class="keikyo-interview-header__mobile-nav">
        <ul class="keikyo-interview-header__mobile-nav-list">
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="keikyo-interview-header__mobile-nav-link">慶教ゼミナールとは？</a></li>
          <li><a href="<?php echo esc_url( home_url( '/results/' ) ); ?>" class="keikyo-interview-header__mobile-nav-link">合格実績</a></li>
          <li><a href="<?php echo esc_url( home_url( '/interview/' ) ); ?>" class="keikyo-interview-header__mobile-nav-link">合格者対談</a></li>
          <li><a href="<?php echo esc_url( home_url( '/navi/' ) ); ?>" class="keikyo-interview-header__mobile-nav-link">合格ナビ</a></li>
        </ul>
      </nav>
      <div class="keikyo-interview-header__mobile-cta-wrap">
        <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="keikyo-interview-header__mobile-cta keikyo-interview-header__mobile-cta--secondary">総合型選抜適性診断</a>
        <a href="https://bit.ly/4us051J" class="keikyo-interview-header__mobile-cta keikyo-interview-header__mobile-cta--primary" target="_blank" rel="noopener noreferrer">無料受験相談</a>
      </div>
    </div>
  </div>
</header>
