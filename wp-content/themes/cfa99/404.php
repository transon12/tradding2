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
            rrrrrrr
            <div class="col medium-8 small-12 large-9 snt-main-content">
                <div class="px">
                    <div class="col-inner">
                        <header class="page-title">
							<h1 class="page-title"><?php esc_html_e( 'Ối! Không thể tìm thấy trang đó.', 'flatsome' ); ?></h1>
						</header>
						<div class="page-content">
                            hfjffjfjfbhj
							<p><?php esc_html_e( 'Có vẻ như không có gì được tìm thấy tại vị trí này. Có thể thử một trong các liên kết bên dưới hoặc tìm kiếm?', 'flatsome' ); ?></p>
							<?php get_search_form(); ?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>