<?php
/**
 * single.php
 * 通常投稿 詳細ページ
 *
 * 構成：
 *  1. パンくずリスト
 *  2. 記事ヘッダー（カテゴリー・タイトル・日付・更新日・読了時間）
 *  3. アイキャッチ画像
 *  4. 目次（h2・h3を自動生成）
 *  5. 本文（entry-content）
 *  6. タグ一覧
 *  7. CTA（無料受験相談）
 *  8. 関連記事（同カテゴリーから3件）
 */

get_header();

if ( ! have_posts() ) {
    get_footer();
    exit;
}

while ( have_posts() ) :
    the_post();

    $post_id      = get_the_ID();
    $categories   = get_the_category();
    $tags         = get_the_tags();
    $content      = get_the_content();
    $consultation = 'https://lp.keikyo-seminar.jp/main01/';

    // 読了時間を計算（日本語：400文字/分）
    $text        = wp_strip_all_tags( $content );
    $char_count  = mb_strlen( $text );
    $read_min    = max( 1, (int) ceil( $char_count / 400 ) );

    // 目次用にh2・h3を抽出
    $toc_items = [];
    preg_match_all( '/<h([23])[^>]*id=["\']([^"\']*)["\'][^>]*>(.*?)<\/h[23]>/is', $content, $matches, PREG_SET_ORDER );
    if ( empty( $matches ) ) {
        // idなし → 自動付与してからもう一度抽出
        $counter = 0;
        $content = preg_replace_callback(
            '/<h([23])([^>]*)>(.*?)<\/h[23]>/is',
            function( $m ) use ( &$counter ) {
                $counter++;
                $id = 'heading-' . $counter;
                return '<h' . $m[1] . $m[2] . ' id="' . $id . '">' . $m[3] . '</h' . $m[1] . '>';
            },
            $content
        );
        preg_match_all( '/<h([23])[^>]*id=["\']([^"\']*)["\'][^>]*>(.*?)<\/h[23]>/is', $content, $matches, PREG_SET_ORDER );
    }
    foreach ( $matches as $m ) {
        $toc_items[] = [
            'level' => (int) $m[1],
            'id'    => $m[2],
            'text'  => wp_strip_all_tags( $m[3] ),
        ];
    }

    // 関連記事（同カテゴリー・自分以外・最新3件）
    $related_query = null;
    if ( $categories ) {
        $cat_ids = wp_list_pluck( $categories, 'term_id' );
        $related_query = new WP_Query( [
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => [ $post_id ],
            'category__in'   => $cat_ids,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ] );
    }
?>

