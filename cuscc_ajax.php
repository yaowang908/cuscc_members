<?php
//if method ===post, have total_members update
    if($_SERVER['REQUEST_METHOD']=='POST')
    {//if method ===post, have total_members update
       echo 'post is'.$_POST['post_array'];
        //update_option('total_members',$_POST['data']);
        //$total_members_array = get_option('total_members');
    }