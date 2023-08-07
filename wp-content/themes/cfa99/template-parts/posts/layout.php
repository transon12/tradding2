<section class="section p-0 blog-archive">
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
                        <?php do_action('flatsome_before_blog');?>
                            <?php if(!is_single() && get_theme_mod('blog_featured', '') == 'top'){ get_template_part('template-parts/posts/featured-posts'); } ?>
                                <?php if(!is_single() && get_theme_mod('blog_featured', '') == 'content'){ get_template_part('template-parts/posts/featured-posts'); } ?>
                                <?php
                                    if(is_single()){
                                        get_template_part( 'template-parts/posts/single');
                                        comments_template();
                                    } elseif(get_theme_mod('blog_style_archive', '') && (is_archive() || is_search())){
                                        get_template_part( 'template-parts/posts/archive', get_theme_mod('blog_style_archive', '') );
                                    } else{
                                        get_template_part( 'template-parts/posts/archive', get_theme_mod('blog_style', 'normal') );
                                    }
                                ?>
                            <?php do_action('flatsome_after_blog');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
