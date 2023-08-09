<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wrapper_classes = array();
$row_classes     = array();
$main_classes    = array();
$sidebar_classes = array();

$layout = get_theme_mod( 'checkout_layout' );

if ( ! $layout ) {
	$sidebar_classes[] = 'has-border';
}

if ( $layout == 'simple' ) {
	$sidebar_classes[] = 'is-well';
}

$wrapper_classes = implode( ' ', $wrapper_classes );
$row_classes     = implode( ' ', $row_classes );
$main_classes    = implode( ' ', $main_classes );
$sidebar_classes = implode( ' ', $sidebar_classes );

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

// Social login.
if ( flatsome_option( 'facebook_login_checkout' ) && get_option( 'woocommerce_enable_myaccount_registration' ) == 'yes' && ! is_user_logged_in() ) {
	wc_get_template( 'checkout/social-login.php' );
}
?>
<form name="checkout" method="post" class="checkout woocommerce-checkout <?php echo esc_attr( $wrapper_classes ); ?>" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div class="row pt-0 <?php echo esc_attr( $row_classes ); ?>">
		<div class="large-7 col  <?php echo esc_attr( $main_classes ); ?>">
			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div id="customer_details">
					<div class="info-product">
						<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$excerpt = wp_strip_all_tags( get_the_excerpt($cart_item['product_id']), true );
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									?>
									<div>
										<div class="title-product">
											<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/pretium.svg">
											<span><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?></span>
										</div>
										<div class="sub-title-product">
											<?php echo $excerpt;?>
										</div>
									</div>
									<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php
								}
							}					
						?>
					</div>
					<div class="form-coupon-wrap">
						<p class="title-coupon"><strong>Mã giới thiệu</strong></p>
						<?php global $wpdb,$current_user;$id=$current_user->ID;?>
						<?php $authors= $wpdb->get_results("SELECT * FROM a2z_usermeta WHERE meta_key ='data_ref' AND meta_value LIKE '%\"user_used\";i:$id;%'"); 
						if(empty($authors)){
						?>
						<p class="form-coupon">
							<input type="text" name="mgt" class="input-text" placeholder="<?php esc_attr_e( 'Nhập mã giới thiệu', 'woocommerce' ); ?>" id="magt" value="" />
						</p>
						<?php }else{  $id=$authors[0]->user_id;?>
							<p class="form-coupon">
							<input type="text" disabled name="mgt" class="input-text" id="magt" value="<?php echo get_field('ma_gioi_thieu','user_'.$id); ?>" />
						</p>
							<?php } ?>
						<div class="divider"></div>
						<!-- <div>Lưu ý: Mã giới thiệu này bạn có thể nhập hoặc không .</div> -->
						<div class="clear"></div>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<?php endif; ?>

		</div>

		<div class="large-5 col">
			<?php flatsome_sticky_column_open( 'checkout_sticky_sidebar' ); ?>

                <div class="col-inner">
                    <div class="checkout-sidebar sm-touch-scroll">

                        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>


                        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                        </div>

                        <?php //do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>
                </div>

			<?php flatsome_sticky_column_close( 'checkout_sticky_sidebar' ); ?>
		</div>

	</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>