(function($){
    $(document).ready(function(){
        var displayedMemberAmount = $('.members_slide_show_item_container').length;
        var $container = $('#cuscc_latest_members_post');
        var $itemsContainer = $('#members_slide_show_container');
        $container.append('<div class="pagination_btn last_item_btn">&lt;</div>');
        $container.append('<div class="pagination_btn next_item_btn">&gt;</div>');
        $('head').append('<style>.pagination_btn{width:40px;height:40px;position:absolute;top:50%;margin-top:-20px;text-align:center;font-size:40px;line-height:40px;background-color:rgba(255,255,255,0.7);cursor:pointer;}.last_item_btn{left:0px;}.next_item_btn{right:0px;}</style>');
        var $lastBtn = $('#cuscc_latest_members_post .last_item_btn');
        var $nextBtn = $('#cuscc_latest_members_post .next_item_btn');
        
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
                //alert('lastBtn the end');
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
                //alert('nextBtn the end.'+'displayedMemberAmount:'+displayedMemberAmount+'itemsContainerPositionCount:'+itemsContainerPositionCount);
            }
        });
    });
})(jQuery);