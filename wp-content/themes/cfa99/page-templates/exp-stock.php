<?php
/*
	Template Name: Kinh nghiệm chứng khoán

*/
get_header(); 
?>

<section class="section p-0 exp__stock">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content body-stock">
                <div class="snt-auto">
                <?php
                    $parent_cat_arg = array('hide_empty' => true, 'parent' => 13 );
                    $parent_cat = get_terms('category',$parent_cat_arg);
                    foreach($parent_cat as $key){?>
                    <div class="col-inner">
                        <div class="stocker-heading-text">
                            <h1 class="stock-title"><?php echo $key->name; ?></h1>
                            <a href="<?php echo get_term_link( $key, 'category' ) ?>" class="rm">Xem thêm</a>
                        </div>
                        <div class="row row-small large-columns-3 medium-columns-2 small-columns-1 slider row-slider slider-nav-simple slider-nav-push is-draggable flickity-enabled"
                            data-flickity-options='{
                                "cellAlign": "left",
                                "wrapAround": true,
                                "autoPlay": false,
                                "prevNextButtons":true,
                                "adaptiveHeight": true,
                                "imagesLoaded": true,
                                "lazyLoad": 1,
                                "dragThreshold" : 1,
                                "pageDots": false,
                                "rightToLeft": false,
                                "contain":true,
                                "groupCells":true,
                                "groupCells":1
                            }'
                        >
                        <?php $blog=new WP_Query(array('post_type'=>'post','posts_per_page'=>9,'cat'=>$key->term_id));
                        if($blog->have_posts()):while($blog->have_posts()):$blog->the_post();
                            ?>
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
                                                    <p class="from_the_blog_excerpt">
                                                        <?php
                                                            $the_excerpt  = get_the_excerpt();
                                                            $excerpt_more = apply_filters( 'excerpt_more', '...' );
                                                            echo flatsome_string_limit_words($the_excerpt, 15) . $excerpt_more;
                                                        ?>
                                                    </p>
                                                    <ul class="info-post">
                                                        <?php
                                                            $author_id = get_post_field( 'post_author', get_the_ID() );
                                                            $username=get_the_author_meta( 'user_nicename', 41 );
                                                        ?>
                                                        <li class="info-posted-author">
                                                            <img src="<?php echo esc_url( get_avatar_url( $author_id) ); ?>" />
                                                            <span class="name"><?php echo $username; ?></span>
                                                        </li>
                                                        <li class="info-post-date">
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 1C3.245 1 1 3.245 1 6C1 8.755 3.245 11 6 11C8.755 11 11 8.755 11 6C11 3.245 8.755 1 6 1ZM8.175 7.785C8.105 7.905 7.98 7.97 7.85 7.97C7.785 7.97 7.72 7.955 7.66 7.915L6.11 6.99C5.725 6.76 5.44 6.255 5.44 5.81V3.76C5.44 3.555 5.61 3.385 5.815 3.385C6.02 3.385 6.19 3.555 6.19 3.76V5.81C6.19 5.99 6.34 6.255 6.495 6.345L8.045 7.27C8.225 7.375 8.285 7.605 8.175 7.785Z" fill="#475467"/>
                                                            </svg>
                                                            <?php echo get_the_date('d-m-Y'); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile;wp_reset_query();endif; ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>