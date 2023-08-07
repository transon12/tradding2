<?php
/*
	Template Name: Homepage
*/
get_header(); 
?>

<section class="section p-0 homepage snt">
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
                            <?php echo do_shortcode('[ux_stocks_shortcode]');?>
                        </div>
                        <div class="gap"></div>
                        <div class="px bg-fff">
                            <?php echo do_shortcode('[ux_analysis]');?>
                        </div>
                        <div class="gap"></div>
                        <div class="p-20 bg-fff home-block-posts">
                            <?php echo do_shortcode('[blog_posts style="normal" type="grid" grid="6" col_spacing="small" posts="3" show_date="false" comments="false" image_size="large" text_align="left" text_bg="rgb(255, 255, 255)"]');?>
                        </div>
                        <div class="gap"></div>
                        <?php echo do_shortcode('[block id="banner-qa"]');?>
                        <div class="gap"></div>
                        <div class="bg-fff">
                            <div class="homepage-about px">
                                <?php echo the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>