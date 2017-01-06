//js
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