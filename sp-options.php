<?php
function simplepopup_enqueue_editor() {
	wp_enqueue_script('common');
	wp_enqueue_script('jquery-affect');
	wp_admin_css('thickbox');
	wp_print_scripts('post');
	wp_print_scripts('media-upload');
	wp_print_scripts('jquery');
	wp_print_scripts('jquery-ui-core');
	wp_print_scripts('jquery-ui-tabs');
	wp_print_scripts('tiny_mce');
	wp_print_scripts('editor');
	wp_print_scripts('editor-functions');

	/* Include the link dialog functions */
	include ABSPATH . 'wp-admin/includes/internal-linking.php';
	wp_print_scripts('wplink');
	wp_print_styles('wplink');
	add_action('tiny_mce_preload_dialogs', 'wp_link_dialog');

	add_thickbox();
	wp_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
	//remove_all_filters('mce_external_plugins');
}
// create custom plugin settings menu

add_action('admin_menu', 'sp_create_menu');
global $wp_version;
if ( version_compare( $wp_version, '3.1.4', '<=' ) ){
	add_action('admin_head','simplepopup_enqueue_editor');
	add_action( 'admin_footer', 'wp_tiny_mce_preload_dialogs' );
}

function sp_create_menu() {

	//create new top-level menu
	add_menu_page('SimplePop', 'SimplePop', 'manage_options', __FILE__, 'sp_settings_page', __FILE__);

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'sp-settings-group', 'popup_box_content' );
	register_setting( 'sp-settings-group', 'popup_box_delay' );
	register_setting( 'sp-settings-group', 'popup_box_border_color' );
	register_setting('sp-settings-group','popup_box_border_width');
	register_setting('sp-settings-group','popup_box_rounded_corner');
	register_setting('sp-settings-group','popup_box_enabled');
	register_setting('sp-settings-group','popup_box_floating');
	register_setting('sp-settings-group','popup_box_visits');
}

function sp_settings_page() {
?>
<div class="wrap">
<h2>WordPress SimplePop Options</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'sp-settings-group' ); ?>
    <?php //do_settings( 'baw-settings-group' ); ?>
    <table class="form-table">
        
    	 <th scope="row">Enabled</th>
        <td>
        	<?php $popup_is_enabled = get_option('popup_box_enabled');  ?>
        	<input type="radio" name="popup_box_enabled" value="true" <?php echo ($popup_is_enabled == 'true' ? 'checked=checked' : '' )  ?>  />Yes
        	<input type="radio" name="popup_box_enabled" value="false" <?php echo ($popup_is_enabled == 'false' ? 'checked=checked' : '' )  ?> />No
        	
        </tr>
         
        <tr valign="top">
        <th scope="row">Delay Time</th>
        <td><input type="text" name="popup_box_delay" value="<?php echo get_option('popup_box_delay'); ?>" />Ms</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Floating Box</th>
        <td>
        	<?php $popup_is_floating = get_option('popup_box_floating');  ?>
        	<input type="radio" name="popup_box_floating" value="true" <?php echo ($popup_is_floating == 'true' ? 'checked=checked' : '' )  ?>  />Yes
        	<input type="radio" name="popup_box_floating" value="false" <?php echo ($popup_is_floating == 'false' ? 'checked=checked' : '' )  ?> />No
        	
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Border Color</th>
        <td><input type="color" name="popup_box_border_color" value="<?php echo get_option('popup_box_border_color'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Border Width</th>
        <td><input type="number" name="popup_box_border_width" value="<?php echo get_option('popup_box_border_width'); ?>" />eg - (11)</td>
        </tr>
        <tr valign="top">
        <th scope="col">Rounded Corners (true/false)</th>
        <td><input type="text" name="popup_box_rounded_corner" value="<?php echo get_option('popup_box_rounded_corner'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">HTML Content</th>
        <td>
        	<?php /*wp_tiny_mce(false,array('editor_selector'=> 'simple-popup-editor'));*/  ?>
        	<div id="poststuff">
	<div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" >
		
		<?php the_editor(get_option('popup_box_content')); ?>
		
		
	</div>
	<script type="text/javascript">
	
	function sp_content_save(){
		var obj = document.getElementById('popup_box_content');
		var content = document.getElementById('content');
		tinyMCE.triggerSave(0,1);
		obj.value = content.value;
	}
		
	</script>
	<textarea class="simple-popup-editor" id="popup_box_content" name="popup_box_content" style="display:none"></textarea>
</div>
        	</td>
        </tr>
        
    </table>
    
    <p class="submit">
    <input type="submit" onclick="sp_content_save()" class="button-primary"  value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>