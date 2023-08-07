<?php
/*
	Template Name: Chi tiết khóa học - Template
*/
get_header(); 
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
                                                <a href="<?php home_url('khoa-hoc'); ?>">
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
                                                            <li><a>Nội dung bài học</a></li>
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
                                                <h3 id="tab_muc-luc">Bài học</h3>
                                                <ul>
                                                    <li><a href="#" class="course-toc-time">00:00</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                    <li><a href="#" class="course-toc-time">03:25</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                    <li><a href="#" class="course-toc-time">05:57</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                    <li><a href="#" class="course-toc-time">09:26</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                    <li><a href="#" class="course-toc-time">10:16</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                </ul>
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

<?php get_footer(); ?>