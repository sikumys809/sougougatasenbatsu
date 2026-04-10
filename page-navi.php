<?php
/**
 * Template Name: 総合型選抜合格ナビ
 * @package keikyo-theme
 */
get_header();

$paged    = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$tag_slug = isset( $_GET['tag'] ) ? sanitize_key( $_GET['tag'] ) : '';

$args = [
  'post_type'      => 'post',
  'posts_per_page' => 9,
  'paged'          => $paged,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
];

if ( $tag_slug ) {
  $args['tag'] = $tag_slug;
}

$query = new WP_Query( $args );
$tags  = get_tags([ 'hide_empty' => true, 'number' => 20 ]);
?>

<!-- HERO -->
<section class="navi-hero">
  <div class="shell navi-hero__inner">
    <p class="kicker kicker--light">Navigation</p>
    <h1 class="navi-hero__h1">総合型選抜合格ナビ</h1>
    <p class="navi-hero__sub">合格への道筋を、記事で学ぶ。受験生が今すぐ使える情報を届けます。</p>
  </div>
</section>

<!-- TAG FILTER -->
<div class="tag-filter">
  <div class="shell tag-filter__tabs">
    <a href="<?php echo esc_url( get_permalink() ); ?>"
       class="tag-tab <?php echo ! $tag_slug ? 'tag-tab--active' : ''; ?>">すべて</a>
    <?php if ( $tags ) :
      foreach ( $tags as $tag ) : ?>
        <a href="<?php echo esc_url( add_query_arg( 'tag', $tag->slug ) ); ?>"
           class="tag-tab <?php echo $tag_slug === $tag->slug ? 'tag-tab--active' : ''; ?>">
          <?php echo esc_html( $tag->name ); ?>
        </a>
      <?php endforeach;
    endif; ?>
  </div>
</div>

<!-- ARTICLE GRID -->
<section class="article-grid-section">
  <div class="shell">
    <?php if ( $query->have_posts() ) : ?>
      <div class="article-grid">
        <?php while ( $query->have_posts() ) : $query->the_post();
          $cats  = get_the_category();
          $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
        ?>
        <article class="article-card">
          <a href="<?php the_permalink(); ?>">
            <div class="article-card__image">
              <?php if ( $thumb ) : ?>
                <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
              <?php else : ?>
                THUMBNAIL
              <?php endif; ?>
            </div>
          </a>
          <div class="article-card__body">
            <div class="article-card__meta">
              <?php if ( $cats ) : ?>
                <span class="article-card__category"><?php echo esc_html( $cats[0]->name ); ?></span>
              <?php endif; ?>
              <span class="article-card__date"><?php echo get_the_date( 'Y.m.d' ); ?></span>
            </div>
            <h2 class="article-card__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="article-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 50 ); ?></p>
            <a href="<?php the_permalink(); ?>" class="article-card__link">続きを読む →</a>
          </div>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <!-- BANNER -->
      <div class="banner-section">
        <div class="banner-placeholder">BANNER IMAGE (W:1200×H:120)</div>
      </div>

      <!-- PAGINATION -->
      <div class="pagination-wrap">
        <?php
        echo paginate_links([
          'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
          'format'    => '?paged=%#%',
          'current'   => $paged,
          'total'     => $query->max_num_pages,
          'prev_text' => '← 前へ',
          'next_text' => '次へ →',
          'type'      => 'list',
        ]);
        ?>
      </div>

    <?php else : ?>
      <p class="no-posts">記事はまだ公開されていません。</p>
    <?php endif; ?>
  </div>
</section>

<!-- CTA -->
<section class="navi-cta">
  <div class="shell">
    <p class="navi-cta__text">記事を読んだ次は、あなただけの戦略を一緒に作りましょう。</p>
    <div class="navi-cta__buttons">
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--red">無料受験相談を予約する →</a>
      <a href="<?php echo esc_url( home_url( '/diagnosis/' ) ); ?>" class="btn btn--outline-light">適性診断をはじめる →</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
