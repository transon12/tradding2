<?php
/**
 * The blog template file.
 *
 * @package flatsome
 */

get_header();

?>

<div id="content" class="blog-wrapper blog-single page-wrapper p-0">
    <?php
    while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content-technical-chart' );

    endwhile; 
    ?>
</div>

<?php get_footer();