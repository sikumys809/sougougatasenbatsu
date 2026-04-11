<?php
/**
 * tag.php
 * タグアーカイブページ
 *
 * @package keikyo-theme
 */

get_header();

$current_tag = get_queried_object();
$tag_id      = $current_tag->term_id;
$tag_name    = $current_tag->name;
$tag_desc    = $current_tag->description;

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$posts_query = new WP_Query( [
    'post_type'      => 'post',
    'tag_id'         => $tag_id,
    'posts_per_page' => 10,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
?>

<main class="site-main" id="main">
<div class="category-page">

    <!-- タグヘッダー -->
    <div class="cat-hero">
        <div class="container">

            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
                    </li>
                    <li class="breadcrumb__item is-current" aria-current="page">
                        #<?php echo esc_html( $tag_name ); ?>
                    </li>
                </ol>
            </nav>

            <h1 class="cat-hero__title">
                #<?php echo esc_html( $tag_name ); ?>
                <span class="cat-hero__title-suffix">の記事一覧</span>
            </h1>

            <?php if ( $tag_desc ) : ?>
            <div class="cat-hero__desc">
                <?php echo wp_kses_post( $tag_desc ); ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="container">

        <section class="cat-posts" aria-label="記事一覧">

            <?php if ( $posts_query->have_posts() ) : ?>

            <div class="cat-section-header">
                <h2 class="cat-section-title">記事一覧</h2>
                <span class="cat-section-count">
                    <?php echo esc_html( $posts_query->found_posts ); ?>件
                </span>
            </div>

            <div class="post-list">
                <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                <article class="post-card post-card--list">
                    <a href="<?php the_permalink(); ?>" class="post-card__link">
                        <div class="post-card__thumb">
                            <?php if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'keikyo-card', [ 'class' => 'post-card__img object-cover', 'alt' => get_the_title() ] );
                            else : ?>
                                <div class="post-card__img-placeholder"></div>
                            <?php endif; ?>
                        </div>
                        <div class="post-card__body">
                            <div class="post-card__meta">
                                <time class="post-card__date"
                                      datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
                                    <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
                                </time>
                                <?php $first_cat = get_the_category(); if ( $first_cat ) : ?>
                                <span class="post-card__cat">
                                    <?php echo esc_html( $first_cat[0]->name ); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            <h3 class="post-card__title line-clamp-2">
                                <?php the_title(); ?>
                            </h3>
                            <p class="post-card__excerpt line-clamp-2">
                                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 60, '…' ) ); ?>
                            </p>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <nav class="pagination" aria-label="ページナビゲーション">
                <?php
                echo paginate_links( [
                    'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, $paged ),
                    'total'     => $posts_query->max_num_pages,
                    'prev_text' => '‹ 前へ',
                    'next_text' => '次へ ›',
                    'type'      => 'list',
                ] );
                ?>
            </nav>

            <?php else : ?>
            <div class="cat-empty">
                <p class="cat-empty__text">このタグの記事はまだありません。</p>
            </div>
            <?php endif; ?>

        </section>

    </div>

</div>
</main>

<?php get_footer(); ?>
