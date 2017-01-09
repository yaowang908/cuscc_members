//js select display mode
jQuery(document).ready(function(){
  jQuery("label").click(function(){
  var $this = jQuery(this);
  var $forAttr = $this.attr('for');
	jQuery('label').removeAttr('class'); 
  $this.attr('class','checked');
  $this.closest('.cm_display_item').find('.cm_uploaded_items').removeClass('show').addClass('hide');
  $this.closest('.cm_display_item').find('.'+$forAttr).removeClass('hide').addClass('show');
  jQuery('input[type="radio"]').removeAttr('checked') ; 	 
  jQuery('#'+$forAttr).attr('checked','checked');
});    
});

//upload image
jQuery(document).ready(function(){
    //set all variables to be uesd un scope
    //metaBox is API of wordpress
    var   frame,
            metaBox = jQuery('#meta-box-id.postbox'), //your meta box id here
            addImgLink = metaBox.find('.upload-custom-img'),
            delImgLink = metaBox.find('.delete-custom-img'),
            imgContainer = metaBox.find('.cm_slide_img_container'),
            imgIdInput = metaBox.find('custom-img-id');
    
    //add image link
    addImgLink.on('click',function(event){
            event.preventDefault();
            //if the media frame already exists, reopen it
            if(frame){
                frame.open();
                return;
            }
            
            //create a new media frame
            frame = wp.media.frames.frame = wp.media({
                title: 'select or upload media of your chosen persuasion',
                button:{ text: 'use this media' },
                multiple: false,
                libraray:{ type:'image' },
                frame: 'post',
                state: 'insert'
            });
    
            //when an image is selected in the media frame...
            frame.on('select',function(){
                    //get media attachment detailds from the frame state
                    var attachment= frame.state().get('selection').first().toJSON();

                    //send the attachment URL to our custom image input field
                    imgContainer.append('<img src="'+attachment.url+'" alt="" style="max-width:100%"/>');

                    //send the attachment id to our hidden input
                    imgIdInput.val(attachment.id);

                    //hide the add image link
                    addImgLink.addClass('hidden');

                    //unhide the remove image link
                    delImgLink.removeClass('hidden');
                });
                //finally,open the modal on click
            frame.open();
            });

            //delete the image id from the hidden input
        imgIdInput.val('');

});















