<?php
/**
 * The archive template file.
 *
 * @package flatsome
 */

get_header();
?>

<?php do_action( 'flatsome_before_page' ); ?>



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
                                                    Tất cả báo cáo phân tích cổ phiếu
                                                </a>
                                            </div>
                                            <div class="post-meta">
                                                <div class="post-author">
                                                    Đăng bởi <span style="color:#EDB62B;"><?php echo get_the_author();?></span>
                                                </div>
                                                <div class="post-date">
                                                    Cập nhật: <?php echo get_the_date();?>
                                                </div>
                                            </div>
                                            <?php echo do_shortcode( '[share]' );?>
                                            <header class="entry-header">
                                                <h1 class="entry-title">
                                                    <?php echo get_the_title();?>
                                                </h1>
                                            </header>
                                            <div class="entry-content">
                                                <?php echo the_content();?>
                                            </div>
                                        </div>
                                    </div>
									<div class="col medium-4 small-12 large-4 snt-rightbar">
										<div class="col-inner">
                                            <?php dynamic_sidebar( 'sidebar-market-analyst' ); ?>
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

<?php do_action( 'flatsome_after_page' ); ?>
	
<?php get_footer(); ?>
