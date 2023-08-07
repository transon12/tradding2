<?php
function user_track_stock(){
    ob_start();
    global $wpdb;
    $idstock=array();
    $data=$wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id"); 
    ?> 
    <sup><?php count($data); ?></sup>
    <?php
    return ob_get_clean();
}
add_shortcode( 'user_track_stock', 'user_track_stock');

?>