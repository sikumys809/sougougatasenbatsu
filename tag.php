<?php
/**
 * tag.php — タグアーカイブテンプレート
 * 通常投稿 + interview CPT の両方を表示
 * CSS: assets/css/pages/tag.css
 */

get_header();

$tag_obj   = get_queried_object();
$tag_name  = $tag_obj ? $tag_obj->name : '';
$tag_slug  = $tag_obj ? $tag_obj->slug : '';
$tag_id    = $tag_obj ? $tag_obj->term_id : 0;

// ── interview CPT クエリ ──────────────────────────────
// post_tag OR interview_tag（同じslug）どちらでも拾う
$interview_query = new WP_Query( [
    'post_type'      => 'interview',
    'posts_per_page' => -1,
    'no_found_rows'  => false,
    'tax_query'      => [
        'relation' => 'OR',
        [
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_id,
        ],
        [
            'taxonomy' => 'interview_tag',
            'field'    => 'slug',
            'terms'    => $tag_slug,
        ],
    ],
] );
$interview_count = $interview_query->found_posts;

// ── 通常投稿クエリ（ページネーション付き） ────────────
$paged      = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$posts_per  = 6;
$post_query = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => $posts_per,
    'paged'          => $paged,
    'tax_query'      => [
        [
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_id,
        ],
    ],
] );
$post_count  = $post_query->found_posts;
$total_count = $interview_count + $post_count;
$has_interviews = $interview_count > 0;
$has_posts      = $post_count > 0;
?>

<div class="tag-page">

  <!-- ===== HERO ===== -->
  <section class="tag-hero">
    <div class="tag-shell">

      <nav class="tag-hero__breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
        <span>/</span>
        <span>#<?php echo esc_html( $tag_name ); ?></span>
      </nav>

      <div class="tag-hero__header">
        <h1 class="tag-hero__title">
          <span class="tag-hero__title-hash">#</span><?php echo esc_html( $tag_name ); ?><span class="tag-hero__sub">の記事一覧</span>
        </h1>
        <span class="tag-hero__count">全<?php echo esc_html( $total_count ); ?>件</span>
      </div>

    </div>
  </section>


  <?php if ( $has_interviews ) : ?>
  <!-- ===== 合格者の声セクション ===== -->
  <section class="tag-section">
    <div class="tag-shell">

      <div class="tag-section__header">
        <h2 class="tag-section__title">合格者の声</h2>
        <span class="tag-section__count"><?php echo esc_html( $interview_count ); ?>件</span>
      </div>

      <div class="interview-grid">
        <?php while ( $interview_query->have_posts() ) : $interview_query->the_post(); ?>
          <?php
          $iv_hd   = function_exists('keikyo_iv_get_group') ? keikyo_iv_get_group(get_the_ID(), 'hero_section') : [];
          $iv_img  = '';
          if (!empty($iv_hd['hero_image'])) {
              $iv_img = function_exists('keikyo_iv_image_url') ? keikyo_iv_image_url($iv_hd['hero_image'], 'large') : '';
          }
          if (!$iv_img) $iv_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
          $iv_desc = !empty($iv_hd['hero_description']) ? $iv_hd['hero_description'] : get_the_excerpt();
          $iv_cats = get_the_category();
          $iv_cat  = '';
          if ($iv_cats) {
              usort($iv_cats, fn($a, $b) => $b->term_id - $a->term_id);
              $iv_cat = $iv_cats[0]->name;
          }
          ?>
          <a href="<?php the_permalink(); ?>" class="interview-card">
            <div class="interview-card__photo">
              <?php if ( $iv_img ) : ?>
                <img src="<?php echo esc_url($iv_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="interview-card__img" loading="lazy">
              <?php else : ?>
                <div class="interview-card__photo-placeholder">PHOTO</div>
              <?php endif; ?>
              <span class="interview-card__badge">合格者対談</span>
              <div class="interview-card__overlay">
                <p class="interview-card__name"><?php the_title(); ?></p>
                <?php
                $iv_itags2 = get_the_terms( get_the_ID(), 'interview_tag' );
                if ( $iv_itags2 && ! is_wp_error( $iv_itags2 ) ) : ?>
                <div class="interview-card__tags">
                  <?php foreach ( $iv_itags2 as $iv_itag2 ) : ?>
                  <a href="<?php echo esc_url( home_url( '/tag/' . $iv_itag2->slug . '/' ) ); ?>" class="interview-card__tag interview-card__tag--light"><?php echo esc_html( $iv_itag2->name ); ?></a>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php if ($iv_desc) : ?>
                <p class="interview-card__excerpt"><?php echo esc_html(mb_substr($iv_desc, 0, 60)); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

    </div>
  </section>
  <?php endif; ?>


  <?php if ( $has_posts ) : ?>
  <!-- ===== 対策・情報記事セクション ===== -->
  <section class="tag-section">
    <div class="tag-shell">

      <div class="tag-section__header">
        <h2 class="tag-section__title">対策・情報記事</h2>
        <span class="tag-section__count"><?php echo esc_html( $post_count ); ?>件</span>
      </div>

      <div class="article-list">
        <?php while ( $post_query->have_posts() ) : $post_query->the_post();
          $cats      = get_the_category();
          $cat_label = $cats ? esc_html( $cats[0]->name ) : '';
        ?>
          <article class="article-item">
            <a href="<?php the_permalink(); ?>" class="article-item__thumb" tabindex="-1" aria-hidden="true">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium_large', [ 'alt' => '', 'class' => 'article-item__img' ] ); ?>
              <?php else : ?>
                <div class="article-item__thumb-placeholder">THUMBNAIL</div>
              <?php endif; ?>
              <?php if ( $cat_label ) : ?>
                <span class="article-item__category"><?php echo $cat_label; ?></span>
              <?php endif; ?>
            </a>
            <div class="article-item__body">
              <p class="article-item__date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></p>
              <h3 class="article-item__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
              <p class="article-item__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 60, '…' ); ?></p>
              <a href="<?php the_permalink(); ?>" class="article-item__link">続きを読む →</a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <?php if ( $post_query->max_num_pages > 1 ) : ?>
      <nav class="tag-pagination" aria-label="ページネーション">
        <?php
        $big = 999999999;
        echo paginate_links( [
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, $paged ),
            'total'     => $post_query->max_num_pages,
            'prev_text' => '← 前へ',
            'next_text' => '次へ →',
            'type'      => 'list',
        ] );
        ?>
      </nav>
      <?php endif; ?>

    </div>
  </section>
  <?php endif; ?>


  <?php if ( ! $has_interviews && ! $has_posts ) : ?>
  <section class="tag-section tag-section--empty">
    <div class="tag-shell">
      <p class="tag-empty">このタグに該当する記事はまだありません。</p>
    </div>
  </section>
  <?php endif; ?>

</div>

<?php get_footer(); ?>
