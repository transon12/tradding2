<?php
/**
 * Plugin Name: Notice acc
 * Plugin URI: a2ztech.vn
 * Authour: Hoàng Sơn
 * Description: Plugin
 * Version:     1.0.0
 */
define('NOTICE_URL', plugin_dir_path( __FILE__ ));
include( NOTICE_URL. 'inc/admin/styleback.php');
    Class Process_notice_update
{
     
    public function insert_notice($type_notice,$content_notice)
    {
        global $wpdb;
        $date = date('Y-m-d H:i:s');
        $user_id=get_current_user_id();
        $table_name="wp_notice";
        $default = array(
            'id' => 0,
            'user_id' => $user_id,
            'type_notice' => $type_notice,
            'order_id' => '',
            'content_notice' => $content_notice,
            'readed' => 0,
            'date_notice' => $date,
        );
        $result = $wpdb->insert($table_name, $default);
        return $result;
    }
    public function delete_notice($id)
    {
        $user_id=get_current_user_id();
        global $wpdb;
        return $wpdb->delete(
            $wpdb->prefix . 'notice',      
            ['id' => $id,'user_id'=>$user_id],                   
            ['%d','%d']);                      
    }

    public function readed($id)
    {
        $user_id=get_current_user_id();
        global $wpdb;
        $wpdb->update('wp_notice', array('readed'=>1), array('id'=>$id,'user_id'=>$user_id));
    }
   
    
}
