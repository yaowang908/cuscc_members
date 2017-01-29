<?php
       
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
      $total_members = (get_option('total_members')==false)? array() : get_option('total_members');
  ?>
    <!--image container, can be manupulated with js-->
     <button class='open-select-frame'>Up Load Member's Logo</button> 
      <div id="members_slide_show_container">
          <!--selected images show-->
          <?php 
          
          //$this_item2 = (get_option($total_members[0])==false)? array() : get_option($total_members[0]);
          //echo $this_item2[2];
          
            foreach($total_members as $key => $value){
                $this_item = (get_option($value)==false)? array() : get_option($value);
                //$this_member[0] = url 1= companyname [2] = website
                ?>
                  <div class="members_slide_show_item_container">
                        <a target="_blank" href="<?php echo $this_item[2] ?>"><img src="<?php echo $this_item[0] ?>" class="members_slide_show_item" data-index="<?php echo $key ?>" data-companyname ="<?php echo $this_item[1] ?>" /></a>
                        <div class="members_slide_show_item_buttons hide">
                            <p class="members_slide_show_item_companyname"><?php echo $this_item[1] ?></p>
                            <button class='change_slide_show_item left'>Change Title</button>
                            <button class='delete_current_slide_show_item left'>delete</button>
                        </div>
                  </div>          
          <?php
                }
          ?>
          <div class="clear"></div>
      </div>
  </div>
    
  <div class='cm_uploaded_items cm_display_1_grid_mode hide'>
    grid mode looks like this
  </div>
</div>