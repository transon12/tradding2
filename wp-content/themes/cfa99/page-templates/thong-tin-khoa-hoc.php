<?php
/*
	Template Name: Thông tin khóa học - Template
*/
get_header(); 
?>

<section class="section p-0 snt-single single__course">
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
                                                <a href="#" onclick="window.history.go(-1); return false;">
                                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    Danh sách các khóa học
                                                </a>
                                            </div>
                                            <header class="entry-header">

                                                <h1 class="entry-title">
                                                    <?php echo get_the_title();?>
                                                </h1>

                                                <div class="entry-meta d-flex align-items-center">
                                                    <div class="course-review-star">
                                                        ✭✭✭✭✭
                                                        <span class="course-review-hits">
                                                            <span style="color:#1D2939;font-weight:bold">4.8</span>
                                                            <span style="color:#98A2B3">(4.121)</span>
                                                        </span>
                                                    </div>
                                                    <div class="course-view-hits">
                                                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.38841 0C11.5936 0 14.5003 1.7536 16.6451 4.60192C16.8201 4.83528 16.8201 5.16129 16.6451 5.39465C14.5003 8.2464 11.5936 10 8.38841 10C5.18319 10 2.27654 8.2464 0.131718 5.39808C-0.0432995 5.16472 -0.0432995 4.83871 0.131718 4.60535C2.27654 1.7536 5.18319 0 8.38841 0ZM8.15849 8.52093C10.2861 8.65477 12.0432 6.90117 11.9093 4.77008C11.7995 3.01304 10.3754 1.58888 8.61834 1.47907C6.49068 1.34523 4.73364 3.09883 4.86748 5.22992C4.98072 6.98353 6.40488 8.40769 8.15849 8.52093ZM8.26487 6.8943C9.41106 6.96637 10.3582 6.02265 10.2827 4.87646C10.2244 3.92931 9.45567 3.16404 8.50852 3.10227C7.36233 3.0302 6.41518 3.97392 6.49068 5.12011C6.55245 6.07069 7.32115 6.83596 8.26487 6.8943Z" fill="#475467"/>
                                                        </svg>
                                                        <span>1000</span>
                                                        <span> lượt xem</span>
                                                    </div>
                                                </div>
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
                                                            <li><a href="#tab_muc-luc">Mục lục</a></li>
                                                            <li><a href="#tab_thong-tin-chung">Thông tin chung</a></li>
                                                            <li><a href="#tab_giang-vien">Giảng viên</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="course-entry-readmore">
                                                        Khi giao dịch trên thị trường chứng khoán, nhà đầu tư cần phải xác định được xu hướng thị trường nói chung và xu hướng giá cổ phiếu nói riêng. Bài học trên đây sẽ giúp nhà đầu tư có thể hiểu hơn về xu hướng thi trường và cách xác định xu hướng đó một cách đơn giản, chính xác nhất để có thể đặt lệnh giao dịch hợp lý nhằm tăng tối đa hiệu quả đầu tư và tránh những sai lầm, rủi ro đáng tiếc có thể xảy ra.
                                                    </div>

                                                    <div class="course-entry-toc">
                                                        <h3 id="tab_muc-luc">Mục lục</h3>
                                                        <ul>
                                                            <li><a href="#" class="course-toc-time">00:00</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                            <li><a href="#" class="course-toc-time">03:25</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                            <li><a href="#" class="course-toc-time">05:57</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                            <li><a href="#" class="course-toc-time">09:26</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                            <li><a href="#" class="course-toc-time">10:16</a> <span class="course-toc-title">Tìm hiểu về thanh toán Airpay trên Shopee</span></li>
                                                        </ul>
                                                    </div>

                                                    <div class="course-entry-main">
                                                        <h3 id="tab_thong-tin-chung">Thông tin chung</h3>
                                                        <p>Airpay là ứng dụng ví điện tử, hiện nay đã được đổi tên thành Shopee Pay. Thanh toán Airpay là phương thức thanh toán mà người dùng có thể chi trả cho nhiều dịch vụ: mua hàng, ăn uống, giải trí, vui chơi,… một cách nhanh chóng mà không dùng tiền mặt. Tất cả những gì người dùng cần chỉ là một chiếc điện thoại thông minh có liên kết tài khoản ngân hàng với ứng dụng Airpay.</p>
                                                        <p>Tại Shopee, bạn có thể sử dụng Airpay để thanh toán thay cho việc sử dụng tiền mặt (COD). Đây là phương thức thanh toán trả trước được nhiều người lựa chọn khi mua hàng trên sàn thương mại điện tử này.  </p>
                                                    </div>

                                                    <div class="course-entry-teachers">
                                                        <h3 id="tab_giang-vien">Giảng viên</h3>
                                                        <div class="course_teachers">
                                                            <div class="teacher-item"> <!--teacher item -->
                                                                <div class="teacher-avatar radius-c"><img src="https://picsum.photos/400"></div>
                                                                <div class="teacher-name">Hồ Thị Khánh Linh</div>
                                                            </div>
                                                            <div class="teacher-item"> <!--teacher item -->
                                                                <div class="teacher-avatar radius-c"><img src="https://picsum.photos/401"></div>
                                                                <div class="teacher-name">Nguyễn Thanh Phúc</div>
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
											<?php flatsome_sticky_column_open( 'blog_sticky_sidebar' ); ?>
											<?php dynamic_sidebar( 'sidebar-market-analyst' ); ?>
											<?php flatsome_sticky_column_close( 'blog_sticky_sidebar' ); ?>
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