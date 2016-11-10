<?php
// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
	define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
class rc_sweet_custom_dashboard {
	function __construct() {
		add_action('admin_menu', array( &$this,'rc_scd_register_menu') ); 
	} 	
	function rc_scd_register_menu() {
		add_menu_page( ' مترجم پرو پرشین', ' مترجم پرو پرشین', 8,'pro-persian', array( &$this,'rc_scd_create_dashboard') ,  plugins_url( 'images/logo.png' , __FILE__ ) );
	}	
	function rc_scd_create_dashboard() {
		include_once( 'pp-about.php'  );
	}
}
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();
?>