<?php
/**
 * Affiliate account tab: Visits
 *
 * This template can be overridden by copying it to yourtheme/slicewp/affiliate-area/affiliate-account-tab-visits.php.
 *
 * HOWEVER, on occasion SliceWP will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility.
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Get the visits page number.
$page_visits = ( ! empty( $_GET['page_visits'] ) ? absint( $_GET['page_visits'] ) : 1 );

?>

<?php
        
    $visit_args = array(
        'number'		=> 10,
        'offset'		=> ( $page_visits - 1 ) * 10,
        'affiliate_id'	=> $args['affiliate_id']
    );

    $visits_count = slicewp_get_visits( array( 'affiliate_id' => $args['affiliate_id'] ), true );
    $visits       = slicewp_get_visits( $visit_args );

?>

<table>

    <tr>
        <th><?php echo __( 'ID', 'slicewp' ); ?></th>
        <th><?php echo __( 'Date', 'slicewp' ); ?></th>
        <th><?php echo __( 'Landing URL', 'slicewp' ); ?></th>
        <th><?php echo __( 'Referrer URL', 'slicewp' ); ?></th>
    <tr>
    
    <?php if ( empty( $visits ) ): ?>

        <tr>
            <td colspan="4"><?php echo __( 'You have no visits.' , 'slicewp' ); ?></td>
        </tr>

    <?php else: ?>

        <?php foreach ( $visits as $visit ) : ?>
            <tr>
                <td><?php echo $visit->get('id'); ?></td>
                <td><?php echo slicewp_date_i18n( $visit->get('date_created') ); ?></td>
                <td><?php echo $visit->get('landing_url'); ?></td>
                <td><?php echo $visit->get('referrer_url'); ?></td>
            </tr>
        <?php endforeach; ?>

    <?php endif; ?>

</table>

<?php if ( $visits_count > 10 ): ?>

    <div class="slicewp-page-numbers-wrapper">

        <?php

            // Prepare the pagination of the table.
            $visits_paginate_args = array(
                'base'		=> '?affiliate-account-tab=visits%_%',
                'format'	=> '&page_visits=%#%',
                'total'		=> ceil( $visits_count / 10 ),
                'current'	=> $page_visits,
                'prev_next'	=> false
            );

            echo paginate_links( $visits_paginate_args );
        
        ?>

    </div>

<?php endif; ?>