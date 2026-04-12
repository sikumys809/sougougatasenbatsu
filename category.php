<?php
/**
 * category.php
 * カテゴリーアーカイブページ
 *
 * 構成：
 *  A. カテゴリーヘッダー（タイトル・SEO description・パンくず）
 *  B. 子カテゴリー絞り込みボタン（子カテゴリーが存在する場合のみ表示）
 *  C. 合格者対談ゾーン（interview CPT・上部固定）
 *  D. 対策・情報記事ゾーン（通常投稿・ページネーションあり）
 */

get_header();

$current_cat    = get_queried_object();
$cat_id         = $current_cat->term_id;
$cat_name       = $current_cat->name;
$cat_desc       = $current_cat->description;
$child_cats     = keikyo_get_child_categories();
$interview_query = keikyo_get_interviews_by_category( $cat_id, 4 );
?>

<main class="site-main" id="main">
<div class="category-page">

    <!-- ============================================================
         A. カテゴリーヘッダー
         ============================================================ -->
    <div class="cat-hero">
        <div class="container">

            <!-- パンくずリスト -->
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
                    </li>
                    <?php
                    // 祖先カテゴリーを上位から順番に表示
                    $ancestors = array_reverse( get_ancestors( $cat_id, 'category' ) );
                    foreach ( $ancestors as $ancestor_id ) :
                        $ancestor = get_term( $ancestor_id, 'category' );
                        if ( ! $ancestor || is_wp_error( $ancestor ) ) continue;
                    ?>
                    <li class="breadcrumb__item">
                        <a href="<?php echo esc_url( get_term_link( $ancestor ) ); ?>">
                            <?php echo esc_html( $ancestor->name ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <li class="breadcrumb__item is-current" aria-current="page">
                        <?php echo esc_html( $cat_name ); ?>
                    </li>
                </ol>
            </nav>

            <!-- カテゴリータイトル -->
            <h1 class="cat-hero__title">
                <?php echo esc_html( $cat_name ); ?>
                <span class="cat-hero__title-suffix">の総合型選抜・AO入試情報</span>
            </h1>

            <!-- SEO description（カテゴリーの説明文） -->
            <?php if ( $cat_desc ) : ?>
            <div class="cat-hero__desc">
                <?php echo wp_kses_post( $cat_desc ); ?>
            </div>
            <?php endif; ?>

        </div>
    </div><!-- /.cat-hero -->


    <div class="container">

        <!-- ============================================================
             B. 子カテゴリー絞り込みボタン
             ============================================================ -->
        <?php if ( ! empty( $child_cats ) ) : ?>
        <div class="cat-filter" id="category-filter">
            <div class="cat-filter__inner">
                <!-- 「すべて」ボタン -->
                <button class="cat-filter__btn is-active"
                        data-cat-id="all"
                        aria-pressed="true">
                    すべて
                </button>
                <?php foreach ( $child_cats as $child ) : ?>
                <button class="cat-filter__btn"
                        data-cat-id="<?php echo esc_attr( $child->term_id ); ?>"
                        aria-pressed="false">
                    <?php echo esc_html( $child->name ); ?>
                    <span class="cat-filter__btn-count">
                        <?php echo esc_html( $child->count ); ?>
                    </span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>


        <!-- ============================================================
             C. 合格者対談ゾーン（interview CPT）
             ============================================================ -->
        <?php if ( $interview_query->have_posts() ) : ?>
        <section class="cat-interviews" aria-label="合格者の声">

            <div class="cat-section-header">
                <h2 class="cat-section-title">合格者の声</h2>
                <span class="cat-section-count">
                    <?php echo esc_html( $interview_query->found_posts ); ?>件
                </span>
            </div>

            <div class="interview-card-grid">
                <?php while ( $interview_query->have_posts() ) : $interview_query->the_post(); ?>
                <?php
                // 投稿に紐づくカテゴリーIDをdata属性用に取得
                $post_cat_ids = wp_get_post_categories( get_the_ID(), [ 'fields' => 'ids' ] );
                $post_cat_ids_str = implode( ',', $post_cat_ids );
                ?>
                <article class="interview-card post-card"
                         data-cat-ids="<?php echo esc_attr( $post_cat_ids_str ); ?>">
                    <a href="<?php the_permalink(); ?>" class="interview-card__link">

                        <!-- サムネイル -->
                        <?php
                        $iv_hd  = function_exists('keikyo_iv_get_group') ? keikyo_iv_get_group(get_the_ID(), 'hero_section') : [];
                        $iv_img = '';
                        if (!empty($iv_hd['hero_image'])) {
                            $iv_img = function_exists('keikyo_iv_image_url') ? keikyo_iv_image_url($iv_hd['hero_image'], 'large') : '';
                        }
                        if (!$iv_img) $iv_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        ?>
                        <div class="interview-card__thumb">
                            <?php if ( $iv_img ) : ?>
                                <img src="<?php echo esc_url($iv_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="interview-card__img" loading="lazy">
                            <?php else : ?>
                                <div class="interview-card__img-placeholder"></div>
                            <?php endif; ?>
                            <span class="interview-card__badge">合格者対談</span>
                            <div class="interview-card__profile">
                                <p class="interview-card__name"><?php the_title(); ?></p>
                                <?php
                                $cats = get_the_category();
                                if ( $cats ) :
                                    usort( $cats, fn( $a, $b ) => $b->term_id - $a->term_id );
                                    $display_cat = $cats[0];
                                ?>
                                <p class="interview-card__univ"><?php echo esc_html( $display_cat->name ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <!-- 4件超える場合の「もっと見る」リンク -->
            <?php if ( $interview_query->found_posts > 4 ) : ?>
            <div class="cat-interviews__more">
                <a href="<?php echo esc_url( get_term_link( $current_cat ) . '?post_type=interview' ); ?>"
                   class="btn-more">
                    合格者対談をもっと見る
                    <span class="btn-more__arrow" aria-hidden="true">→</span>
                </a>
            </div>
            <?php endif; ?>

        </section>
        <?php endif; ?>


        <!-- ============================================================
             D. 対策・情報記事ゾーン（通常投稿）
             ============================================================ -->
        <section class="cat-posts" aria-label="対策・情報記事">

            <?php
            // メインクエリから通常投稿だけ取り出す
            // ※ pre_get_posts で post + interview が混在しているため
            //   ここでは post のみ再クエリする
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $posts_query = new WP_Query( [
                'post_type'      => 'post',
                'cat'            => $cat_id,
                'posts_per_page' => 10,
                'paged'          => $paged,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ] );
            ?>

            <?php if ( $posts_query->have_posts() ) : ?>

            <div class="cat-section-header">
                <h2 class="cat-section-title">対策・情報記事</h2>
                <span class="cat-section-count">
                    <?php echo esc_html( $posts_query->found_posts ); ?>件
                </span>
            </div>

            <div class="post-list">
                <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                <?php
                $post_cat_ids     = wp_get_post_categories( get_the_ID(), [ 'fields' => 'ids' ] );
                $post_cat_ids_str = implode( ',', $post_cat_ids );
                ?>
                <article class="post-card post-card--list"
                         data-cat-ids="<?php echo esc_attr( $post_cat_ids_str ); ?>">
                    <a href="<?php the_permalink(); ?>" class="post-card__link">

                        <!-- サムネイル -->
                        <div class="post-card__thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'keikyo-card', [
                                    'class' => 'post-card__img object-cover',
                                    'alt'   => get_the_title(),
                                ] ); ?>
                            <?php else : ?>
                                <div class="post-card__img-placeholder"></div>
                            <?php endif; ?>
                        </div>

                        <!-- 本文 -->
                        <div class="post-card__body">
                            <div class="post-card__meta">
                                <time class="post-card__date"
                                      datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
                                    <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
                                </time>
                                <?php
                                $first_cat = get_the_category();
                                if ( $first_cat ) : ?>
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

            <!-- 「該当なし」メッセージ（JS絞り込み用） -->
            <p class="filter-no-result" id="filter-no-result" hidden>
                該当する記事が見つかりませんでした。
            </p>

            <!-- ページネーション -->
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

            <!-- 記事が1件もない場合 -->
            <div class="cat-empty">
                <p class="cat-empty__text">
                    まだ記事がありません。準備中です。
                </p>
            </div>

            <?php endif; ?>

        </section>

    </div><!-- /.container -->

</div><!-- /.category-page -->
</main>

<?php get_footer(); ?>
