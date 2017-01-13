<?php
    global $post;

//get wordpress' media upload URL
    $upload_link = esc_url( get_upload_iframe_src('image', $post->ID) );
//See if there's a media id alreadu saved as post meta
    $your_img_id = get_post_meta( $post->ID,'_your_img_id',true );
// get the image src
    $your_img_src = wp_get_attachment_image_src( $your_img_id, 'full');
//for convenience, see if the array is valid
    $your_have_img = is_array( $your_img_src);
//init update_option total_members
    //delete_option('total_members');
//store member photo url
    $total_members_array = array();
    if(get_option('total_members')){
        $total_members_array = get_option('total_members');
    }else{
        
    }
    
    if($_SERVER['REQUEST_METHOD']==='POST'){
        echo 'get post info';
    }
    
//if method ===post, have total_members update
    if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['data']) )
    {//if method ===post, have total_members update
        debug_to_console('post is'.$_POST['data']);
        update_option('total_members',$_POST['data']);
        $total_members_array = get_option('total_members');
    }
    
?>
<script>
   
    total_members_in_db = <?php echo $total_members_array; ?>;  
    total_members_array = total_members_in_db;
</script>
<div class='cm_display_item' id='cm_display_1'>
  <div class='cm_select_display_mode'>
    <form action="#" method="post" >
        <input type='radio' id='cm_display_1_slide_mode' checked='checked'name='cm_display_1_mode' value='slide mode'/>
        <label name='cm_display_1_slide_mode' class='checked' for='cm_display_1_slide_mode'>slide mode</label>
        <input type='radio' id='cm_display_1_grid_mode' name='cm_display_1_mode' value='grid mode'/>
        <label name='cm_display_1_grid_mode' class='' for='cm_display_1_grid_mode'>grid mode</label>
     </form> 
  </div>
  <div class='cm_upload_holder'>
    <p>upload images</p>
    <input type='text' id='cm_display_1_add_link' name='cm_display_1_add_link' value='add image link'/>
  </div>
  <div class='cm_uploaded_items cm_display_1_slide_mode show'>
     slide mode looks like this
<?php 
      /*    use array length as the number of images
      *     init an array contain images' url
      *     foreach (images as image=>url)
      *         echo <a><img src=image=>url/></a>
      */
  ?>
    <!--image container, can be manupulated with js-->
     <button class='open-select-frame'>Open select frame</button> 
     <?php
        var_dump($total_members_array);
        foreach($total_members_array as $url){
            echo "<div class='cuscc_member_display'><img src='$url'/></div>";
        }
        
      ?>
  </div>
    
  <div class='cm_uploaded_items cm_display_1_grid_mode hide'>
    grid mode looks like this
  </div>
</div>