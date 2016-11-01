<?php
/*
Plugin Name: مترجم انجمن و فروم
Plugin URI: http://www.prostyle.ir
Description: این افزونه افزونه های بادی پرس و بی بی پرس را به فارسی ترجمه خواهد کرد 
Version: 4.1.4
Author: تیم پرو استایل
Author URI: http://www.prostyle.ir
License : GPLv2 or Later
Contributors: Mr Shahedi
Donate link: http://prostyle.ir/pay
*/


/*  Copyright 2014-2016  Mr Shahedi (email : info@prostyle.ir)  */

// requires
require 'plugin-update-checker/plugin-update-checker.php';
$className = PucFactory::getLatestClassVersion('PucGitHubChecker');
$myUpdateChecker = new $className(
    'https://github.com/Pro-Style/propersian/',
    __FILE__,
    'master'
);
require_once ( dirname(__FILE__) .'/caption.php');
require_once ( dirname(__FILE__) .'/inc/admin/admin.php');
require_once ( dirname(__FILE__) .'/inc/theme/wp-admin-theme.php');

// fixed memory limit
function persianwordpress() {
	if ( current_user_can( 'manage_options' ) )
		@ini_set( 'memory_limit', '256M' );
}
add_action( 'admin_init', 'persianwordpress' );

// rtl wordpress
$text_direction = "rtl";

// WPLANG code
function persian_wordpress_localization_code() {
	return fa_IR;
}
add_filter('locale', 'persian_wordpress_localization_code');

function persian_wordpress_load_default_textdomain() {
	$fairmo = dirname( __FILE__ ) . "/language/fa_IR.mo";
	return load_textdomain('default', $fairmo);
}
	add_action('plugins_loaded','persian_wordpress_load_default_textdomain');
	
function persian_wordpress_load_admin_network_textdomain() {
	$fairnetwork = dirname( __FILE__ ) . "/language/admin-network-fa_IR.mo";
	return load_textdomain('default', $fairnetwork);
}
	add_action('plugins_loaded','persian_wordpress_load_admin_network_textdomain');

function persian_wordpress_load_admin_textadmin() {
	$fairadmin = dirname( __FILE__ ) . "/language/admin-fa_IR.mo";
	return load_textdomain('default', $fairadmin);
}
	add_action('plugins_loaded','persian_wordpress_load_admin_textadmin');

function bbpress_init() {
  load_plugin_textdomain( 'bbpress', false, dirname( plugin_basename( __FILE__ ) )."/language" ); 
}
add_action('plugins_loaded', 'bbpress_init');

function buddypress_init() {
  load_plugin_textdomain( 'buddypress', false, dirname( plugin_basename( __FILE__ ) )."/language" ); 
}
add_action('plugins_loaded', 'buddypress_init');

function twentyfourteen(){
    load_theme_textdomain('twentyfourteen', dirname( __FILE__ ) . '/language/twentyfourteen');
}
add_action('after_setup_theme', 'twentyfourteen');



// tinymce

add_action( "init", "tinymce_rtl_persian_wordpress_add" );

function tinymce_rtl_persian_wordpress_add() {
	if( !current_user_can ( 'edit_posts' ) && !current_user_can ( 'edit_pages' ) ) {
		return;
	}
	if( get_user_option ( 'rich_editing' ) == 'true' ) {
		add_filter( "mce_external_plugins", "tinymce_persian_wordpress_plugin" );
		add_filter( "mce_buttons", "tinymce_rtl_persian_wordpress" );
	}
}
function tinymce_rtl_persian_wordpress($buttons) {
	array_push($buttons, "separator", "ltr", "rtl");
	return $buttons;
}

function tinymce_persian_wordpress_plugin($plugin_array) {
	if (get_bloginfo('version') < 3.9) {
		$plugin_array['directionality'] = includes_url('js/tinymce/plugins/directionality/editor_plugin.js');
	} else {
		$plugin_array['directionality'] = includes_url('js/tinymce/plugins/directionality/plugin.min.js');
	}
	return $plugin_array;
}

function username_pw ($username, $raw_username, $strict)
{
	$username = wp_strip_all_tags ($raw_username);

	$username = remove_accents ($username);

	$username = preg_replace ('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);

	$username = preg_replace ('/&.+?;/', '', $username);

	if ($strict)
	{
		$settings = get_option ('wscu_settings');

		$username = preg_replace ('|[^a-z\p{Arabic}\p{Cyrillic}0-9 _.\-@]|iu', '', $username);
	}

	$username = trim ($username);

	$username = preg_replace ('|\s+|', ' ', $username);

	return $username;
}

add_filter ('sanitize_user', 'username_pw', 10, 3);
//update
add_action('admin_menu','wphidenag_pw');

function wphidenag_pw() {

remove_action( 'admin_notices', 'update_nag', 3 );

}

function zegersot_install() {
	global $wpdb;
	$zegersot_table_name = $wpdb -> prefix . "zegersot_persian";
	$zegersot_sql = "CREATE TABLE IF NOT EXISTS $zegersot_table_name (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `text1` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
	 `text2` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
      PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($zegersot_sql);
}

register_activation_hook(__FILE__, 'zegersot_install');
?>
