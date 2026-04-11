<?php
/**
 * page.php
 * 固定ページ テンプレート
 *
 * @package keikyo-theme
 */

get_header();

if ( ! have_posts() ) {
    get_footer();
    exit;
}

while ( have_posts() ) :
    the_post();
?>

<main class="site-main" id="main">
<article class="single-page" <?php post_class(); ?>>

    <!-- パンくずリスト -->
    <nav class="breadcrumb single-breadcrumb" aria-label="パンくずリスト">
        <div class="container">
            <ol class="breadcrumb__list">
                <li class="breadcrumb__item">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
                </li>
                <li class="breadcrumb__item is-current" aria-current="page">
                    <?php the_title(); ?>
                </li>
            </ol>
        </div>
    </nav>

    <!-- ページヘッダー -->
    <header class="single-header">
        <div class="container container--narrow">
            <h1 class="single-header__title"><?php the_title(); ?></h1>
        </div>
    </header>

    <!-- アイキャッチ -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-thumb">
        <div class="container container--narrow">
            <?php the_post_thumbnail( 'keikyo-card', [
                'class' => 'single-thumb__img',
                'alt'   => get_the_title(),
            ] ); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- 本文 -->
    <div class="single-body">
        <div class="container container--narrow">
            <div class="entry-content single-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

</article>
</main>

<?php
endwhile;
get_footer();
?>
