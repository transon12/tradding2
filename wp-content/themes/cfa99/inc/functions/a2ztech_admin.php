<?php 

function remove_menus(){  
    global $current_user;
    $username = $current_user->user_login;
    if ($username != 'a2ztech_admin') {
        remove_menu_page( 'themes.php' );               
        //remove_menu_page( 'plugins.php' );             
        //remove_menu_page( 'options-general.php' );      
        remove_menu_page( 'edit-comments.php' );   
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit.php?post_type=blocks' );   
        remove_menu_page( 'edit.php?post_type=acf-field-group' );   
        remove_menu_page( 'main-page-simple-jwt-login-plugin' );
        remove_menu_page( 'WP-Optimize' );
        
    }
}  
add_action( 'admin_menu', 'remove_menus' );  



