<?php
/*
Plugin Name: WP SimplePop
Plugin URI: http://plugistan.com/wordpress-simplepop-plus/
Description: A simple, attractive and extremly fast popup box for your WordPress Blog.
Version: 1.7
Author: Muneeb ur Rehman
License: GPL2
  	Copyright 2011  Muneeb ur Rehman

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once('js/modal.php');

if (!class_exists("SimplePopup"))
{
	class SimplePopup
		{
			
		
			function install()
				{
					
					add_option('popup_box_content',"<h1>Edit Me!</h1>",'','yes');
					add_option('popup_box_delay',"1000",'','yes');
					add_option('popup_box_border_color',"#E31B59",'','yes');
					add_option('popup_box_border_width','3px','','yes');
					add_option('popup_box_rounded_corner','true','','yes');
					add_option('popup_box_enabled','true','','yes');
					add_option('popup_box_floating','true','','yes');
					if ( is_admin() )
						require_once('sp-options.php');
				}
			function SimplePopup()
				{
					
							
					$this->install();
				}
			
		}
}
if(!function_exists('cp_sp_process_content')){
        function cp_sp_process_content($content){
                        $content = apply_filters('the_content', $content);
                	$content = str_replace(']]>', ']]&gt;', $content);
                	return $content;
                }
}
$SimplePopup = new SimplePopup();

function SimplePopup_html_mask()
		{
			include 'css.php';
				echo '<div id="spmask"></div>
						</div>';
				echo '<a id="simple-popup" name="simplepopup" href="#dialog"></a>';
				echo '<div id="boxes"><div id="dialog" class="window">';
				echo cp_sp_process_content(get_option('popup_box_content'));
				
				echo '<a class="close" href="#"></a></div></div>';
				
				
		}
	function SimplePopup_html_script()
		{
			$sp_delay = (int) get_option('popup_box_delay');
			SimplePopup_javascript($sp_delay);
		}


if ( isset($SimplePopup) && ( get_option('popup_box_enabled') =='true'  ) )
	{
		if ( !isset($_COOKIE['popup_hide']) )
			{
		
		function SimplePopup_jquery_add() {
    if (!is_admin()) {
       
       
        wp_enqueue_script( 'jquery' );
      wp_register_script('jcookie',plugins_url('js/jquery.cookie.js',__FILE__ ));
    wp_enqueue_script('jcookie');
    }
}    
	
		add_action('init', 'SimplePopup_jquery_add');
		
		
		
		
		add_action('wp_footer','SimplePopup_html_mask');
		
		add_action('wp_head','SimplePopup_html_script');
	}
}
function simplepop_offer_menu(){
	add_submenu_page( "simple-popup/sp-options.php", "WordPress SimplePop Plus", "Preimum Version", "manage_options", __FILE__, "simplepop_offer" );
}
if( is_admin() ){
	add_action('admin_menu','simplepop_offer_menu');
	function simplepop_offer(){
		include("offer.htm");
	}
}

?>
