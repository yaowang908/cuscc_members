<?php
    /**
    *Plugin Name: cuscc_members
    *Author: Yao Wang
    *Version:1.0.0
    */
    defined('ABSPATH') or die("Cannot access pages directly.");
    /*deny direct access*/
    add_action ( 'admin_menu' , 'cuscc_members_register_admin_menu_page' ); 

    function cuscc_members_register_admin_menu_page(){
        add_menu_page(
            'CUSCC Members',    //string $page_title
            'CUSCC Members',    //string $menu_title
            'manage_options',       //string $capability
            'cuscc_members',        //string $menu_slug
            'cuscc_members_display_admin_menu_page', //callback $function = ''
            ' ',                                //string $icon_url = ''
            6                                    //int $position
        );
    }
  
    //main body
    function cuscc_members_display_admin_menu_page(){
       include_once "cuscc_members_admin_panel_body.php";
    }
    
    //add admin panel css and js
    function cuscc_member_admin_page_css_and_js($hook){
        //load only on ?page=cuscc_members
        if($hook != 'toplevel_page_cuscc_members'){
            return;
        }
        wp_enqueue_style('cuscc_members_admin_page_css', plugins_url('plugin_css/cuscc_members_admin_page_css.css',__FILE__));
        wp_enqueue_script('cuscc_members_admin_page_js', plugins_url('plugin_js/cuscc_members_admin_page_js.js',__FILE__));
        //wp_enqueue_script('jquery-3.1.1.min', get_stylesheet_directory_uri() .'/child_js/jquery-3.1.1.min.js',' ',' ',true);
        //wp js API
        wp_enqueue_media();
        wp_localize_script('cuscc_members_admin_page_js','add_nonce',array(
            'security_nonce' => wp_create_nonce('nonce_context')
        ));
    }
    
    add_action('admin_enqueue_scripts', 'cuscc_member_admin_page_css_and_js');
    
    //total member ajax callback
    function total_member_ajax_callback(){
        //permission check
        if(isset($_POST['security_check'])&&wp_verify_nonce($_POST['security_sheck'],'nonce_context'))
            die('Permissions check failed');
        
        global $wpdb;
        $post_array = $_POST['post_array'];
        $total_members = (get_option('total_members')==false)? array() : get_option('total_members');
        if(in_array($post_array,$total_members)){
            //already exit 
            echo $total_members;
        }else{
            //new member
            array_push($total_members,$post_array);
            echo json_encode($total_members);
        }
        update_option('total_members',$total_members);
        //echo $post_array;//new member image url
        wp_die();
    }
    add_action('wp_ajax_member_ajax_callback','total_member_ajax_callback');

//php debuger function
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
?>
