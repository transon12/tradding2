<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="searchform" action="<?php home_url();?>">
    <div class="flex-row relative">
        <div class="flex-col search-form-categories">
            <?php
                $args = array(
                    'number'     => '999',
                    'orderby'    => 'name',
                    'hide_empty' => true,
                );
                $selected_category  = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : '';
            ?>
            
            <select class="search_categories resize-select mb-0" name="post_type">
                <option value="" <?php echo selected( '', $selected_category, false );?>>Tất cả tin tức</option>
                <option value="post" <?php echo selected( 'post', $selected_category, false );?>>Tin tức</option>
                <option value="lp_course" <?php echo selected( 'lp_course', $selected_category, false );?>>Khóa học</option>
                <option value="stocks" <?php echo selected( 'stocks', $selected_category, false );?>>Cổ phiếu</option>
                <option value="khuyennghi" <?php echo selected( 'khuyennghi', $selected_category, false );?>>Khuyến nghị đầu tư</option>
            </select>
        </div>
        <div class="flex-col flex-grow">
            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Tìm kiếm:</label>
            <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Tìm kiếm tin tức" value="<?php echo get_search_query();?>" name="s" />
        </div>
        <div class="flex-col">
            <button type="submit" value="Tìm kiếm" class="ux-search-submit submit-button secondary button icon mb-0">
                <i class="icon-search"></i>
            </button>
        </div>
    </div>
</form>