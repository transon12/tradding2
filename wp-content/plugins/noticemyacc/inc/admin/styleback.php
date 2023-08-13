<?php
include( NOTICE_URL. 'inc/admin/notice.model.php');
include( NOTICE_URL. 'inc/admin/notice.model.created.php');
Class stylebackend2
{
    function __construct() 
    {
        add_action('admin_enqueue_scripts', array($this,'cstm_css_and_js'));
        add_action('admin_menu', array($this,'create_page_notice'));
    }
    public function cstm_css_and_js() {
        wp_enqueue_style('notice_alegoft_css', plugins_url('assets/css/style.css',__FILE__ ));
        wp_enqueue_script('notice_alegoft_js', plugins_url('assets/css/notice.js',__FILE__ ));
    }
    function create_page_notice()
    {
        add_menu_page(__('Notice', 'notice_ale'), __('Notice', 'notice_ale'), 'activate_plugins', 'noticeales', array($this,'notice_process_admin'));
        add_submenu_page('noticeales', __('Notice', 'notice_ale'), __('Notice', 'notice_ale'), 'activate_plugins', 'noticeales',array($this,'notice_process_admin'));
        // add new will be described in next part
        add_submenu_page('noticeales', __('Add new', 'notice_ale'), __('Add new', 'notice_ale'), 'activate_plugins', 'notice_form', array($this,'notice_process_admin_form'));
    }
    function notice_process_admin()
    {
        global $wpdb;

    $table = new Showhienthi();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'cltd_example'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Notice', 'cltd_example')?> <a class="add-new-h2"
                                 href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=notice_form');?>"><?php _e('Add new', 'cltd_example')?></a>
    </h2>
    <?php echo $message; ?>

    <form id="Notice-table" method="GET">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php
    }
    function notice_process_admin_form()
    {
        $data=new add_notice();
    }

}

$stylebackend2 = new stylebackend2();