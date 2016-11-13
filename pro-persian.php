<?php
/*
Plugin Name: مترجم پرو استایل
Plugin URI: http://www.prostyle.ir
Description: این افزونه افزونه های بادی پرس و بی بی پرس را به فارسی ترجمه خواهد کرد 
Version: 5.2
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
function propersian_localization_code() {
	return fa_IR;
}
add_filter('locale', 'propersian_localization_code');
function propersian_load_default_textdomain() {
	$fairmo = dirname( __FILE__ ) . "/language/fa_IR.mo";
	return load_textdomain('default', $fairmo);
}
add_action('plugins_loaded','propersian_load_default_textdomain');
function bbpress_init() {
  load_plugin_textdomain( 'bbpress', false, dirname( plugin_basename( __FILE__ ) )."/language" ); 
}
add_action('plugins_loaded', 'bbpress_init');
function buddypress_init() {
  load_plugin_textdomain( 'buddypress', false, dirname( plugin_basename( __FILE__ ) )."/language" ); 
}
add_action('plugins_loaded', 'buddypress_init');
?>
