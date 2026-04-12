<?php
/**
 * archive-interview.php — 合格者対談一覧
 * @package keikyo-theme
 */
get_header();

$paged   = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$tag_slug = isset( $_GET['iv_tag'] ) ? sanitize_text_field( wp_unslash( $_GET['iv_tag'] ) ) : '';

$args = [
  'post_type'      => 'interview',
  'posts_per_page' => 9,
  'paged'          => $paged,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
];

if ( $tag_slug ) {
  $args['tax_query'] = [[
    'taxonomy' => 'interview_tag',
    'field'    => 'slug',
    'terms'    => $tag_slug,
  ]];
}

$query = new WP_Query( $args );
$tags  = get_terms([ 'taxonomy' => 'interview_tag', 'hide_empty' => true, 'number' => 20 ]);
?>

<!-- HERO -->
<section class="interview-hero">
  <div class="shell interview-hero__inner">
    <p class="kicker kicker--light">Success Stories</p>
    <h1 class="interview-hero__h1">合格者対談</h1>
    <p class="interview-hero__sub">数字では伝わらない、合格までの思考と行動。先輩たちのリアルな記録。</p>
    <div class="interview-hero__badges">
      <span class="interview-hero__badge">全国対応</span>
      <span class="interview-hero__badge">難関大合格</span>
      <span class="interview-hero__badge">逆転合格あり</span>
    </div>
  </div>
</section>

<!-- FILTER BAR -->
<div class="filter-bar">
  <div class="shell filter-bar__tabs">
    <a href="<?php echo esc_url( get_post_type_archive_link( 'interview' ) ); ?>"
       class="filter-tab <?php echo ! $tag_slug ? 'filter-tab--active' : ''; ?>">すべて</a>
    <?php if ( ! is_wp_error( $tags ) && $tags ) :
      foreach ( $tags as $tag ) : ?>
        <a href="<?php echo esc_url( add_query_arg( 'tag', $tag->slug, get_post_type_archive_link( 'interview' ) ) ); ?>"
           class="filter-tab <?php echo $tag_slug === $tag->slug ? 'filter-tab--active' : ''; ?>">
          <?php echo esc_html( $tag->name ); ?>
        </a>
      <?php endforeach;
    endif; ?>
  </div>
</div>

<!-- CARD GRID -->
<section class="card-grid-section">
  <div class="shell">
    <?php if ( $query->have_posts() ) : ?>
      <div class="card-grid">
        <?php
        $n = ( $paged - 1 ) * 9 + 1;
        while ( $query->have_posts() ) : $query->the_post();
          $hd      = function_exists('keikyo_iv_get_group') ? keikyo_iv_get_group(get_the_ID(), 'hero_section') : [];
          $school  = !empty($hd['hero_info_result']) ? $hd['hero_info_result'] : '';
          $desc    = !empty($hd['hero_description']) ? $hd['hero_description'] : get_the_excerpt();
          $itags   = get_the_terms( get_the_ID(), 'interview_tag' );
          $thumb   = '';
          if (!empty($hd['hero_image'])) { $thumb = function_exists('keikyo_iv_image_url') ? keikyo_iv_image_url($hd['hero_image'], 'large') : ''; }
          if (!$thumb) $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        ?>
        <article class="story-card">
          <a href="<?php the_permalink(); ?>" class="story-card__link">
            <div class="story-card__image">
              <?php if ( $thumb ) : ?>
                <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
              <?php else : ?>
                <div class="story-card__image-placeholder">STORY PHOTO</div>
              <?php endif; ?>
              <span class="story-card__badge">Story <?php printf( '%02d', $n ); ?></span>
              <?php if ( $school ) : ?>
                <span class="story-card__origin"><?php echo esc_html( $school ); ?></span>
              <?php endif; ?>
              <div class="story-card__profile">
                <p class="story-card__name"><?php the_title(); ?></p>
                <?php if ( $desc ) : ?>
                  <p class="story-card__school"><?php echo esc_html( mb_substr($desc, 0, 60) ); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </a>
          <div class="story-card__body">
            <?php if ( ! is_wp_error( $itags ) && $itags ) : ?>
              <div class="story-card__tags">
                <?php foreach ( $itags as $itag ) : ?>
                  <a href="<?php echo esc_url( home_url( '/tag/' . $itag->slug . '/' ) ); ?>" class="story-card__tag"><?php echo esc_html( $itag->name ); ?></a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <?php if ( $comment ) : ?>
              <p class="story-card__comment"><?php echo esc_html( $comment ); ?></p>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="story-card__link">対談を読む →</a>
          </div>
        </article>
        <?php $n++; endwhile; wp_reset_postdata(); ?>
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
      <p class="no-posts">合格者対談はまだ公開されていません。</p>
    <?php endif; ?>
  </div>
</section>

<!-- CTA -->
<section class="interview-cta">
  <div class="shell">
    <p class="interview-cta__text">あなたも、先輩たちの戦略を参考に一歩踏み出してみませんか。</p>
    <a href="<?php echo esc_url( "https://bit.ly/4us051J" ); ?>" class="btn btn--red">無料受験相談を予約する →</a>
  </div>
</section>

<?php get_footer(); ?>
