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
       echo"
            <div class='cm_display_item' id='cm_display_1'>
  <div class='cm_select_display_mode'>
    <input type='radio' id='cm_display_1_slide_mode' checked='checked'name='cm_display_1_mode' value='slide mode'/>
    <label name='cm_display_1_slide_mode' class='checked' for='cm_display_1_slide_mode'>slide mode</label>
    <input type='radio' id='cm_display_1_grid_mode' name='cm_display_1_mode' value='grid mode'/>
    <label name='cm_display_1_grid_mode' class='' for='cm_display_1_grid_mode'>grid mode</label>
  </div>
  <div class='cm_upload_holder'>
    <p>upload images</p>
    <input type='text' id='cm_display_1_add_link' name='cm_display_1_add_link' value='add image link'/>
  </div>
  <div class='cm_uploaded_items cm_display_1_slide_mode show'>
     slide mode looks like this
  </div>
  <div class='cm_uploaded_items cm_display_1_grid_mode hide'>
    grid mode looks like this
  </div>
</div>
       ";
    }
    
    //add admin panel css and js
    function cuscc_member_admin_page_css_and_js($hook){
        //load only on ?page=cuscc_members
        if($hook != 'toplevel_page_cuscc_members'){
            return;
        }
        wp_enqueue_style('cuscc_members_admin_page_css', plugins_url('plugin_css/cuscc_members_admin_page_css.css',__FILE__));
        wp_enqueue_script('cuscc_members_admin_page_js', plugins_url('plugin_js/cuscc_members_admin_page_js.js',__FILE__));
        wp_enqueue_script('jquery-3.1.1.min', get_stylesheet_directory_uri() .'/child_js/jquery-3.1.1.min.js',' ',' ',true);
    }
    
    add_action('admin_enqueue_scripts', 'cuscc_member_admin_page_css_and_js');




//php debuger function
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
?>
