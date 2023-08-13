<?php
/**
 * Template for displaying content of archive courses page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */
if ( empty( $is_block_theme ) ) {
	do_action( 'learn-press/template-header' );
}

/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );

$page_title = learn_press_page_title( false );
?>
<section class="section p-0">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content">
				<div class="snt-auto">
					<div class="col-inner">
						<div class="bg-fff">
							<div class="snt-courses">
								<?php if ( $page_title ) : ?>
									<header class="learn-press-courses-header">
										<h1><?php echo $page_title; ?></h1>
										<?php do_action( 'lp/template/archive-course/description' ); ?>
									</header>
								<?php endif; ?>

								<?php if ( is_search() ) : ?>
									<header class="learn-press-courses-header">
										<h1><?php printf( esc_html__( 'Từ khóa tìm kiếm: %s', 'shtheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
									</header>
								<?php endif; ?>

								<?php
								/**
								 * LP Hook
								 */
								do_action( 'learn-press/before-courses-loop' );
								LP()->template( 'course' )->begin_courses_loop();

								if ( LP_Settings_Courses::is_ajax_load_courses() && ! LP_Settings_Courses::is_no_load_ajax_first_courses() ) {
									echo '<div class="lp-archive-course-skeleton" style="width:100%">';
									echo lp_skeleton_animation_html( 10, 'random', 'height:20px', 'width:100%' );
									echo '</div>';
								} else {
									if ( have_posts() ) {
										while ( have_posts() ) :
											the_post();

											learn_press_get_template_part( 'content', 'course' );

										endwhile;
									} else {
										LP()->template( 'course' )->no_courses_found();
									}

									if ( LP_Settings_Courses::is_ajax_load_courses() ) {
										echo '<div class="lp-archive-course-skeleton no-first-load-ajax" style="width:100%; display: none">';
										echo lp_skeleton_animation_html( 10, 'random', 'height:20px', 'width:100%' );
										echo '</div>';
									}
								}

								LP()->template( 'course' )->end_courses_loop();
								do_action( 'learn-press/after-courses-loop' );


								/**
								 * LP Hook
								 */
								do_action( 'learn-press/after-main-content' );

								/**
								 * LP Hook
								 *
								 * @since 4.0.0
								 */
								do_action( 'learn-press/sidebar' );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php
/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
if ( empty( $is_block_theme ) ) {
	do_action( 'learn-press/template-footer' );
}
