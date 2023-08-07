<?php
/*
	Template Name: Phân tích cổ phiếu nóng - Demo
*/
get_header(); 
?>

<section class="section p-0 -------customname-template">
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
                        <div class="px bg-fff">
                            <?php echo do_shortcode('[ux_analysis]');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>