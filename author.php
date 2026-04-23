<?php
/**
 * author.php
 * 著者アーカイブページ
 */

get_header();

$author_obj = get_queried_object();
if ( ! $author_obj ) {
    get_footer();
    exit;
}

$author_id       = (int) $author_obj->ID;
$author_name     = get_the_author_meta( 'display_name', $author_id );
$author_bio      = get_the_author_meta( 'description', $author_id );
$author_role     = get_user_meta( $author_id, 'keikyo_author_role', true );
$author_tags_raw = get_user_meta( $author_id, 'keikyo_author_tags', true );
$author_tags     = $author_tags_raw
    ? array_filter( array_map( 'trim', explode( ',', $author_tags_raw ) ) )
    : [];
$post_count      = (int) count_user_posts( $author_id, 'post', true );

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$author_query = new WP_Query( [
    'author'         => $author_id,
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
?>

<main class="site-main" id="main">
<div class="author-archive">

    <section class="author-hero">
        <div class="author-hero__inner">

            <nav class="author-breadcrumb" aria-label="パンくずリスト">
                <ol class="author-breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url('/') ); ?>">トップ</a></li>
                    <li><a href="<?php echo esc_url( home_url('/authors/') ); ?>">著者</a></li>
                    <li class="is-current"><?php echo esc_html( $author_name ); ?></li>
                </ol>
            </nav>

            <div class="author-hero__main">
                <div class="author-hero__avatar">
                    <?php echo get_avatar( $author_id, 120, '', esc_attr( $author_name ), [ 'class' => 'author-hero__avatar-img' ] ); ?>
                </div>

                <div class="author-hero__info">
                    <p class="author-hero__eyebrow">AUTHOR</p>
                    <h1 class="author-hero__name"><?php echo esc_html( $author_name ); ?></h1>
                    <?php if ( $author_role ) : ?>
                    <p class="author-hero__role"><?php echo esc_html( $author_role ); ?></p>
                    <?php endif; ?>

                    <?php if ( $author_tags ) : ?>
                    <div class="author-hero__tags">
                        <?php foreach ( $author_tags as $tag ) : ?>
                        <span class="author-hero__tag"><?php echo esc_html( $tag ); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( $author_bio ) : ?>
                    <p class="author-hero__bio"><?php echo nl2br( esc_html( $author_bio ) ); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="author-hero__stats">
                <div class="author-stat">
                    <p class="author-stat__value"><?php echo esc_html( $post_count ); ?></p>
                    <p class="author-stat__label">投稿記事</p>
                </div>
            </div>

        </div>
    </section>

    <section class="author-posts">
        <div class="author-posts__inner">

            <div class="author-posts__header">
                <h2 class="author-posts__title">この著者の記事</h2>
                <p class="author-posts__count">全<?php echo esc_html( $post_count ); ?>件</p>
            </div>

            <?php if ( $author_query->have_posts() ) : ?>
            <div class="author-posts__grid">
                <?php while ( $author_query->have_posts() ) : $author_query->the_post();
                    $cats = get_the_category();
                ?>
                <a href="<?php the_permalink(); ?>" class="author-post-card">
                    <div class="author-post-card__thumb">
                        <?php if ( has_post_thumbnail() ) :
                            the_post_thumbnail( 'medium_large', [ 'class' => 'author-post-card__img' ] );
                        else : ?>
                            <div class="author-post-card__img-placeholder"></div>
                        <?php endif; ?>
                    </div>
                    <div class="author-post-card__body">
                        <?php if ( $cats ) : ?>
                        <p class="author-post-card__cat"><?php echo esc_html( $cats[0]->name ); ?></p>
                        <?php endif; ?>
                        <h3 class="author-post-card__title"><?php the_title(); ?></h3>
                        <p class="author-post-card__date"><?php echo esc_html( get_the_date('Y.m.d') ); ?></p>
                    </div>
                </a>
                <?php endwhile; ?>
            </div>

            <?php
            $big   = 999999999;
            $links = paginate_links( [
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'current'   => max( 1, $paged ),
                'total'     => $author_query->max_num_pages,
                'prev_text' => '‹ 前へ',
                'next_text' => '次へ ›',
                'type'      => 'array',
            ] );
            if ( $links ) : ?>
            <nav class="author-pagination" aria-label="ページネーション">
                <?php foreach ( $links as $link ) : ?>
                <span class="author-pagination__item"><?php echo $link; ?></span>
                <?php endforeach; ?>
            </nav>
            <?php endif;
            wp_reset_postdata();
            ?>

            <?php else : ?>
            <p class="author-posts__empty">この著者の記事はまだありません。</p>
            <?php endif; ?>

        </div>
    </section>

</div>
</main>

<?php get_footer(); ?>
