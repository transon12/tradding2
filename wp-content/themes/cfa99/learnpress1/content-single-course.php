<?php
/**
 * Template for displaying content of course without header and footer
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * If course has set password
 */
if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
$course = learn_press_get_course();
$user   = learn_press_get_current_user();
$can_view_content_course = $user->can_view_content_course( $course->get_id() );
$instructor = $course->get_instructor();
$tabs = learn_press_get_course_tabs();
$active_tab = learn_press_cookie_get( 'course-tab' );
global $post;
if ( ! $active_tab ) {
	$tab_keys   = array_keys( $tabs );
	$active_tab = reset( $tab_keys );
}
/**
 * LP Hook
 */
do_action( 'learn-press/before-single-course' );
postview_set( get_the_ID() );
?>

<section class="section p-0 snt-single">
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content">
                <div class="snt-auto" id="learn-press-course">
                    <div class="col-inner snt-single-post">
							<div class="section-content relative">
								<div class="row nobottom">
									<div class="col medium-8 small-12 large-8 snt-article">
										<div class="col-inner">
                                            <div class="course-summary">
                                                <div class="back">
                                                    <a href="" onclick="window.history.go(-1); return false;" class="back">
                                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        Tất cả khóa học
                                                    </a>
                                                </div>
                                                <header class="courses-header">
                                                    <h1 class="mb-0"><?php echo the_title(); ?></h1>
                                                </header>
                                                <div class="courses-meta">
                                                    <span class="courses-view">
                                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.70956 0C9.27373 0 11.5991 1.40288 13.3149 3.68154C13.4549 3.86822 13.4549 4.12903 13.3149 4.31572C11.5991 6.59712 9.27373 8 6.70956 8C4.14538 8 1.82006 6.59712 0.104204 4.31846C-0.0358095 4.13178 -0.0358095 3.87097 0.104204 3.68428C1.82006 1.40288 4.14538 0 6.70956 0ZM6.52562 6.81675C8.22775 6.92382 9.63337 5.52093 9.5263 3.81606C9.43845 2.41043 8.29913 1.2711 6.8935 1.18325C5.19137 1.07618 3.78574 2.47907 3.89281 4.18394C3.98341 5.58682 5.12274 6.72615 6.52562 6.81675ZM6.61072 5.51544C7.52768 5.5731 8.2854 4.81812 8.225 3.90117C8.17833 3.14345 7.56337 2.53123 6.80565 2.48181C5.88869 2.42416 5.13097 3.17914 5.19137 4.09609C5.24079 4.85655 5.85575 5.46877 6.61072 5.51544Z" fill="#475467"></path>
                                                        </svg>
                                                        <?php echo postview_get( get_the_ID() );?>
                                                    </span>
                                                </div>
                                                    <?php 
                                                        if(get_the_post_thumbnail()){
                                                            $video = get_field('link_video');
                                                            echo '<div class="courses-thumbnail">';
                                                                echo get_the_post_thumbnail();
                                                                if($video){
                                                                    echo '<div class="icon_video"><a href="'.$video.'" data-fancybox></a></div>';
                                                                }
                                                            echo '</div>';
                                                        }

                                                    ?>
                                                <div id="learn-press-course-tabs" class="course-tabs">
                                                    <ul class="learn-press-nav-tabs course-nav-tabs" data-tabs="<?php echo count( $tabs ); ?>">
                                                        <?php foreach ( $tabs as $key => $tab ) : ?>
                                                            <?php
                                                            $classes = array( 'course-nav course-nav-tab-' . esc_attr( $key ) );

                                                            if ( $active_tab === $key ) {
                                                                $classes[] = 'active';
                                                            }
                                                            ?>

                                                            <li class="<?php echo implode( ' ', $classes ); ?>">
                                                                <a href="#tab-<?php echo $key; ?>"><?php echo $tab['title']; ?></a>
                                                            </li>
                                                        <?php endforeach; ?>

                                                    </ul>
                                                    <div class="course-tab-panels">
                                                        <div class="course-entry-content">
                                                            <div id="tab-curriculum">
                                                                <?php 
                                                                    if(get_field('thong_tin_muc_luc')){
                                                                        echo get_field('thong_tin_muc_luc');
                                                                    }
                                                                    learn_press_get_template('single-course/tabs/curriculum');
                                                                ?>

                                                            </div>
                                                            <div id="tab-overview">
                                                                <h3 class="title-tabs">Thông tin chung</h3>
                                                                <?php echo $course->get_content(); ?>
                                                            </div>
                                                            <div id="tab-instructor">
                                                                <?php wp_educationlearn_press_custom_tab_content(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                /**
                                                 * @since 3.0.0
                                                 *
                                                 * @called single-course/content.php
                                                 * @called single-course/sidebar.php
                                                 */
                                                //do_action( 'learn-press/single-course-summary' );
                                                ?>
                                            </div> 
										</div>
									</div>
									<div class="col medium-4 small-12 large-4 snt-rightbar">
										<div class="col-inner">
											<?php flatsome_sticky_column_open( 'blog_sticky_sidebar' ); ?>
											    <?php dynamic_sidebar( 'archive-courses-sidebar' ); ?>
											<?php flatsome_sticky_column_close( 'blog_sticky_sidebar' ); ?>
										</div>
									</div>
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
 * LP Hook
 */
do_action( 'learn-press/after-single-course' );
