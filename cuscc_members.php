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
            'additem_nonce' => wp_create_nonce('add_context'),
            'delete_nonce' => wp_create_nonce('delete_context')
        ));
    }
    
    add_action('admin_enqueue_scripts', 'cuscc_member_admin_page_css_and_js');
    
    //add front page css and js
    function front_page_scripts_method(){
        //echo "Does this output to the actual page?";
       //echo plugins_url('plugin_js/cuscc_members_front_page_js.js',__FILE__);
        wp_enqueue_style('cuscc_members_front_css123', plugins_url('plugin_css/cuscc_members_front_page_css.css',__FILE__));
        wp_enqueue_script('cuscc_members_front_js123', plugins_url('plugin_js/cuscc_members_front_page_js.js',__FILE__));
        
    }

    add_action('wp_enqueue_scripts', 'front_page_scripts_method',99);
    //debug_to_console(plugins_url('plugin_css/cuscc_members_front_page_css.css',__FILE__));
    
    //delete_option('total_members');
    //total member ajax callback
    function total_member_ajax_callback(){
        //permission check for security
        if(isset($_POST['toadditem_nonce'])&&wp_verify_nonce($_POST['toadditem_nonce'], 'add_context'))
        {        
            global $wpdb;
            $post_array_url = $_POST['post_array_url'];
            $post_array_website = $_POST['post_array_website'];
            $post_array_companyname = $_POST['post_array_companyname'];
            //debug_to_console($_POST['post_array'][url]);
            $total_members = (get_option('total_members')==false)? array() : get_option('total_members');
            $this_member = (get_option($post_array_companyname)==false)? array() : get_option($post_array_companyname);
            //this_member array(0=>url,1=>companyname,2=>website)
            if(in_array($post_array_url,$total_members)){
                //already exit 
                //echo json_encode($total_members);
                
            }else{
                //new member
                array_push($total_members,$post_array_companyname);
                $json_array = array('url'=>$post_array_url,'website'=>$post_array_website,'companyname'=>$post_array_companyname);
                //$total_members[$post_array.companyname] = $post_array;
                echo json_encode($json_array);
            }
            $this_member = array($post_array_url,$post_array_companyname,$post_array_website);
            update_option($post_array_companyname,$this_member);
            update_option('total_members',$total_members);
            //must have die() otherwise return 0
            wp_die();
            
        }else{

            die(wp_verify_nonce($_POST['toadditem_nonce'],'add_context').'Permissions check failed');

        }
    }
    add_action('wp_ajax_member_ajax_callback','total_member_ajax_callback');

function member_ajax_delete_item(){
     //permission check for security
        if(isset($_POST['todelete_nonce'])&&wp_verify_nonce($_POST['todelete_nonce'], 'delete_context'))
        
        {   $delete_item = $_POST['delete_item'];
            $total_members = (get_option('total_members')==false)? array() : get_option('total_members');

            if(($key = array_search($delete_item, $total_members)) !== false) {
                unset($total_members[$key]);
                echo 'success';
                update_option('total_members',$total_members);
            }else{
                //delete item dont exist
                echo 'item doesn\'t exist';
            }
            update_option('total_members',$total_members);
            //echo $post_array;//new member image url
            wp_die();
        }else
        {die('delete Permissions check failed');}
}

add_action('wp_ajax_member_ajax_delete_item','member_ajax_delete_item');

//shortcode for lastest member
function add_shortcode_members($atts){
    $total_members = (get_option('total_members')==false)? array() : get_option('total_members');
    ob_start();
            echo '<div id="members_slide_show_container">';
            foreach($total_members as $key => $value){
              $this_item = (get_option($value)==false)? array() : get_option($value);      
              echo '<div class="members_slide_show_item_container">';
              echo '<a target="_blank" href="'.$this_item[2].'"><img src="'.$this_item[0].'" class="members_slide_show_item" data-index="'.$key.'" /></a>';
              echo '<p class="members_slide_show_item_companyname">'.$this_item[1].'</p>';
              echo '</div>';          
          
                }
            echo '</div>';
    return ob_get_clean();
}

add_shortcode('lastest_members','add_shortcode_members');
//php debuger function
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
?>
