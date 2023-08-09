<?php
add_action( 'wp_ajax_add_bookmart', 'addbookmark' );
add_action( 'wp_ajax_nopriv_add_bookmart', 'addbookmark' );
function addbookmark() {
 $id_user=get_current_user_id();
 $id=$_POST['dataid'];
  if(is_user_logged_in())
  {
    if(!empty($id) && is_numeric($id))
    {
        global $wpdb;
        $data=$wpdb->get_results( "SELECT * FROM bookmark WHERE id_stock = $id AND user_id = $id_user");
        
        if(empty($data))
        {
            $table ='bookmark';
            $data = array('ID' => 0, 'id_stock' => $id, 'user_id'=>$id_user);
            $format = array('%d','%d','%d');
            $wpdb->insert($table,$data,$format);
            $my_id = $wpdb->insert_id;
            wp_send_json_success('Đã theo dõi thành công');
        }else{
            $id_bookmark=$data[0]->ID;
            $wpdb->delete('bookmark', array('ID' => $id_bookmark),array('%d'));
            return wp_send_json_success('Đã xóa khỏi yêu thích');
            die();  
        }
    }else{
        return wp_send_json_error('Lỗi không xác định');
        die();  
    }

  }else{
    return wp_send_json_error('Bạn chưa đăng nhập');
    die();
  }
  
}




add_action( 'wp_ajax_khuyennghi', 'khuyennghicontent' );
add_action( 'wp_ajax_nopriv_khuyennghi', 'khuyennghicontent' );
function khuyennghicontent() {
 $id_user=get_current_user_id();
 $id=$_POST['dataid'];
  if(is_user_logged_in())
  {
    if(!empty($id) && is_numeric($id))
    {
      ob_start();
      $query=new WP_Query(array('post_type'=>'khuyennghi','post__in'=>array($id)));
      if($query->have_posts()):while($query->have_posts()):$query->the_post();

        //$result = get_post_field('post_content', get_the_ID());
        //$result =  get_the_content(get_the_ID());
          the_field('phan_tich_ly_do');
      endwhile;wp_reset_query();endif;
      $result = ob_get_clean();
      
      return wp_send_json_success($result);

      die(); 
    }else{
        return wp_send_json_success('Lỗi không xác định');
        die();  
    }

  }else{
    return wp_send_json_success('Bạn chưa đăng nhập');
    die();
  }
  
}

add_action( 'wp_ajax_readnotice', 'readnotice' );
add_action( 'wp_ajax_nopriv_readnotice', 'readnotice' );
function readnotice() {
  if(is_user_logged_in())
  {
    global $wpdb;
    $user=wp_get_current_user();
    $id=$user->id;
    $wpdb->update('a2z_notice', array('readed'=>1), array('user_id'=>$id));
    return wp_send_json_success($id);
    die();
  }
  return wp_send_json_success('Bạn chưa đăng nhập');
    die();
}

add_action( 'save_post', 'sending_email_confirmation_to_user');

function sending_email_confirmation_to_user( $post_id )
{
    $checked=get_post_meta($post_id,'checked_sent',true);
    $post_status_after_update = get_post_meta( $post_id, 'thong_bao_news', true );
    $post_tile=get_the_title($post_id);
    $image=get_the_post_thumbnail_url($post_id);
    $post_type=get_post_type( $post_id );
    if( '1' === $post_status_after_update && $checked!=true){
      $data=get_users();
      foreach($data as $key)
      {
        $userid=$key->ID;
	      $data=get_user_meta($userid,'driver_update_id',true);
	      if(!empty($data)){
	      foreach($data as $key)
	        {	
            $datanotice=array('title'=>$post_tile,'image'=>$image,'post_type'=>$post_type); 
	          sendGCM($key,$datanotice);
	      }
	      }
      }
    } 

}
//add_filter('sending_notice_hs','fcmpush',10,2 );
function fcmpush($result,$item)
{
  var_dump($item);
  die();
}

?>