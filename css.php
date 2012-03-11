<?php

?>
<style>
#spmask {
  position:absolute;
  left:0;
  top:0;
  z-index:9999;
  background-color:#000;
  display:none;
}
  
#boxes .window {
  <?php if (get_option('popup_box_floating') == 'true')
      echo 'position:fixed;';
else
	  echo 'position:absolute;'; ?>
  left:0;
  top:0;
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;
  <?php if ( get_option('popup_box_rounded_corner') == 'true' )
  {?>
  	border-radius: 5px;
  	-moz-border-radius: 5px;
  	-webkit-border-radius: 5px;
  <?php } ?>
  box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
}

#boxes #dialog {
  max-width:800px; 
  height:auto;
  _width:0;
  white-space:normal;
  overflow:visible;
  padding:10px;
  background-color:#ffffff;
  border:<?php echo get_option('popup_box_border_width').'px'; ?> solid <?php echo get_option('popup_box_border_color'); ?>;
  font-family:Georgia !important;
  font-size:15px !important;
 
  
}

*html #boxes .window {
    position: absolute;
}

#boxes .window .close
{
	 
background-attachment: scroll;
background-clip: border-box;
background-color: transparent;
background-image: url(<?php echo plugins_url('images/close.png',__FILE__ ); ?> );
background-origin: padding-box;
background-position: 0% 0%;
background-repeat: no-repeat;
background-size: auto;
height: 36px;
right: -19px;
margin:0px 0px 0px 0px;
padding:0px 0px 0px 0px;
position: absolute;
top: -19px;
width: 36px;
 
}

#sp_credit_link
{
	padding:10px;
	width:auto;
	height: 36px;
	text-align:center;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	position: absolute;
	bottom: -40px;
	
 }

</style>
