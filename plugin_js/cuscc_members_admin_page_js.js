
(function($){
   var displayedMemberAmount = 4;
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
    var total_members_array={};
    $(document).ready(function(){
        $('.open-select-frame').on( 'click' , function(){
            //accepts an optional object hash to override default values
            var frame = new wp.media.view.MediaFrame.Select({
                //modal title
                title: 'Select profile background',
                
                //enable/disable multiple select
                multiple: false,
                
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
                        text: 'Upload member logo'
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
				var selectionCollection = frame.state().get('selection').first().toJSON();
                //url = selectionCollection.url
                var object = {};
                //selectionCollection.url selected image url       
               // object.url = selectionCollection.url;
                //object.website = selectionCollection.description;
                //object.companyname = selectionCollection.caption;
                //total_members_array.push(object);
                total_members_array.url = selectionCollection.url;;
                total_members_array.website = selectionCollection.description;
                total_members_array.companyname = selectionCollection.caption;
                console.log(total_members_array);
                
                //>>debug info
                //console.log("new member photo url is : "+total_members_array);
                //pass ajax to wp_ajax handling file url = ajaxurl
                //console.log("ajax url is : "+ajaxurl);
                //<<debug info
                
                if (total_members_array){
                    //have new added image(s)
                    //wordpress require data.action not empty otherwise return 0
                    //console.log("security nonce is "+add_nonce.security_nonce);
                    $.ajax({
                        type: "POST",
                        data: { 
                            action: 'member_ajax_callback',
                            post_array: total_members_array,
                            toadditem_nonce: add_nonce.additem_nonce
                        },
                        url: ajaxurl,
                        success: function(result){
                            //console.log("send total members update info to POST");
                            //console.log("php got ajax and send back "+result);
                            //location.reload();
                            //>>>real ajax
                            var resultToArray = $.parseJSON(result);
                            //console.log("json to array "+resultToArray.url);
                            var $companyname = resultToArray.companyname?resultToArray.companyname:"";
                            var $url = resultToArray.url?resultToArray.url:"";
                            var $website = resultToArray.website?resultToArray.website:"";
                            
                            var $items =  $('#members_slide_show_container');
                            var $itemIndex = $('.members_slide_show_item_container').length+1;
                            $items.find('.clear').remove();
                             $items.append('<div class="members_slide_show_item_container"><a href="'+$website+'" target="_blank"><img src="'+$url+'"class="members_slide_show_item" data-index="'+$itemIndex+'"/></a><div class="members_slide_show_item_buttons hide"> <button class="change_slide_show_item left">Change Title</button><button class="delete_current_slide_show_item left">delete</button></div><div class="member_company_name">'+$companyname+'</div></div>');
                            $items.append('<div class="clear"></div>');
                            displayedMemberAmount = $itemIndex;
                            slideContainerWidth = $itemIndex * 210;
                            $items.attr('width',slideContainerWidth);
                        
                        },
                        error: function (ErrorResponse) {
                            if (ErrorResponse.statusText == "OK") {
                                console.log("OK:send total members update info to POST");
                            }
                            else {
                               console.log("ErrorMsg:" + ErrorResponse.statusText);
                            }
                         }
                    });
                }
                else{
                    //dont have new image
                    
                }
                
                
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
            
            //console.log('inside click function');
            
        });

    });
    
//delete image
    //show/hide button
    $(document).ready(function(){
        $('.members_slide_show_item_container').on('mouseover',function(){
                $(this).find('.members_slide_show_item_buttons').removeClass('hide').addClass('show');                      
            }).on('mouseout',function(){
                $(this).find('.members_slide_show_item_buttons').removeClass('show').addClass('hide');   
        });
    });
    
    $(document).ready(function(){
        $('.delete_current_slide_show_item').on('click',function(){
            var delete_item = $(this).closest('.members_slide_show_item_container').find('.members_slide_show_item').attr('src');
            var delete_item_data_index = $(this).closest('.members_slide_show_item_container').find('.members_slide_show_item').attr('data-index');
             $.ajax({
                        type: "POST",
                        data: { 
                            action: 'member_ajax_delete_item',
                            delete_item: delete_item,
                            todelete_nonce: add_nonce.delete_nonce
                        },
                        url: ajaxurl,
                        success: function(result){
                            //console.log(result);
                            //location.reload();
                            $('img[data-index='+delete_item_data_index+']')
                               .closest('.members_slide_show_item_container').remove();
                        },
                        error: function (ErrorResponse) {
                            if (ErrorResponse.statusText == "OK") {
                                console.log("OK:send total members update info to POST");
                            }
                            else {
                               console.log("ErrorMsg:" + ErrorResponse.statusText);
                            }
                         }
                    });
            
        });
    });
 
//last or next image
    $(document).ready(function(){
        displayedMemberAmount = $('.members_slide_show_item_container').length;
        var $container = $('.cm_display_1_slide_mode');
        var $itemsContainer = $('#members_slide_show_container');
        $container.append('<div class="pagination_btn last_item_btn">&lt;</div>');
        $container.append('<div class="pagination_btn next_item_btn">&gt;</div>');
        $('head').append('<style>.pagination_btn{width:40px;height:40px;position:absolute;top:50%;margin-top:-20px;text-align:center;font-size:40px;line-height:40px;background-color:rgba(255,255,255,0.7);cursor:pointer;}.last_item_btn{left:0px;}.next_item_btn{right:0px;}</style>');
        var $lastBtn = $('.cm_display_1_slide_mode .last_item_btn');
        var $nextBtn = $('.cm_display_1_slide_mode .next_item_btn');
        
        //reach the end
                
        var itemsContainerPositionCount = 0;
        var $lastBtnState =0;
        var $nextBtnState = 1;
        $lastBtn.on('click',function(){
            
            if(itemsContainerPositionCount > 0 ){
                $itemsContainer.animate({left: "+=210"},1000,function(){
                    $itemsContainer.css('margin-left','+= 210');
                });
                itemsContainerPositionCount -= 1;
            }else if(itemsContainerPositionCount <= 0 && $lastBtnState){
                //alert('$lastBtn the end ');
                $itemsContainer.animate({left: "+=40"},1000,function(){
                    $itemsContainer.css('margin-left','+= 40');
                });
                $lastBtnState = 0;
            }else{
                alert('lastBtn the end');
            }
        });
        $nextBtn.on('click',function(){
           
            if((displayedMemberAmount-itemsContainerPositionCount)>4){
                $itemsContainer.animate({left: "-=210"},1000,function(){
                     $itemsContainer.css('margin-left','-= 210');
                });
                itemsContainerPositionCount +=1;
            }else if((displayedMemberAmount-itemsContainerPositionCount)==4 && $nextBtnState){
                //alert('$nextBtn the end');
                $itemsContainer.animate({left: "-=40"},1000,function(){
                     $itemsContainer.css('margin-left','-= 40');
                });
                $nextBtnState = 0;
                $lastBtnState = 1;
            }else{
                alert('nextBtn the end.'+'displayedMemberAmount:'+displayedMemberAmount+'itemsContainerPositionCount:'+itemsContainerPositionCount);
            }
        });
    });


})(jQuery);
















