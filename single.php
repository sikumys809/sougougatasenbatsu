<?php
/**
 * single.php
 * 通常投稿 詳細ページ（サイドバーレイアウト版）
 * PC: メイン8 + サイドバー2 / モバイル: メインのみ
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
    $consultation = 'https://bit.ly/4us051J';

    // 読了時間（日本語：400文字/分）
    $text       = wp_strip_all_tags( $content );
    $char_count = mb_strlen( $text );
    $read_min   = max( 1, (int) ceil( $char_count / 400 ) );

    // 目次用 h2・h3 抽出
    $toc_items = [];
    preg_match_all( '/<h([23])[^>]*id=["\']([^"\']*)["\'][^>]*>(.*?)<\/h[23]>/is', $content, $matches, PREG_SET_ORDER );
    if ( empty( $matches ) ) {
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

    // 新着記事（サイドバー用・5件）
    $latest_query = new WP_Query( [
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'post__not_in'   => [ $post_id ],
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    ] );
?>

<main class="site-main" id="main">
<article class="single-post" <?php post_class(); ?>>

    <!-- ===== ヒーロー（全幅） ===== -->
    <div class="single-hero">
        <div class="single-hero__inner">

            <!-- パンくず -->
            <nav class="single-breadcrumb" aria-label="パンくずリスト">
                <ol class="single-breadcrumb__list">
                    <li class="single-breadcrumb__item">
                        <a href="<?php echo esc_url( home_url('/') ); ?>">トップ</a>
                    </li>
                    <?php if ( $categories ) : ?>
                    <li class="single-breadcrumb__item">
                        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                            <?php echo esc_html( $categories[0]->name ); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="single-breadcrumb__item is-current" aria-current="page">
                        <?php the_title(); ?>
                    </li>
                </ol>
            </nav>

            <!-- カテゴリーバッジ -->
            <?php if ( $categories ) : ?>
            <div class="single-hero__cats">
                <?php foreach ( $categories as $cat ) : ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                   class="single-hero__cat">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- タイトル -->
            <h1 class="single-hero__title"><?php the_title(); ?></h1>

            <!-- メタ -->
            <div class="single-hero__meta">
                <time class="single-hero__date"
                      datetime="<?php echo esc_attr( get_the_date('Y-m-d') ); ?>">
                    <?php echo esc_html( get_the_date('Y.m.d') ); ?>
                </time>
                <?php
                $modified  = get_the_modified_date('Y-m-d');
                $published = get_the_date('Y-m-d');
                if ( $modified !== $published ) : ?>
                <span class="single-hero__modified">
                    更新: <?php echo esc_html( get_the_modified_date('Y.m.d') ); ?>
                </span>
                <?php endif; ?>
                <span class="single-hero__read-time">約<?php echo esc_html( $read_min ); ?>分</span>
            </div>

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
                    <?php the_post_thumbnail( 'large', [
                        'class' => 'single-thumb__img',
                        'alt'   => get_the_title(),
                    ] ); ?>
                </div>
                <?php endif; ?>

                <!-- インラインCTA -->
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
                        <?php foreach ( $toc_items as $item ) : ?>
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

                <!-- 記事下CTA -->
                <div class="single-cta-main">
                    <p class="single-cta-main__eyebrow">あなたの強みも、言葉と戦略へ。</p>
                    <h2 class="single-cta-main__title">総合型選抜について、<br>まず話してみませんか？</h2>
                    <p class="single-cta-main__desc">
                        受験生ご本人だけでなく、保護者の方からのご相談も歓迎しています。
                        今の状況を整理し、何から始めるべきかを一緒に明確にします。
                    </p>
                    <div class="single-cta-main__btns">
                        <a href="<?php echo esc_url( $consultation ); ?>"
                           class="single-cta-main__btn single-cta-main__btn--primary"
                           target="_blank" rel="noopener noreferrer">
                            無料受験相談へ進む →
                        </a>
                        <a href="<?php echo esc_url( home_url('/diagnosis/') ); ?>"
                           class="single-cta-main__btn single-cta-main__btn--sub">
                            総合型選抜適性診断を受ける
                        </a>
                    </div>
                    <p class="single-cta-main__note">完全無料・登録不要</p>
                </div>

                <!-- 関連記事 -->
                <?php if ( $related_query && $related_query->have_posts() ) : ?>
                <div class="single-related">
                    <h2 class="single-related__title">関連記事</h2>
                    <div class="single-related__list">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="s-card">
                            <div class="s-card__thumb">
                                <?php if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'large', [ 'class' => 's-card__img' ] );
                                else : ?>
                                    <div class="s-card__img-placeholder"></div>
                                <?php endif; ?>
                            </div>
                            <div class="s-card__body">
                                <p class="s-card__date"><?php echo esc_html( get_the_date('Y.m.d') ); ?></p>
                                <h3 class="s-card__title"><?php the_title(); ?></h3>
                            </div>
                        </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

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

                <!-- 関連記事（サイドバー） -->
                <?php if ( $related_query && $related_query->have_posts() ) :
                    $related_query->rewind_posts(); ?>
                <div class="sidebar-widget">
                    <div class="sidebar-widget__head">関連記事</div>
                    <div class="sidebar-widget__body">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
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
