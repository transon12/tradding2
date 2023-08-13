<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Dashboard card: Totals.
 *
 */
class SliceWP_Admin_Dashboard_Card_Totals extends SliceWP_Admin_Dashboard_Card {

	/**
	 * Initialize the card.
	 *
	 */
	protected function init() {

		$this->slug    = 'totals';
		$this->name    = __( 'Totals', 'slicewp' );
		$this->context = 'primary';

	}


	/**
	 * Returns the data that should be printed in the card.
	 * 
	 */
	protected function get_data() {

		$data = array();

		// Last 7 days.
		$commissions = slicewp_get_commissions( array( 'number' => -1, 'status' => array( 'paid', 'unpaid' ), 'fields' => 'amount', 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 7 * DAY_IN_SECONDS ) ) ) );
		$revenue 	 = slicewp_get_commissions( array( 'number' => -1, 'status' => array( 'paid', 'unpaid' ), 'fields' => 'reference_amount', 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 7 * DAY_IN_SECONDS ) ) ) );

		$data['last_7_days'] = array(
			'revenue' 			 => array_sum( $revenue ),
			'commissions_amount' => array_sum( $commissions ),
			'net_revenue' 		 => ( array_sum( $revenue ) > array_sum( $commissions ) ? array_sum( $revenue ) - array_sum( $commissions ) : 0 ),
			'visits' 			 => slicewp_get_visits( array( 'number' => -1, 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 7 * DAY_IN_SECONDS ) ) ), true ),
			'commissions' 		 => count( $commissions ),
			'affiliates'  		 => slicewp_get_affiliates( array( 'number' => -1, 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 7 * DAY_IN_SECONDS ) ) ), true )
		);

		// Last 30 days.
		$commissions = slicewp_get_commissions( array( 'number' => -1, 'status' => array( 'paid', 'unpaid' ), 'fields' => 'amount', 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 30 * DAY_IN_SECONDS ) ) ) );
		$revenue 	 = slicewp_get_commissions( array( 'number' => -1, 'status' => array( 'paid', 'unpaid' ), 'fields' => 'reference_amount', 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 30 * DAY_IN_SECONDS ) ) ) );

		$data['last_30_days'] = array(
			'revenue' 			 => array_sum( $revenue ),
			'commissions_amount' => array_sum( $commissions ),
			'net_revenue' 		 => ( array_sum( $revenue ) > array_sum( $commissions ) ? array_sum( $revenue ) - array_sum( $commissions ) : 0 ),
			'visits' 			 => slicewp_get_visits( array( 'number' => -1, 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 30 * DAY_IN_SECONDS ) ) ), true ),
			'commissions' 		 => count( $commissions ),
			'affiliates'  		 => slicewp_get_affiliates( array( 'number' => -1, 'date_min' => get_gmt_from_date( date( 'Y-m-d H:i:s', time() - 30 * DAY_IN_SECONDS ) ) ), true )
		);

		// All time.
		$commissions = slicewp_get_commissions( array( 'number' => -1, 'status' => array( 'paid', 'unpaid' ), 'fields' => 'amount' ) );
		$revenue 	 = slicewp_get_commissions( array( 'number' => -1, 'status' => array( 'paid', 'unpaid' ), 'fields' => 'reference_amount' ) );

		$data['all_time'] = array(
			'revenue' 			 => array_sum( $revenue ),
			'commissions_amount' => array_sum( $commissions ),
			'net_revenue' 		 => ( array_sum( $revenue ) > array_sum( $commissions ) ? array_sum( $revenue ) - array_sum( $commissions ) : 0 ),
			'visits' 			 => slicewp_get_visits( array( 'number' => -1 ), true ),
			'commissions' 		 => count( $commissions ),
			'affiliates'  		 => slicewp_get_affiliates( array( 'number' => -1 ), true )
		);

		return $data;

	}


	/**
	 * Output the card's content.
	 *
	 */
	public function output() {

		?>

			<div id="slicewp-totals-period-filter-wrapper" class="slicewp-field-wrapper" style="display: none;">

				<select id="slicewp-totals-period-filter" class="slicewp-select2 slicewp-select2-small">
					<option value="last_7_days"><?php echo __( 'Last 7 days', 'slicewp' ); ?></option>
					<option value="last_30_days" selected><?php echo __( 'Last 30 days', 'slicewp' ); ?></option>
					<option value="all_time"><?php echo __( 'All time', 'slicewp' ); ?></option>
				</select>

			</div>

			<?php foreach ( $this->get_data() as $key => $data ): ?>

				<table class="slicewp-card-table-full-width" data-period="<?php echo esc_attr( $key ) ?>" <?php echo ( $key != 'last_30_days' ? 'style="display: none;"' : '' ); ?>>

					<tbody>

						<tr>

							<td>
								<p><?php echo __( 'Referral Revenue', 'slicewp' ); ?></p>
								<span><?php echo slicewp_format_amount( $data['revenue'], slicewp_get_setting( 'active_currency', 'USD' ) ); ?></span>
							</td>

							<td>
								<p><?php echo __( 'Commissions Amount', 'slicewp' ); ?></p>
								<span><?php echo slicewp_format_amount( $data['commissions_amount'], slicewp_get_setting( 'active_currency', 'USD' ) ); ?></span>
							</td>

							<td>
								<p><?php echo __( 'Net Referral Revenue', 'slicewp' ); ?></p>
								<span><?php echo slicewp_format_amount( $data['net_revenue'], slicewp_get_setting( 'active_currency', 'USD' ) ); ?></span>
							</td>

						</tr>

						<tr>

							<td>
								<p><?php echo __( 'Visits', 'slicewp' ); ?></p>
								<span><?php echo $data['visits']; ?></span>
							</td>

							<td>
								<p><?php echo __( 'Commissions', 'slicewp' ); ?></p>
								<span><?php echo $data['commissions']; ?></span>
							</td>

							<td>
								<p><?php echo __( 'Affiliates', 'slicewp' ); ?></p>
								<span><?php echo $data['affiliates']; ?></span>
							</td>

						</tr>

					</tbody>

				</table>

			<?php endforeach; ?>

		<?php

	}

}