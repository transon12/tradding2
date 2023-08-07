<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="row">

	<?php if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>
		<div class="large-12 col order-failed">
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>
		</div>

		<?php else : ?>
    <div class="small-12 large-12 col pb-0">
        <div class="col-inner" style="color: #101828;font-size: 16px;font-weight: 600;line-height: 24px;text-transform: uppercase;margin-bottom:17px;">
            Chuyển tiền theo thông tin bên dưới:
        </div>
    </div>
    <div class="small-12 large-4 col">
        <div class="col-inner box-pay">
            <div>
                <div class="step">
                    Bước 1:
                    <span>Quét mã/Chuyển tiền</span>
                </div>

                <?php 
                    $bacs_accounts_info = get_option( 'woocommerce_bacs_accounts');
                    if ($bacs_accounts_info) foreach($bacs_accounts_info as $bacs) :
                        ?>
                        <div class="qr-pay">
                            <img width="200px" src="<?php echo $bacs['sort_code'];?>">
                        </div>
                        <div class="info-pay">
                            <div>
                                <span>Tên ngân hàng:</span>
                                <span><?php echo $bacs['bank_name'];?></span>
                            </div>
                            <div>
                                <span>Số tài khoản:</span>
                                <span><?php echo $bacs['account_number'];?></span>
                            </div>
                            <div>
                                <span>Tên chủ tài khoản:</span>
                                <span><?php echo $bacs['account_name'];?></span>
                            </div>
                            <div>
                                <span>Số tiền:</span>
                                <span><?php echo $order->get_formatted_order_total(); ?></span>
                            </div>
                        </div>
                        <?php
                    endforeach;
                ?>

                
            </div>
        </div>
    </div>
    <div class="small-12 large-4 col">
        <div class="col-inner box-pay">
            <div>
                <div class="step">
                    Bước 2 (Quan trọng):
                    <span>Nhập nội dung chuyển tiền</span>
                </div>
                <div class="content-pay">
                    <span>
                        <?php echo $order->get_order_number();?>
                    </span>
                </div>
                <div class="support-pay">
                    Các giao dịch không nhập nội dung chuyển tiền, hoặc nhập không đúng nội dung theo yêu cầu sẽ không được cộng xu tự động.<br> 
                    <a href="">Vui lòng liên hệ bộ phận CSKH</a>
                </div>
            </div>
        </div>
    </div>
    <div class="small-12 large-4 col">
        <div class="col-inner box-pay">
            <div>
                <div class="step">
                    Trạng thái:
                    <span>Trạng thái giao dịch</span>
                </div>
                <div class="handle-pay">
                    <span>
                        <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/oclock.png'?>">
                        <?php 
                            if($order->get_status() == 'processing'){
                                echo 'Đang xử lý';
                            }else if($order->get_status() == 'on-hold'){
                                echo 'Tạm giữ';
                            }else if($order->get_status() == 'pending'){
                                echo 'Chờ thanh toán';
                            }else if($order->get_status() == 'completed'){
                                echo 'Đã hoàn thành';
                            }else if($order->get_status() == 'cancelled'){
                                echo 'Đã huỷ';
                            }else{
                                echo 'Thất bại';
                            }
                        
                        ?>
                    </span>
                    <span>Đang chờ xử lý từ hệ thống</span>
                </div>
                <div class="note-pay">
                    <span>Vui lòng không đóng cửa sổ này cho đến khi giao dịch được hoàn tất</span>
                </div>
            </div>
        </div>
    </div>        
		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
