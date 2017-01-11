
(function($){
//js select display mode
    $(document).ready(function(){
          $("label").click(function(){
               //alert("in cliclk not on");
          var $this = $(this);
          var $forAttr = $this.attr('for');
              $('label').removeAttr('class'); 
              $this.attr('class','checked');
              $this.closest('.cm_display_item').find('.cm_uploaded_items').removeClass('show').addClass('hide');
              $this.closest('.cm_display_item').find('.'+$forAttr).removeClass('hide').addClass('show');
              $('input[type="radio"]').removeAttr('checked') ; 	 
              $('#'+$forAttr).attr('checked','checked');
        }); 
       
    });
    
//upload image
    $(document).ready(function(){
        $('.open-select-frame').on( 'click' , function(){
            //accepts an optional object hash to override default values
            var frame = new wp.media.view.MediaFrame.Select({
                //modal title
                title: 'Select profile background',
                
                //enable/disable multiple select
                multiple: true,
                
                //library wordpress query arguments
                library: {
                        order: 'ASC', 
                    
                        //['name','author','date','title','modified','uploadedTo','id','post__in','menuOrder']
                        orderby: 'title',
                        
                        //mime type e.g. 'image','image/jpeg'
                        type: 'image',
                    
                        //searches the attachment title
                        search: null,
                    
                        //attached to a specific post (ID)
                        uploadedTo: null
                },
                
                button:{
                        text: 'Set profile background'
                }
            });
            
            // Fires after the frame markup has been built, but not appended to the DOM.
			// @see wp.media.view.Modal.attach()
			frame.on( 'ready', function() {} );

			// Fires when the frame's $el is appended to its DOM container.
			// @see media.view.Modal.attach()
			frame.on( 'attach', function() {} );

			// Fires when the modal opens (becomes visible).
			// @see media.view.Modal.open()
			frame.on( 'open', function() {} );

			// Fires when the modal closes via the escape key.
			// @see media.view.Modal.close()
			frame.on( 'escape', function() {} );

			// Fires when the modal closes.
			// @see media.view.Modal.close()
			frame.on( 'close', function() {} );

			// Fires when a user has selected attachment(s) and clicked the select button.
			// @see media.view.MediaFrame.Post.mainInsertToolbar()
			frame.on( 'select', function() {
				var selectionCollection = frame.state().get('selection');
			} );

			// Fires when a state activates.
			frame.on( 'activate', function() {} );

			// Fires when a mode is deactivated on a region.
			frame.on( '{region}:deactivate', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:deactivate:{mode}', function() {} );

			// Fires when a region is ready for its view to be created.
			frame.on( '{region}:create', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:create:{mode}', function() {} );

			// Fires when a region is ready for its view to be rendered.
			frame.on( '{region}:render', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:render:{mode}', function() {} );

			// Fires when a new mode is activated (after it has been rendered) on a region.
			frame.on( '{region}:activate', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:activate:{mode}', function() {} );

			// Get an object representing the current state.
			frame.state();

			// Get an object representing the previous state.
			frame.lastState();

			// Open the modal.
			frame.open();
            
            console.log('inside click function');
            
        });

    });
})(jQuery);
















