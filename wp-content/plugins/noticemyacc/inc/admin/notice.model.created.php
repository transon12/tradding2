<?php
Class add_notice
{
    function __construct()
    {
        $this->notice_page_process();
    }
 

    function notice_page_process()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'notice'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'id' => 0,
        'user_id' => '',
        'type_notice' => '',
        'order_id' => '',
        'content_notice' => '',
        'readed' => 0,
        'date_notice' => '',
    );

    // here we are verifying does this request is post back and have correct nonce
    if ( isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);
        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        $item_valid = true;
        if ($item_valid === true) {
            if ($item['id'] == 0) {
               if($item['user_id']==0)
               {
             
                $blogusers = get_users();
                foreach($blogusers as $key)
                {
                    $item['user_id']=$key->ID;
                    $result = $wpdb->insert($table_name, $item);
                    apply_filters('sending_notice_hs',$result,$item);
                }
               }else{
                $result = $wpdb->insert($table_name, $item);
                apply_filters('sending_notice_hs',$result,$item);
               }
                $item['id'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'cltd_example');
                  
                } else {
                    $notice = __('There was an error while saving item', 'cltd_example');
                }
            } else {
                $result = $wpdb->update($table_name, $item, array('id' => $item['id']));
                if ($result) {
                    $message = __('Item was successfully updated', 'cltd_example');
                } else {
                    $notice = __('There was an error while updating item', 'cltd_example');
                }
            }
        } else {
            // if $item_valid not true it contains error message(s)
            $notice = $item_valid;
        }
    }
    else {
        // if this is not post back we load item to edit or give new one to create
        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'cltd_example');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('notice_form_meta_box', 'Notice', array($this,'noticeformprocess'), 'noticeales', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Notice', 'cltd_example')?> <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=noticeales');?>"><?php _e('back to list', 'cltd_example')?></a>
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('noticeales', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'cltd_example')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

function noticeformprocess($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="name"><?php _e('User', 'cltd_example')?></label>
        </th>
        <?php $user = get_user_by( 'id', $item['user_id']); ?>
        <?php if(!empty($item['user_id'])){ ?>
        <td>
            <input type="hidden" name="user_id" value="<?php echo esc_attr($item['user_id']); ?>">
            <input type="text" style="width: 95%" value="<?php echo esc_attr(get_user_meta( $user->ID, 'billing_first_name', true )); ?>"
                   size="50" readonly class="code" placeholder="<?php _e('Tên khách hàng', 'cltd_example'); ?>">
        </td>
        <?php }else{
            $blogusers = get_users( array( 'role__in' => array( 'customer' ) ) );
            ?>
             <td>
            <select name="user_id">
            <option value="0">Tất cả user</option>
                <?php foreach($blogusers as $key){ ?>
    
                    <option value="<?php echo $key->ID; ?>"><?php echo $key->user_login; ?></option>
                    <?php }?>
        </select>
                </td>
            <?php }?>
    </tr>
    <input id="order_id" name="order_id" type="hidden" style="width: 95%" value="" size="50" class="code"  readonly>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('Kiểu thông báo', 'cltd_example')?></label>
        </th>
        <td>
            <?php $data_type_notice=array(0=>'Thông báo'); ?>
            <select name="type_notice">
             <?php foreach($data_type_notice as $key => $value){ ?>
                <option value="<?php echo $key; ?>" <?php if($key==$item['type_notice']){ echo 'selected'; } ?>><?php echo $value; ?></option>
                <?php } ?>   
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('Nội dung thông báo', 'cltd_example')?></label>
        </th>
        <td>
            <textarea name="content_notice"><?php echo  $item['content_notice']?></textarea>
        </td>
         </tr>
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('Trạng thái', 'cltd_example')?></label>
        </th>
        <td>
            <?php if(!empty($item['readed'])){ ?>
            <input name="readed" type="hidden" value="<?php echo  $item['readed']; ?>">
            <?php if($item['readed']==1){ ?>
                <p>Đã đọc</p>
                <?php }else{?>
                    <p>Chưa đọc</p>
            <?php }}else{ ?>
                <input name="readed" type="hidden" value="0">
                <p>Chưa đọc</p>
                <?php } ?>
        </td>
         </tr>
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('Thời gian thông báo', 'cltd_example')?></label>
        </th>
        <td>
            <?php if(!empty($item['date_notice'])){ ?>
                <input name="date_notice" type="hidden" value="<?php echo $item['date_notice']; ?>">
                <p><?php echo date('d/m/Y h:i:s',strtotime($item['date_notice'])); ?></p>
                <?php }else{ ?>
           <?php $date = date('Y-m-d H:i:s'); ?>
           <p><?php echo date('d/m/Y h:i:s',strtotime($date)); ?></p>
           <input name="date_notice" type="hidden" value="<?php echo $date; ?>">
            <?php } ?>
         </td>
            </tr>
    </tbody>
</table>
<?php
}
}