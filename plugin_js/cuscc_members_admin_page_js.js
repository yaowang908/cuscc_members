//js
jQuery(document).ready(function(){
    alert("ok");
    jQuery("label").click(function(){
    console.log("clicked");
  	var $this = jQuery(this);
    $this.toggleClass("checked");
    $this.siblings("label").toggleClass("checked");
  });
});