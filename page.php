<?php
/**
 * page.php
 * 固定ページ テンプレート（サイドバーレイアウト版）
 * PC: メイン8 + サイドバー2 / モバイル: メインのみ
 */

get_header();

if ( ! have_posts() ) {
    get_footer();
    exit;
}

while ( have_posts() ) :
    the_post();

    // 新着記事（サイドバー用・5件）
    $latest_query = new WP_Query( [
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    ] );
?>

<main class="site-main" id="main">
<article class="single-page" <?php post_class(); ?>>

    <!-- ===== ヒーロー（全幅） ===== -->
    <div class="single-hero">
        <div class="single-hero__inner">

            <!-- パンくず -->
            <nav class="single-breadcrumb" aria-label="パンくずリスト">
                <ol class="single-breadcrumb__list">
                    <li class="single-breadcrumb__item">
                        <a href="<?php echo esc_url( home_url('/') ); ?>">トップ</a>
                    </li>
                    <li class="single-breadcrumb__item is-current" aria-current="page">
                        <?php the_title(); ?>
                    </li>
                </ol>
            </nav>

            <!-- タイトル -->
            <h1 class="single-hero__title"><?php the_title(); ?></h1>

        </div>
    </div><!-- /.single-hero -->


    <!-- ===== メイン + サイドバー ===== -->
    <div class="single-outer">
        <div class="single-layout">

            <!-- ── メインカラム ── -->
            <div class="single-main">

                <!-- アイキャッチ -->
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="single-thumb">
                    <?php the_post_thumbnail( 'keikyo-card', [
                        'class' => 'single-thumb__img',
                        'alt'   => get_the_title(),
                    ] ); ?>
                </div>
                <?php endif; ?>

                <!-- 本文 -->
                <div class="single-content-wrap">
                    <div class="entry-content single-content">
                        <?php the_content(); ?>
                    </div>
                </div>

            </div><!-- /.single-main -->


            <!-- ── サイドバー（PC のみ表示） ── -->
            <aside class="single-sidebar">

                <!-- 新着記事 -->
                <?php if ( $latest_query->have_posts() ) : ?>
                <div class="sidebar-widget">
                    <div class="sidebar-widget__head">新着記事</div>
                    <div class="sidebar-widget__body">
                        <?php while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="sidebar-post">
                            <div class="sidebar-post__thumb">
                                <?php if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'thumbnail', [ 'class' => 'sidebar-post__img' ] );
                                else : ?>
                                    <div class="sidebar-post__img-placeholder"></div>
                                <?php endif; ?>
                            </div>
                            <div class="sidebar-post__body">
                                <p class="sidebar-post__title"><?php the_title(); ?></p>
                                <p class="sidebar-post__date"><?php echo esc_html( get_the_date('Y.m.d') ); ?></p>
                            </div>
                        </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

            </aside><!-- /.single-sidebar -->

        </div><!-- /.single-layout -->
    </div><!-- /.single-outer -->

</article>
</main>

<?php
endwhile;
get_footer();
?>
