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
?>
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
      <div class="cm_slide_img_container">
          <?php if($you_have_img) :?>
                <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:100%;"/>
          <?php endif; ?>
      </div>
      
      <!--add & remove image links-->
      <p class="hide-if-no-js">
          <a class="upload-custom-img <?php if($you_have_img){ echo 'hidden'; }?>" href="<?php echo $upload_link ?>">
                <?php _e('Set custom image')?>
          </a> 
          <a class="delete-custom-img <?php if(!$your_have_img){echo 'hidden';}?>" href="#">
                <?php _e('Remove this image')?> 
          </a>
      </p>
        
      <input class="cystom-img-id" name="custom-img-id" type="hidden" value="<?php echo esc_attr($your_img_id);?>"/>
  </div>
  <div class='cm_uploaded_items cm_display_1_grid_mode hide'>
    grid mode looks like this
  </div>
</div>