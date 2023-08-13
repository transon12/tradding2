<?php
/*
	Template Name: Trang chủ

*/

get_header();
$i = 1;

?>

<?php do_action( 'flatsome_before_page' ); ?>

<section class="blog-archive">
    <div class="row row-small">
        <?php echo do_shortcode('[block id="menu-sidebar"]');?>
        <div class="col medium-9 small-12 large-9">
            <div class="col-inner">
                <?php echo the_content(); ?>
                <?php echo do_shortcode('[block id="footer"]') ;?>

            </div>
        </div>
    </div>
</section>



<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>