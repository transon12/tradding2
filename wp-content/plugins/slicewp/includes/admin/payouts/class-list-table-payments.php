<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * List table class outputter for Payments
 *
 */
Class SliceWP_WP_List_Table_Payments extends SliceWP_WP_List_Table {

	/**
	 * The number of payments that should appear in the table
	 *
	 * @access private
	 * @var int
	 *
	 */
	private $items_per_page;

	/**
	 * The data of the table
	 *
	 * @access public
	 * @var array
	 *
	 */
	public $data = array();


	/**
	 * Constructor
	 *
	 */
	public function __construct() {

		parent::__construct( array(
			'plural' 	=> 'slicewp_payments',
			'singular' 	=> 'slicewp_payment',
			'ajax' 		=> false
		));

		$this->items_per_page = 10;
		$this->paged 		  = ( ! empty( $_GET['paged'] ) ? (int)$_GET['paged'] : 1 );


		//Get the start date from the filter, or set it to the default value if not present
		$date_min = ( ! empty( $_GET['date_min'] ) ? new DateTime( $_GET['date_min'] . ' 00:00:00' ) : '' );
		
		//Get the end date from the filter, or set it to the default value if not present
		$date_max = ( ! empty( $_GET['date_max'] ) ? new DateTime( $_GET['date_max'] . ' 23:59:59') : '' );

		$this->set_pagination_args( array(
            'total_items' => slicewp_get_payments( array( 'number' => -1, 'status' => ( ! empty( $_GET['payment_status'] ) ? sanitize_text_field( $_GET['payment_status'] ) : '' ), 'search' => ( ! empty( $_GET['s'] ) ? $_GET['s'] : '' ), 'payment_id' => ( ! empty( $_GET['payment_id'] ) ? sanitize_text_field( $_GET['payment_id'] ) : '' ), 'affiliate_id' => ( ! empty( $_GET['affiliate_id'] ) ? $_GET['affiliate_id'] : '' ), 'date_min' => ( ! empty ( $date_min ) ? get_gmt_from_date( $date_min->format( 'Y-m-d H:i:s' ) ) : '' ), 'date_max' => ( ! empty( $date_max ) ? get_gmt_from_date( $date_max->format( 'Y-m-d H:i:s' ) ) : '' ) ), true ),
			'per_page'    => $this->items_per_page
        ));

		// Get and set table data
		$this->set_table_data();
		
		// Add column headers and table items
		$this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );
		$this->items 		   = $this->data;
	
	}


	/**
	 * Get a list of CSS classes for the table tag.
	 *
	 * @return array
	 * 
	 */
	protected function get_table_classes() {

		return array( 'striped', $this->_args['plural'] );

	}


	/**
	 * Returns all the columns for the table
	 *
	 */
	public function get_columns() {

		$columns = array(
			'id' 		   	=> __( 'ID', 'slicewp' ),
			'amount'		=> __( 'Amount', 'slicewp' ),
			'affiliate'		=> __( 'Affiliate', 'slicewp' ),
			'payout_method'	=> __( 'Payout Method', 'slicewp' ),
			'date_created'	=> __( 'Date', 'slicewp' ),
			'notes'			=> '<span class="dashicons dashicons-admin-comments" title="' . __( 'Notes', 'slicewp' ) . '"></span>',
			'status'		=> __( 'Status', 'slicewp' ),
			'actions'		=> ''
		);

		/**
		 * Filter the columns of the payments table
		 *
		 * @param array $columns
		 *
		 */
		return apply_filters( 'slicewp_list_table_payments_columns', $columns );

	}

	/**
	 * Returns all the sortable columns for the table
	 *
	 */
	public function get_sortable_columns() {

		$columns = array(
			'id'			=> array( 'id', false ),
			'amount'		=> array( 'amount', false ),
			'status'		=> array( 'status', false ),
			'payout_method'	=> array( 'payout_method', false ),
        );

		/**
		 * Filter the sortable columns of the payments table
		 *
		 * @param array $columns
		 *
		 */
		return apply_filters( 'slicewp_list_table_payments_sortable_columns', $columns );

	}

	/**
     * Returns the possible views for the payment list table
     *
     */
    protected function get_views() {

		// Get the start date from the filter, or set it to the default value if not present
		$date_min = ( ! empty( $_GET['date_min'] ) ? new DateTime( $_GET['date_min'] . ' 00:00:00' ) : '' );
		
		// Get the end date from the filter, or set it to the default value if not present
		$date_max = ( ! empty( $_GET['date_max'] ) ? new DateTime( $_GET['date_max'] . ' 23:59:59') : '' );

		// Get the Payments available statuses
		$statuses = slicewp_get_payment_available_statuses();

    	$payment_status = ( ! empty( $_GET['payment_status'] ) ? sanitize_text_field( $_GET['payment_status'] ) : '' );

    	// Set the view for "all" payments
    	$views = array(
    		'all' => '<a href="' . add_query_arg( array( 'page' => 'slicewp-payouts', 'subpage' => 'view-payments', 'user_search' => ( ! empty( $_GET['user_search'] ) ? $_GET['user_search'] : '' ), 'affiliate_id' => ( ! empty( $_GET['affiliate_id'] ) ? $_GET['affiliate_id'] : '' ), 'date_min' => ( ! empty ( $date_min ) ? $date_min->format( 'Y-m-d' ) : '' ), 'date_max' => ( ! empty ( $date_max ) ? $date_max->format( 'Y-m-d' ) : '' ), 'paged' => 1 ), admin_url( 'admin.php' ) ) . '" ' . ( empty( $payment_status ) ? 'class="current"' : '' ) . '>' . __( 'All', 'slicewp' ) . ' <span class="count">(' . slicewp_get_payments( array( 'search' => ( ! empty( $_GET['s'] ) ? $_GET['s'] : '' ), 'affiliate_id' => ( ! empty( $_GET['affiliate_id'] ) ? $_GET['affiliate_id'] : '' ), 'date_min' => ( ! empty ( $date_min ) ? get_gmt_from_date( $date_min->format( 'Y-m-d H:i:s' ) ) : '' ), 'date_max' => ( ! empty( $date_max ) ? get_gmt_from_date( $date_max->format( 'Y-m-d H:i:s' ) ) : '' ) ), true ) . ')</span></a>'
    	);

		// Set the views for each payment status
    	foreach( $statuses as $status_slug => $status_name ) {
    		$views[$status_slug] = '<a href="' . add_query_arg( array( 'page' => 'slicewp-payouts', 'subpage' => 'view-payments', 'user_search' => ( ! empty( $_GET['user_search'] ) ? $_GET['user_search'] : '' ), 'affiliate_id' => ( ! empty( $_GET['affiliate_id'] ) ? $_GET['affiliate_id'] : '' ), 'date_min' => ( ! empty ( $date_min ) ? $date_min->format( 'Y-m-d' ) : '' ), 'date_max' => ( ! empty ( $date_max ) ? $date_max->format( 'Y-m-d' ) : '' ), 'payment_status' => $status_slug, 'paged' => 1 ), admin_url( 'admin.php' ) ) . '" ' . ( $payment_status == $status_slug ? 'class="current"' : '' ) . '>' . $status_name . ' <span class="count">(' . slicewp_get_payments( array( 'status' => $status_slug, 'search' => ( ! empty( $_GET['s'] ) ? $_GET['s'] : '' ), 'affiliate_id' => ( ! empty( $_GET['affiliate_id'] ) ? $_GET['affiliate_id'] : '' ), 'date_min' => ( ! empty ( $date_min ) ? get_gmt_from_date( $date_min->format( 'Y-m-d H:i:s' ) ) : '' ), 'date_max' => ( ! empty( $date_max ) ? get_gmt_from_date( $date_max->format( 'Y-m-d H:i:s' ) ) : '' ) ), true ) . ')</span></a>';
    	}

		/**
		 * Filter the views of the payments table
		 *
		 * @param array $views
		 *
		 */
		return apply_filters( 'slicewp_list_table_payments_views', $views );

    }

	/**
	 * Gets the payments data and sets it
	 *
	 */
	private function set_table_data() {

		//Get the start date from the filter, or set it to the default value if not present
		$date_min = ( ! empty( $_GET['date_min'] ) ? new DateTime( $_GET['date_min'] . ' 00:00:00' ) : '' );

		//Get the end date from the filter, or set it to the default value if not present
		$date_max = ( ! empty( $_GET['date_max'] ) ? new DateTime( $_GET['date_max'] . ' 23:59:59') : '' );

		$payment_args = array(
			'number'		=> $this->items_per_page,
			'offset'		=> ( $this->get_pagenum() - 1 ) * $this->items_per_page,
			'affiliate_id'	=> ( ! empty( $_GET['affiliate_id'] ) ? absint( $_GET['affiliate_id'] ) : '' ),
			'date_min'		=> ( ! empty( $date_min ) ? get_gmt_from_date( $date_min->format( 'Y-m-d H:i:s' ) ) : '' ),
			'date_max'		=> ( ! empty( $date_max ) ? get_gmt_from_date( $date_max->format( 'Y-m-d H:i:s' ) ) : '' ),
			'status'		=> ( ! empty( $_GET['payment_status'] ) ? sanitize_text_field( $_GET['payment_status'] ) : '' ),
			'search'		=> ( ! empty( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '' ),
			'orderby'		=> ( ! empty( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'id' ),
			'order'			=> ( ! empty( $_GET['order'] ) ? sanitize_text_field( $_GET['order'] ) : 'desc' )
		);
		
		$payments = slicewp_get_payments( $payment_args );
		
		if( empty( $payments ) )
			return;

		foreach( $payments as $payment ) {
			
			$row_data = $payment->to_array();
			
			/**
			 * Filter the payment row data
			 *
			 * @param array				$row_data
			 * @param SliceWP_Payment	$payment
			 *
			 */
			$row_data = apply_filters( 'slicewp_list_table_payments_row_data', $row_data, $payment );

			$this->data[] = $row_data;

		}
		
	}


	/**
	 * Returns the HTML that will be displayed in each columns
	 *
	 * @param array $item 			- data for the current row
	 * @param string $column_name 	- name of the current column
	 *
	 * @return string
	 *
	 */
	public function column_default( $item, $column_name ) {

		return isset( $item[ $column_name ] ) ? $item[ $column_name ] : '-';

	}


	/**
	 * Returns the HTML that will be displayed in the "amount" column
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 *
	 */
	public function column_amount( $item ) {

		$output = slicewp_format_amount( $item['amount'], $item['currency'] );

		return $output;

	}


	/**
	 * Returns the HTML that will be displayed in the "affiliate" column.
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 *
	 */
	public function column_affiliate( $item ) {

		$affiliate 		= slicewp_get_affiliate( absint( $item['affiliate_id'] ) );
		$affiliate_name = ( ! is_null( $affiliate ) ? slicewp_get_affiliate_name( $affiliate ) : '' );

		if ( ! is_null( $affiliate ) ) {

			$output = '<a class="slicewp-affiliate-name" href="' . esc_url( add_query_arg( array( 'page' => 'slicewp-affiliates', 'subpage' => 'edit-affiliate', 'affiliate_id' => absint( $affiliate->get( 'id' ) ) ) , admin_url( 'admin.php' ) ) ) . '">';
				$output .= '<span>' . $affiliate_name . '</span>';
			$output .= '</a>';

		} else {

			$output = __( '(inexistent affiliate)', 'slicewp' );

		}

		return $output;

	}


	/**
	 * Returns the HTML that will be displayed in the "payout_method" column
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 * 
	 */
	public function column_payout_method( $item ) {

		$payout_methods = slicewp_get_payout_methods();

		$output = ( ! empty( $payout_methods[$item['payout_method']]['label'] ) ? $payout_methods[$item['payout_method']]['label'] : $item['payout_method'] );

		return $output;

	}


	/**
	 * Returns the HTML that will be displayed in the "date_created" column
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 *
	 */
	public function column_date_created( $item ) {

		$output = slicewp_date_i18n( $item['date_created'] );

		return $output;

	}


	/**
	 * Returns the HTML that will be displayed in the "notes" column
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 *
	 */
	public function column_notes( $item ) {

		$notes_count = slicewp_get_notes( array( 'object_context' => 'payment', 'object_id' => $item['id'] ), true );

		if( empty( $notes_count ) )
			return '-';

		$output = '<span class="slicewp-notes-count">' . absint( $notes_count ) . '</span>';

		return $output;

	}
	

	/**
	 * Returns the HTML that will be displayed in the "status" column
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 *
	 */
	public function column_status( $item ) {

		$statuses = slicewp_get_payment_available_statuses();

		$output = ( ! empty( $statuses[$item['status']] ) ? '<span class="slicewp-status-pill slicewp-status-' . esc_attr( $item['status'] ) . '">' . $statuses[$item['status']] . '</span>' : '' );

		return $output;

	}


	/**
	 * Returns the HTML that will be displayed in the "actions" column
	 *
	 * @param array $item - data for the current row
	 *
	 * @return string
	 *
	 */
	public function column_actions( $item ) {

		/**
		 * Set row actions
		 *
		 */
		$row_actions = array(
			'mark_as_paid' => ( $item['status'] != 'paid' ? '<a onclick="return confirm( \'' . __( "By marking this payment as paid, its status will be changed to paid and all commissions attached to it will also be marked as paid. Are you sure you want to mark this payment as paid?", "slicewp" ) . ' \' )" href="' . wp_nonce_url( add_query_arg( array( 'slicewp_action' => 'mark_payment_as_paid', 'payment_id' => $item['id'] ) ), 'slicewp_mark_payment_as_paid', 'slicewp_token' ) . '">' . __( 'Mark as Paid', 'slicewp' ) . '</a>' : '' ),
			'delete' 	   => '<a class="slicewp-trash" onclick="return confirm( \'' . __( "Are you sure you want to delete this payment?", "slicewp" ) . ' \' )" href="' . wp_nonce_url( add_query_arg( array( 'slicewp_action' => 'delete_payment', 'payment_id' => $item['id'] ) ), 'slicewp_delete_payment', 'slicewp_token' ) . '">' . __( 'Delete', 'slicewp' ) . '</a>'
		);

		/**
		 * Filter the row actions.
		 * 
		 * @param array $row_actions
		 * @param array $item
		 * 
		 */
		$row_actions = apply_filters( 'slicewp_list_table_payments_row_actions', $row_actions, $item );

		$output  = '<div class="row-actions">';

			$output .= '<a href="' . add_query_arg( array( 'page' => 'slicewp-payouts', 'subpage' => 'review-payment', 'payment_id' => $item['id'] ) , admin_url( 'admin.php' ) ) . '" class="slicewp-button-secondary">' . __( 'View', 'slicewp' ) . '</a>';
			$output .= '<a href="#" class="slicewp-button-toggle-actions"><svg class="" height="24" width="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 12c0 1.104-.896 2-2 2s-2-.896-2-2 .896-2 2-2 2 .896 2 2zm12-2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-7 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path></svg></a>';

			$output .= '<div class="slicewp-actions-dropdown">';
			
				foreach ( $row_actions as $row_action ) {

					if ( empty( $row_action ) )
						continue;
					
					$output .= $row_action;

				}

			$output .= '</div>';

		$output .= '</div>';

		return $output;

	}


	/**
	 * HTML display when there are no items in the table
	 *
	 */
	public function no_items() {

		echo __( 'No payments found.', 'slicewp' );

	}

	/**
	 * Adds the Payments filters above the table.
	 *
	 */
	protected function extra_tablenav( $which ) {

		if ( $which == 'top' ) {

		?>
			
			<div class="slicewp-table-filters">

				<!-- Affiliate User ID -->
				<div class="slicewp-field-wrapper slicewp-field-wrapper-users-autocomplete">
					
					<?php slicewp_output_select2_user_search( array( 'id' => 'slicewp-affiliate-id', 'name' => 'affiliate_id', 'placeholder' => __( 'Select affiliate...', 'slicewp' ), 'user_type' => 'affiliate', 'value' => ( ! empty( $_GET['affiliate_id'] ) ? absint( $_GET['affiliate_id'] ) : '' ) ) ); ?>
					
				</div>

				<!-- Date Min -->
				<div class="slicewp-field-wrapper">

					<input type="text" name="date_min" class="slicewp-datepicker" autocomplete="off" placeholder="<?php echo __( 'From', 'slicewp' ); ?>" value="<?php echo ( ! empty( $_GET['date_min'] ) ? esc_attr( $_GET['date_min'] ) : '' )?>" />

				</div>

				<!-- Date Max -->
				<div class="slicewp-field-wrapper">

					<input type="text" name="date_max" class="slicewp-datepicker" autocomplete="off" placeholder="<?php echo __( 'To', 'slicewp' ); ?>" value="<?php echo ( ! empty( $_GET['date_max'] ) ? esc_attr( $_GET['date_max'] ) : '' )?>" />

				</div>

				<!-- Payment ID -->
				<input type="hidden" name="payment_id" value="<?php echo ( ! empty( $_GET['payment_id'] ) ? esc_attr( $_GET['payment_id'] ) : '' ); ?>" />

				<!-- Filter Button -->
				<input type="submit" class="slicewp-button-secondary" value="<?php echo __( 'Filter', 'slicewp' ); ?>" />

				<!-- Clear Filter -->
				<?php
				
				if ( ! empty( $_GET['payment_id'] ) )
					$clear_url = add_query_arg( array( 'page' => 'slicewp-payouts', 'subpage' => 'view-payments', 'payment_id' => esc_attr( $_GET['payment_id'] ) ), admin_url( 'admin.php' ) );
				else
					$clear_url = add_query_arg( array( 'page' => 'slicewp-payouts', 'subpage' => 'view-payments' ), admin_url( 'admin.php' ) );

				?>

				<span class="slicewp-clear-filters"><a href="<?php echo $clear_url; ?>"><?php echo __('Clear', 'slicewp') ?></a></span>

			</div>

		<?php

		}

	}

}