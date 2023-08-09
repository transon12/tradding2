<?php
/**
 * Template for displaying content of single course with curriculum and
 * item's content inside it
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit();
$user   = learn_press_get_current_user();
$course = learn_press_get_course();
if ( ! $course ) {
	return;
}

$course_item             = LP_Global::course_item();
$can_view_content_course = $user->can_view_content_course( $course->get_id() );
$can_view_content_item   = $user->can_view_item( $course_item->get_id(), $can_view_content_course );
var_dump($can_view_content_item);
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
//do_action( 'learn-press/before-main-content' );

/**
 * LP Hook
 */
//do_action( 'learn-press/before-single-item' );
?>

	
		<?php
		/**
		 * @since 4.0.6
		 * @see single-button-toggle-sidebar - 5
		 */
		

		/**
		 * Get content item's course
		 *
		 * @since 3.0.0
		 *
		 * @see LP_Template_Course::popup_content() - 30
		 */
		?>
	


<section class="section p-0 snt-single single__course_learn">
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
                    <div class="col-inner snt-single-post">

						<section class="section px">
							<div class="section-content relative">
								<div class="row nobottom">
									<div class="col medium-8 small-12 large-8 snt-article">
										<div class="col-inner">
                                            <div class="back">
                                                <a href="<?php echo home_url('khoa-hoc'); ?>">
                                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    Tất cả các khóa học
                                                </a>
                                            </div>
                                            <header class="entry-header">
                                                <h1 class="entry-title">
                                                    <?php echo get_the_title();?>
                                                </h1>
                                            </header>

                                            <div class="entry-content">
                                                <div class="course-entry-content"> <!-- Entry content of course -->

                                                    <div class="course-content-media"> <!-- Video or media of course -->
                                                        <div class="course-content-video">
                                                            <iframe width="100%" height="350" src="https://www.youtube.com/embed/NH8CQAi7hf8?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </div>
                                                    </div>

                                                    <div class="course-ul-tabs">
                                                        <ul>
                                                            <li><a>Nội dung bài học 2</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="course-entry-readmore">
                                                        Khi giao dịch trên thị trường chứng khoán, nhà đầu tư cần phải xác định được xu hướng thị trường nói chung và xu hướng giá cổ phiếu nói riêng. Bài học trên đây sẽ giúp nhà đầu tư có thể hiểu hơn về xu hướng thi trường và cách xác định xu hướng đó một cách đơn giản, chính xác nhất để có thể đặt lệnh giao dịch hợp lý nhằm tăng tối đa hiệu quả đầu tư và tránh những sai lầm, rủi ro đáng tiếc có thể xảy ra.
                                                    </div>
                                                    
                                                    <div class="login-to-learn">
                                                        <div class="haveto-upgrade haveto__login">
                                                            <div class="blur-bg" style="background-image: url('https://www.w3schools.com/howto/photographer.jpg')"></div>
                                                            <div class="blur-bg-dark"></div>
                                                            <div class="blur-bg-content">
                                                                <div>Bạn cần đăng nhập để có thể xem nội dung này !</div>
                                                                <div>Bạn đã xem tất cả các video miễn phí , hãy trở thành thành viên để có quyền truy cập không giới hạn. Đăng nhập để có thể xem thêm video</div>
                                                                <div><a href="/dang-nhap" class="btn__reg c-btn" title="Đăng ký">Đăng ký</a><a href="/dang-nhap" class="mainbg btn__login c-btn" title="Đăng nhập">Đăng nhập</a></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <?php echo the_content();?>

                                            </div>

										</div>
									</div>

									<div class="col medium-4 small-12 large-4 snt-rightbar">
										<div class="col-inner">
                                            <div class="course-widget-toc">
												
															<?php learn_press_get_template( 'single-course/content-item/popup-sidebar' ); ?>
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<?php

/**
 * LP Hook
 *
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

/**
 * LP Hook
 *
 * @since 3.0.0
 */
//do_action( 'learn-press/after-single-course' );

/**
 * LP Hook
 *
 * @since 4.0.0
 *
 * @see LP_Template_General::template_footer()
 */
if ( empty( $is_block_theme ) ) {
	do_action( 'learn-press/template-footer' );
}
