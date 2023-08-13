<?php
/*
Template name: Page - Left Sidebar
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>
<div  class="page-left-sidebar">
    <div class="row row-collapse row-full-width">
        <div class="col medium-4 small-12 large-3 snt-sidebar">
            <div class="col-inner">
            <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
            </div>
        </div>
        <div class="col medium-8 small-12 large-9 snt-main-content">
            <div class="snt-auto">
                <div class="col-inner">
                    <div class="page-inner">
                        <?php if(get_theme_mod('default_title', 0)){ ?>
                        <header class="entry-header">
                            <h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
                        </header>
                        <?php } ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php if ( comments_open() || '0' != get_comments_number() ){
                                    comments_template(); } ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
