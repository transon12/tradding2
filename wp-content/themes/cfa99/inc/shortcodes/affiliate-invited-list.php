<?php
/**
 * Affiliate shortcodes.
 *
 * @package cfa99
 */

add_shortcode( 'cfa99_aff_invited_list', 'cfa99_add_shortcode_aff_invited_list' );
/**
 * Add shortcode display invited user list of current user ( by referral code ).
 */
function cfa99_add_shortcode_aff_invited_list() {
	global $wpdb;

	$curr_user_id = get_current_user_id();

	$results = $wpdb->get_results( "SELECT user_id FROM {$wpdb->prefix}usermeta WHERE meta_value LIKE '{$curr_user_id}' AND meta_key = 'referral_user' ORDER BY user_id DESC" ); // phpcs:ignore.

	$content = '';
	ob_start();

	if ( ! empty( $results ) ) {
		?>
	<table class="invited-user-list dataTable">
		<thead>
			<th>Tên</th>
			<th>Gói thành viên</th>
			<th>Thời gian</th>
		</thead>
		<tbody>
		<?php
		foreach ( $results as $item ) :
			$user_data        = get_userdata( $item->user_id );
			$membership_level = pmpro_getMembershipLevelForUser( $item->user_id );
			?>
			<tr>
				<td>
					<div class="user-name"><?php echo esc_html( $user_data->display_name ); ?></div>
				</td>
				<td>
					<?php if ( $membership_level ) : ?>
					<span class="snt-usergroup"><?php echo esc_html( $membership_level->name ); ?></span>
					<?php endif; ?>
				</td>
				<td>
					<?php echo esc_html( $user_data->user_registered ); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
		<?php
	}else{ ?>
		<table>
			<tbody><tr>
				<th>Tên</th>
				<th>Gói thành viên</th>
				<th>Thời gian</th>
			</tr><tr>
				</tr><tr>
					<td colspan="3">Bạn chưa có lịch sử mời nào...</td>
				</tr>
			</tbody>
		</table>

	<?php 
	}
	$content = ob_get_clean();

	return $content;
}

add_shortcode( 'cfa99_aff_dashboard', 'cfa99_add_shortcode_affiliate_dashboard' );
/**
 * Add shortcode display referral link, code for affiliate user.
 * If not affiliate user, display input enter referral code of other user.
 */
function cfa99_add_shortcode_affiliate_dashboard() {
	if ( ! is_user_logged_in() ) {
		return;
	}

	$referral_user  = get_user_meta( get_current_user_id(), 'referral_user', true );
	$referral_code  = $referral_user && '' !== $referral_user ? get_user_meta( $referral_user, 'ma_gioi_thieu', true ) : '';
	$button_label   = __( 'Áp dụng', 'cfa99' );
	$box_title      = __( 'Mã giới thiệu', 'cfa99' );
	$button_classes = 'btn-act-apply';
	$is_disabled    = '' !== $referral_code ? true : false;

	if ( slicewp_is_user_affiliate() ) {
		$box_title      = __( 'Mã giới thiệu của bạn', 'cfa99' );
		$button_label   = __( 'Sao chép', 'cfa99' );
		$button_classes = 'btn-act-copy';
		$is_disabled    = true;
		$referral_code  = get_user_meta( get_current_user_id(), 'ma_gioi_thieu', true );
		$affiliate_id   = slicewp_get_current_affiliate_id();
		$aff_url        = slicewp_get_affiliate_url( $affiliate_id );
	}

	ob_start();
	?>
		
	<div class="referral-code">
		<h2 class="box-title"><?php echo $box_title; // phpcs:ignore. ?></h2>
		<div class="code-box">
			<input type="text" class="referral-code-input<?php echo $is_disabled ? ' disabled' : ''; ?>" name="referral-code" value="<?php echo esc_html( $referral_code ); ?>" <?php echo $is_disabled ? 'disabled' : ''; ?>>
			<button class="<?php echo esc_attr( $button_classes ); ?>" type="button">
				<?php echo $button_label; // phpcs:ignore. ?>
			</button>
		</div>
		<p><?php esc_html_e( 'Lưu ý: Mã giới thiệu này bạn có thể nhập hoặc không.', 'cfa99' ); ?></p>
	</div>

	<?php
	$html = ob_get_clean();

	return $html;
}
