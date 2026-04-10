<?php
/**
 * single-interview.php
 * 合格者対談 詳細ページ
 * 現行テーマのtemplate-parts/interview/をそのまま使用
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header( 'lp' );

while ( have_posts() ) :
    the_post();

    $context   = function_exists( 'keikyo_interview_build_context' )
        ? keikyo_interview_build_context( get_the_ID() )
        : [];
    $nav_items = function_exists( 'keikyo_interview_get_nav_items' )
        ? keikyo_interview_get_nav_items( $context )
        : [];
?>
<main id="primary" class="keikyo-interview" data-post-id="<?php echo esc_attr( get_the_ID() ); ?>">
    <?php get_template_part( 'template-parts/interview/header',       null, [ 'context' => $context, 'nav_items' => $nav_items ] ); ?>
    <?php get_template_part( 'template-parts/interview/breadcrumbs',  null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/hero',         null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/lead',         null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/key-points',   null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/profile',      null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/timeline',     null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/story-sections', null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/closing-video', null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/final-cta',    null, [ 'context' => $context ] ); ?>
    <?php get_template_part( 'template-parts/interview/footer',       null, [ 'context' => $context ] ); ?>
</main>
<?php
endwhile;

get_footer( 'lp' );