<main class="site-main" id="main">
<article class="single-post" <?php post_class(); ?>>

    <!-- パンくずリスト -->
    <nav class="breadcrumb single-breadcrumb" aria-label="パンくずリスト">
        <div class="container">
            <ol class="breadcrumb__list">
                <li class="breadcrumb__item"><a href="<?php echo esc_url( home_url('/') ); ?>">トップ</a></li>
                <?php if ( $categories ) : ?>
                <li class="breadcrumb__item">
                    <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                        <?php echo esc_html( $categories[0]->name ); ?>
                    </a>
                </li>
                <?php endif; ?>
                <li class="breadcrumb__item is-current" aria-current="page">
                    <?php the_title(); ?>
                </li>
            </ol>
        </div>
    </nav>

    <!-- ============================================================
         記事ヘッダー
         ============================================================ -->
    <header class="single-header">
        <div class="container container--narrow">

            <!-- カテゴリーバッジ -->
            <?php if ( $categories ) : ?>
            <div class="single-header__cats">
                <?php foreach ( $categories as $cat ) : ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                   class="single-header__cat">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- タイトル -->
            <h1 class="single-header__title"><?php the_title(); ?></h1>

            <!-- メタ情報 -->
            <div class="single-header__meta">
                <time class="single-header__date"
                      datetime="<?php echo esc_attr( get_the_date('Y-m-d') ); ?>">
                    <?php echo esc_html( get_the_date('Y.m.d') ); ?>
                </time>
                <?php
                $modified = get_the_modified_date('Y-m-d');
                $published = get_the_date('Y-m-d');
                if ( $modified !== $published ) : ?>
                <span class="single-header__modified">
                    更新: <?php echo esc_html( get_the_modified_date('Y.m.d') ); ?>
                </span>
                <?php endif; ?>
                <span class="single-header__read-time">
                    約<?php echo esc_html( $read_min ); ?>分で読める
                </span>
            </div>

        </div>
    </header>

    <!-- ============================================================
         アイキャッチ画像
         ============================================================ -->
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

    <!-- ============================================================
         本文エリア（目次 + entry-content）
         ============================================================ -->
    <div class="single-body">
        <div class="container container--narrow">

            <!-- インライン CTA（本文前） -->
            <div class="single-cta-inline">
                <p class="single-cta-inline__text">総合型選抜について、まずは無料でご相談ください。</p>
                <a href="<?php echo esc_url( $consultation ); ?>"
                   class="single-cta-inline__btn"
                   target="_blank" rel="noopener noreferrer">
                    無料受験相談を予約する →
                </a>
            </div>

            <!-- 目次 -->
            <?php if ( count( $toc_items ) >= 3 ) : ?>
            <nav class="single-toc" aria-label="目次">
                <div class="single-toc__header">
                    <span class="single-toc__title">目次</span>
                    <button class="single-toc__toggle" aria-expanded="true" aria-controls="toc-list">
                        閉じる
                    </button>
                </div>
                <ol class="single-toc__list" id="toc-list">
                    <?php foreach ( $toc_items as $i => $item ) : ?>
                    <li class="single-toc__item single-toc__item--h<?php echo esc_attr( $item['level'] ); ?>">
                        <a href="#<?php echo esc_attr( $item['id'] ); ?>">
                            <?php echo esc_html( $item['text'] ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ol>
            </nav>
            <?php endif; ?>

            <!-- 本文 -->
            <div class="entry-content single-content">
                <?php echo apply_filters( 'the_content', $content ); ?>
            </div>

            <!-- タグ -->
            <?php if ( $tags ) : ?>
            <div class="single-tags">
                <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                   class="single-tag">
                    #<?php echo esc_html( $tag->name ); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- ============================================================
         CTA（記事下）
         ============================================================ -->
    <div class="single-cta-main">
        <div class="container container--narrow">
            <div class="iv-cta-box">
                <p class="iv-cta-box__eyebrow">あなたの強みも、言葉と戦略へ。</p>
                <h2 class="iv-cta-box__title">総合型選抜について、<br>まず話してみませんか？</h2>
                <p class="iv-cta-box__desc">
                    受験生ご本人だけでなく、保護者の方からのご相談も歓迎しています。
                    今の状況を整理し、何から始めるべきかを一緒に明確にします。
                </p>
                <div class="iv-cta-box__btns">
                    <a href="<?php echo esc_url( $consultation ); ?>"
                       class="cta-btn cta-btn--primary"
                       target="_blank" rel="noopener noreferrer">
                        無料受験相談へ進む →
                    </a>
                    <a href="<?php echo esc_url( home_url('/diagnosis/') ); ?>"
                       class="cta-btn cta-btn--sub">
                        総合型選抜適性診断を受ける
                    </a>
                </div>
                <p class="iv-cta-box__note">完全無料・登録不要</p>
            </div>
        </div>
    </div>

    <!-- ============================================================
         関連記事
         ============================================================ -->
    <?php if ( $related_query && $related_query->have_posts() ) : ?>
    <div class="single-related">
        <div class="container">
            <div class="cat-section-header">
                <h2 class="cat-section-title">関連記事</h2>
            </div>
            <div class="post-list">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                <article class="post-card post-card--list">
                    <a href="<?php the_permalink(); ?>" class="post-card__link">
                        <div class="post-card__thumb">
                            <?php if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'keikyo-card', [ 'class' => 'post-card__img object-cover' ] );
                            else : ?>
                                <div class="post-card__img-placeholder"></div>
                            <?php endif; ?>
                        </div>
                        <div class="post-card__body">
                            <div class="post-card__meta">
                                <time class="post-card__date"
                                      datetime="<?php echo esc_attr( get_the_date('Y-m-d') ); ?>">
                                    <?php echo esc_html( get_the_date('Y.m.d') ); ?>
                                </time>
                                <?php $rc = get_the_category(); if ( $rc ) : ?>
                                <span class="post-card__cat"><?php echo esc_html( $rc[0]->name ); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="post-card__title line-clamp-2"><?php the_title(); ?></h3>
                            <p class="post-card__excerpt line-clamp-2">
                                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 60, '…' ) ); ?>
                            </p>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</article>
</main>

<?php
endwhile;
get_footer();
?>
