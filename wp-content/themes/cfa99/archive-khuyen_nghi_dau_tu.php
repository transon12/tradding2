<?php
/**
 * The archive template file.
 *
 * @package flatsome
 */

get_header();
?>

<?php do_action( 'flatsome_before_page' ); ?>

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
                            <h1 class="entry-title"><a href="#lightbox-article">Khuyến nghị đầu tư</a></h1>
                            <?php if ( have_posts() ) : ?>
                                <div class="row large-columns-3 medium-columns-2 small-columns-1">
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <div class="col post-item">
                                            <div class="col-inner">
                                                <a href="<?php the_permalink() ?>" class="plain">
                                                    <div class="box box-text-bottom box-blog-post has-hover">
                                                        <div class="box-image">
                                                            <div class="image-cover" style="padding-top:56%;">
                                                                <?php the_post_thumbnail('full'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="box-text text-left">
                                                            <div class="box-text-inner blog-post-inner">
                                                                <h5 class="post-title is-large ">
                                                                    <?php the_title() ?>
                                                                </h5>
                                                                <div class="from_the_blog_excerpt ">
                                                                    <?php the_excerpt( ); ?>
                                                                </div>
                                                                <?php do_action('flatsome_blog_post_after'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <?php flatsome_posts_pagination(); ?>
                            <?php else : ?>
                                <?php get_template_part( 'template-parts/posts/content','none'); ?>
                            <?php endif; ?>
                            <?php echo do_shortcode('[lightbox id="lightbox-article" class="lightbox-article" width="600px" padding="20px"]WP GET CONTENT POST - HERE[/lightbox]')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php do_action( 'flatsome_after_page' ); ?>
	
<?php get_footer(); ?>
