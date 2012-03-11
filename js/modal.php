<?php
function SimplePopup_javascript($delay=10)
	{
?>
<script type="text/javascript">
jQuery(document).ready(function() {	

	
	jQuery('#simple-popup').click(function(e) {
		e.preventDefault();
		
		
		var id = jQuery(this).attr('href');
		var maskHeight = jQuery(document).height();
		var maskWidth = jQuery(window).width();
		jQuery('#spmask').css({'width':maskWidth,'height':maskHeight});
		jQuery('#spmask').fadeIn(1000);	
		jQuery('#spmask').fadeTo("slow",0.8);	
		var winH = jQuery(window).height();
		var winW = jQuery(window).width();
		jQuery(id).css('top',  winH/2-jQuery(id).height()/2);
		jQuery(id).css('left', winW/2-jQuery(id).width()/2);
		jQuery(id).fadeIn(400);
	
	});
	jQuery('.window .close').click(function (e) {
		e.preventDefault();
		jQuery.cookie('popup_hide','true',{path: '/'});
		jQuery('#spmask').hide();
		jQuery('.window').hide();
	});		
	
	jQuery(document).keyup(function(e) {
  	if (e.keyCode == 27) { jQuery('.window .close').click(); }
});

jQuery("#simple-popup").bind('click',function()
{
	return false;
});
if ( jQuery.cookie('popup_hide') != 'true' )
{  
	var SimplePopup_delay = setTimeout("jQuery('#simple-popup').trigger('click')",<?php echo $delay; ?>);
}
});



</script>

<?php
}
?>
