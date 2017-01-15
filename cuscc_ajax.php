<?php
   
    if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['post_array']))
    {//if method ===post, have total_members update
       
        echo 'post is'.$_POST['post_array'];
        
        
   /* defined( 'ABSPATH' ) || define( 'ABSPATH', dirname(dirname(dirname(dirname(__FILE__)))).'/');
    include_once(ABSPATH.'wp-settings.php');
    include_once(ABSPATH.'wp-includes\option.php');*/
        $new_member=$_POST['post_array'];
        //may have more than one URL
        $total_members = (get_option('total_members')==false)? get_option('total_members'):array();
        //check if item exist in db
        //if not: add
        //if exixt return already exist
        if(in_array($new_member,$total_members)){
            //already exit 
            echo $total_members;
        }else{
            //new member
            array_push($total_members,$new_member);
            echo json_encode($total_members);
        }
        
        
        //update_option('total_members',$_POST['data']);
        //get_option('total_members');
    }