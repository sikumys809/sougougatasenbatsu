<?php
/**
 * Template Name: 執筆者紹介
 *
 * 慶教ゼミナール 執筆者紹介ページ（/authors/）
 * - WordPressユーザーのうち、公開投稿を1件以上持つ全員を表示
 * - keikyo_author_order（小さい順）→ 同順は投稿数の多い順でソート
 * - 表示内容：アバター / display_name / 役職 / 経歴タグ / description / 投稿数 / 著者アーカイブへのリンク
 */

get_header();

// ------------------------------------------------------------
// ユーザー取得
// ------------------------------------------------------------
$all_users = get_users( array(
    'has_published_posts' => array( 'post' ),
) );

// keikyo_author_order（小さい順）→ 投稿数（多い順）
usort( $all_users, function ( $a, $b ) {
    $order_a_raw = get_user_meta( $a->ID, 'keikyo_author_order', true );
    $order_b_raw = get_user_meta( $b->ID, 'keikyo_author_order', true );
    $order_a = ( $order_a_raw === '' || $order_a_raw === null ) ? 999 : (int) $order_a_raw;
    $order_b = ( $order_b_raw === '' || $order_b_raw === null ) ? 999 : (int) $order_b_raw;

    if ( $order_a !== $order_b ) {
        return $order_a - $order_b;
    }

    $count_a = (int) count_user_posts( $a->ID, 'post', true );
    $count_b = (int) count_user_posts( $b->ID, 'post', true );
    return $count_b - $count_a;
} );
?>

<main id="main" class="authors-page">

    <!-- ============================================================
         Hero
         ============================================================ -->
    <section class="authors-hero">
        <div class="authors-hero__decoration" aria-hidden="true">
            <span class="authors-hero__decoration-shape"></span>
        </div>

        <div class="authors-hero__breadcrumb-wrap">
            <nav class="authors-breadcrumb" aria-label="パンくずリスト">
                <ol class="authors-breadcrumb__list">
                    <li class="authors-breadcrumb__item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="authors-breadcrumb__link">トップ</a>
                    </li>
                    <li class="authors-breadcrumb__item authors-breadcrumb__item--sep" aria-hidden="true">
                        <svg class="authors-breadcrumb__sep" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </li>
                    <li class="authors-breadcrumb__item">
                        <span class="authors-breadcrumb__current">執筆者紹介</span>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="authors-hero__content">
            <h1 class="authors-hero__title-en" aria-hidden="true">AUTHORS</h1>

            <div class="authors-hero__title-ja-wrap">
                <span class="authors-hero__accent-bar" aria-hidden="true"></span>
                <h2 class="authors-hero__title-ja">執筆者紹介</h2>
            </div>

            <p class="authors-hero__catchphrase">
                総合型選抜のプロ、<br>
                各分野の第一人者が綴る。
            </p>
        </div>
    </section>

    <!-- ============================================================
         Authors Grid
         ============================================================ -->
    <section class="authors-grid-section">
        <div class="authors-grid-section__container">

            <?php if ( ! empty( $all_users ) ) : ?>
                <div class="authors-grid">
                    <?php foreach ( $all_users as $user ) :
                        $user_id     = $user->ID;
                        $post_count  = (int) count_user_posts( $user_id, 'post', true );

                        if ( $post_count < 1 ) {
                            continue;
                        }

                        $display_name = $user->display_name;
                        $role         = get_user_meta( $user_id, 'keikyo_author_role', true );
                        $tags_raw     = get_user_meta( $user_id, 'keikyo_author_tags', true );
                        $tags         = $tags_raw
                            ? array_filter( array_map( 'trim', explode( ',', $tags_raw ) ) )
                            : array();
                        $description  = get_the_author_meta( 'description', $user_id );
                        $avatar_url   = get_avatar_url( $user_id, array( 'size' => 256 ) );
                        $author_url   = get_author_posts_url( $user_id );
                    ?>
                        <a href="<?php echo esc_url( $author_url ); ?>" class="author-profile-card">

                            <div class="author-profile-card__avatar-wrap">
                                <div class="author-profile-card__avatar">
                                    <?php if ( $avatar_url ) : ?>
                                        <img src="<?php echo esc_url( $avatar_url ); ?>"
                                             alt="<?php echo esc_attr( $display_name ); ?>のプロフィール画像"
                                             class="author-profile-card__avatar-img"
                                             loading="lazy">
                                    <?php else : ?>
                                        <span class="author-profile-card__avatar-initial">
                                            <?php echo esc_html( mb_substr( $display_name, 0, 1 ) ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h3 class="author-profile-card__name"><?php echo esc_html( $display_name ); ?></h3>

                            <?php if ( $role ) : ?>
                                <p class="author-profile-card__role"><?php echo esc_html( $role ); ?></p>
                            <?php endif; ?>

                            <?php if ( ! empty( $tags ) ) : ?>
                                <div class="author-profile-card__tags">
                                    <?php foreach ( array_slice( $tags, 0, 3 ) as $tag ) : ?>
                                        <span class="author-profile-card__tag"><?php echo esc_html( $tag ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <span class="author-profile-card__divider" aria-hidden="true"></span>

                            <?php if ( $description ) : ?>
                                <p class="author-profile-card__description"><?php echo esc_html( $description ); ?></p>
                                <span class="author-profile-card__divider" aria-hidden="true"></span>
                            <?php endif; ?>

                            <div class="author-profile-card__count-wrap">
                                <span class="author-profile-card__count-number"><?php echo esc_html( $post_count ); ?></span>
                                <span class="author-profile-card__count-label">投稿記事</span>
                            </div>

                            <span class="author-profile-card__divider" aria-hidden="true"></span>

                            <span class="author-profile-card__cta">
                                <svg class="author-profile-card__cta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                                <span>この著者の記事を見る</span>
                            </span>

                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="authors-grid__empty">現在表示できる執筆者がいません。</p>
            <?php endif; ?>

        </div>
    </section>

    <!-- ============================================================
         CTA
         ============================================================ -->
    <section class="authors-cta">
        <div class="authors-cta__container">
            <h2 class="authors-cta__title">
                本気の指導を、<br class="authors-cta__br-mobile">全国どこからでも。
            </h2>
            <p class="authors-cta__subtitle">
                慶教ゼミナールの講師陣から<br class="authors-cta__br-mobile">直接指導を受けませんか？
            </p>
            <div class="authors-cta__buttons">
                <a href="https://bit.ly/4us051J" class="authors-cta__btn authors-cta__btn--primary">
                    無料受験相談
                </a>
                <a href="https://line.me/R/ti/p/@712gzjgo" class="authors-cta__btn authors-cta__btn--line" target="_blank" rel="noopener noreferrer">
                    <svg class="authors-cta__line-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                    </svg>
                    LINE公式
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
