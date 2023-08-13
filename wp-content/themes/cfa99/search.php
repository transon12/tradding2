<?php
/**
 * The blog template file.
 *
 * @package flatsome
 */

get_header();

?>

<section class="section p-0 account-frontpage snt">
    <div class="bg section-bg fill bg-fill bg-loaded"></div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                    <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content">
                <div class="px">
                    <div class="col-inner">
                        <header class="archive-page-header">
                            <h1 class="page-title">
                                <?php printf( esc_html__( 'Từ khóa tìm kiếm: %s', 'shtheme' ), '<span>' . get_search_query() . '</span>' ); ?>
                            </h1>
                        </header>
                        <?php if ( have_posts() ) : ?>
                        <?php
                        $s  =   get_search_query();
                        $args = array('s' =>$s);
                            // The Query
                        $the_query = new WP_Query( $args );
                        if ( $the_query->have_posts() ) {
                            echo '<div class="row large-columns-3 medium-columns-2 small-columns-1">';
                                while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                    ?>
                                        <div class="col post-item">
                                            <div class="col-inner">
                                                <a href="<?php the_permalink(); ?>" class="plain">
                                                    <div class="box box-text-bottom box-blog-post has-hover">
                                                        <div class="box-image">
                                                            <div class="image-cover" style="padding-top:56%;">
                                                                <?php the_post_thumbnail();?>
                                                            </div>
                                                        </div>
                                                        <div class="box-text text-left">
                                                            <div class="box-text-inner blog-post-inner">
                                                                <h5 class="post-title is-large "><?php the_title(); ?></h5>
                                                                <p class="from_the_blog_excerpt ">
                                                                    <?php
                                                                        $the_excerpt  = get_the_excerpt();
                                                                        $excerpt_more = apply_filters( 'excerpt_more', ' [...]' );
                                                                        echo flatsome_string_limit_words($the_excerpt, 50) . $excerpt_more;
                                                                    ?>
                                                                </p>
                                                                <?php do_action('flatsome_blog_post_after'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                }
                            echo '</div>';
                            }else{
                            ?>
                                    <h2 style='font-weight:bold;color:#000'>Không tìm thấy</h2>
                                    <div class="alert alert-info">
                                    <p>Rất xin lỗi, nhưng không có nội dung nào phù hợp với yêu cầu tìm kiếm của bạn. Vui lòng thử lại với một số từ khóa khác nhau.</p>
                                    </div>
                            <?php } ?>

                        <?php flatsome_posts_pagination(); ?>

                        <?php else : ?>
                            <?php get_template_part( 'template-parts/posts/content','none'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>