<?php
/**
 * Affiliate account tab: Commissions
 *
 * This template can be overridden by copying it to yourtheme/slicewp/affiliate-area/affiliate-account-tab-commissions.php.
 *
 * HOWEVER, on occasion SliceWP will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility.
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Get the commissions page number.
$page_commissions = ( ! empty( $_GET['page_commissions'] ) ? absint( $_GET['page_commissions'] ) : 1 );

?>

<?php

// Verify if a Payment ID is provided
if ( ! empty( $_GET['payment_id'] ) ) {

    $payment_id = esc_attr( $_GET['payment_id'] );

    // Read the Payment
    $payment = slicewp_get_payment( $payment_id );

    // Get the Commissions IDs from the Payment
    if ( ! empty( $payment ) && $payment->get('affiliate_id') == $args['affiliate_id'] ) {

        $commission_ids = $payment->get('commission_ids');
        $commission_ids = array_map( 'trim', explode( ',', $payment->get('commission_ids') ) );

        $redirect_url = remove_query_arg( array( 'payment_id', 'page_commissions' ) );
        $redirect_url = add_query_arg( 'affiliate-account-tab', 'commissions', $redirect_url );
        echo sprintf( __( 'Showing all the commissions from Payout #%d.<br><a href="%s">View all commissions.</a><br><br>', 'slicewp' ), $payment_id, $redirect_url );

    }

}

// Prepare the commission args
$commission_args = array(
    'number'		=> 10,
    'offset'		=> ( $page_commissions - 1 ) * 10,
    'include'		=> ( ! empty ( $commission_ids ) ? $commission_ids : '' ),
    'affiliate_id'	=> $args['affiliate_id'],
    'status'		=> array( 'paid', 'unpaid' )
);

// Read the commissions and show them to the user
$commission_count 	 = slicewp_get_commissions( $commission_args, true );
$commissions 	  	 = slicewp_get_commissions( $commission_args );
$commission_types 	 = slicewp_get_commission_types();
$commission_statuses = slicewp_get_commission_available_statuses();

?>

<table>

    <tr>
        <th><?php echo __( 'ID', 'slicewp' ); ?></th>
        <th><?php echo __( 'Date', 'slicewp' ); ?></th>
        <th><?php echo __( 'Type', 'slicewp' ); ?></th>
        <th><?php echo __( 'Amount', 'slicewp' ); ?></th>
        <th><?php echo __( 'Status', 'slicewp' ); ?></th>
    <tr>

    <?php if ( empty( $commissions ) ): ?>				
        <tr>
            <td colspan="5"><?php echo __( 'You have no commissions.' , 'slicewp' ) ?></td>
        </tr>
    <?php else: ?>

        <?php foreach ( $commissions as $commission ) : ?>
            <tr>
                <td><?php echo $commission->get('id'); ?></td>
                <td><?php echo slicewp_date_i18n( $commission->get('date_created') ); ?></td>
                <td><?php echo ( ! empty( $commission_types[$commission->get('type')]['label'] ) ? $commission_types[$commission->get('type')]['label'] : $commission->get('type') ); ?></td>
                <td><?php echo slicewp_format_amount( $commission->get('amount'), slicewp_get_setting( 'active_currency', 'USD' ) ); ?></td>
                <td><?php echo ( ! empty( $commission_statuses[$commission->get('status')] ) ? $commission_statuses[$commission->get('status')] : $commission->get('status') ); ?></td>
            </tr>
        <?php endforeach; ?>

    <?php endif; ?>

</table>

<?php if ( $commission_count > 10 ): ?>

    <div class="slicewp-page-numbers-wrapper">

        <?php

            // Prepare the pagination of the table.
            $commissions_paginate_args = array(
                'base'		=> '?affiliate-account-tab=commissions%_%',
                'format'	=> '&page_commissions=%#%',
                'total'		=> ceil( $commission_count / 10 ),
                'current'	=> $page_commissions,
                'prev_next'	=> false
            );

            echo paginate_links( $commissions_paginate_args );
        
        ?>

    </div>

<?php endif; ?>