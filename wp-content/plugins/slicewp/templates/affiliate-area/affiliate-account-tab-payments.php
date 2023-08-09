<?php
/**
 * Affiliate account tab: Payments
 *
 * This template can be overridden by copying it to yourtheme/slicewp/affiliate-area/affiliate-account-tab-payments.php.
 *
 * HOWEVER, on occasion SliceWP will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility.
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Get the payments page number.
$page_payments = ( ! empty( $_GET['page_payments'] ) ? absint( $_GET['page_payments'] ) : 1 );

?>

<?php
            
    $payments_args = array(
        'number'		=> 10,
        'offset'		=> ( $page_payments - 1 ) * 10,
        'affiliate_id'	=> $args['affiliate_id']
    );

    $payments_count   = slicewp_get_payments( array( 'affiliate_id' => $args['affiliate_id'] ), true );
    $payments 		  = slicewp_get_payments( $payments_args );
    $payment_statuses = slicewp_get_payment_available_statuses();

?>

<table>

    <tr>
        <th><?php echo __( 'ID', 'slicewp' ); ?></th>
        <th><?php echo __( 'Date', 'slicewp' ); ?></th>
        <th><?php echo __( 'Amount', 'slicewp' ); ?></th>
        <th><?php echo __( 'Status', 'slicewp' ); ?></th>
        <th><?php echo __( 'Action', 'slicewp' ); ?></th>
    <tr>
    
    <?php if ( empty( $payments ) ): ?>				

        <tr>
            <td colspan="5"><?php echo __( 'You have no payouts.' , 'slicewp' ) ?></td>
        </tr>

    <?php else: ?>

        <?php foreach ( $payments as $payment ): ?>

            <tr>
                <td><?php echo $payment->get('id'); ?></td>
                <td><?php echo slicewp_date_i18n( $payment->get('date_created') ); ?></td>
                <td><?php echo slicewp_format_amount( $payment->get('amount'), slicewp_get_setting( 'active_currency', 'USD' ) ); ?></td>
                <td><?php echo ( ! empty( $payment_statuses[$payment->get('status')] ) ? $payment_statuses[$payment->get('status')] : $payment->get('status') ); ?></td>
                <td>
                    <?php 
                
                        $redirect_url = remove_query_arg( array( 'affiliate-account-tab', 'page_commissions' ) );
                        $redirect_url = add_query_arg( array( 'affiliate-account-tab' => 'commissions', 'payment_id' => $payment->get('id') ), $redirect_url );
        
                        echo '<a href="' . esc_url( $redirect_url ) . '">' . __( 'View', 'slicewp' ) . '</a>';

                    ?>
                </td>
            </tr>
            
        <?php endforeach; ?>

    <?php endif; ?>

</table>

<?php if ( $payments_count > 10 ): ?>

    <div class="slicewp-page-numbers-wrapper">

        <?php

            // Prepare the pagination of the table.
            $payments_paginate_args = array(
                'base'		=> '?affiliate-account-tab=payments%_%',
                'format'	=> '&page_payments=%#%',
                'total'		=> ceil( $payments_count / 10 ),
                'current'	=> $page_payments,
                'prev_next'	=> false
            );

            echo paginate_links( $payments_paginate_args );

        ?>

    </div>

<?php endif; ?>