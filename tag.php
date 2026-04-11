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

<main class="site-main tag-page" id="main">
<div class="category-page">

    <!-- タグヒーロー（sand背景） -->
    <div class="cat-hero" style="background: var(--sand); border-bottom: 1px solid rgba(0,0,0,0.06);">
        <div class="container">

            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:rgba(26,26,46,0.5);">トップ</a>
                    </li>
                    <li class="breadcrumb__item is-current" style="color:rgba(26,26,46,0.5);">
                        #<?php echo esc_html( $tag_name ); ?>
                    </li>
                </ol>
            </nav>

            <div class="cat-hero__title">
                <h1 class="cat-hero__h1" style="color: var(--navy);">
                    <span style="color: var(--red);">#</span><?php echo esc_html( $tag_name ); ?>
                </h1>
                <span class="cat-hero__title-suffix" style="color:rgba(26,26,46,0.6);">の記事一覧</span>
            </div>
            <span class="cat-hero__badge" style="border-radius: 20px;">
                <?php echo esc_html( $posts_query->found_posts ); ?>件
            </span>

        </div>
    </div>

    <div class="container">

        <section class="cat-posts" aria-label="記事一覧">

            <?php if ( $posts_query->have_posts() ) : ?>

            <div class="tag-grid">
                <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                <article class="tag-card">
                    <a href="<?php the_permalink(); ?>" class="tag-card__link" style="text-decoration:none;display:block;">
                        <div class="tag-card__thumb">
                            <?php if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'keikyo-card', [ 'alt' => get_the_title() ] );
                            else : ?>
                                <div class="tag-card__thumb-placeholder">THUMBNAIL</div>
                            <?php endif; ?>
                            <?php $first_cat = get_the_category(); if ( $first_cat ) : ?>
                            <span class="tag-card__cat-badge"><?php echo esc_html( $first_cat[0]->name ); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="tag-card__body">
                            <p class="tag-card__date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></p>
                            <h2 class="tag-card__title"><?php the_title(); ?></h2>
                            <p class="tag-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 60, '…' ) ); ?></p>
                            <span class="tag-card__link">続きを読む →</span>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <nav class="tag-pagination" aria-label="ページナビゲーション">
                <?php
                echo paginate_links( [
                    'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, $paged ),
                    'total'     => $posts_query->max_num_pages,
                    'prev_text' => '← 前へ',
                    'next_text' => '次へ →',
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
