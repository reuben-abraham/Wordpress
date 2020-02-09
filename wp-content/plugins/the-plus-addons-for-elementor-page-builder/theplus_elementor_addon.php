<?php
/*
* Plugin Name: The Plus Addons for Elementor Page Builder Lite
* Plugin URI: https://elementor.theplusaddons.com/
* Description: Biggest collection of widgets made for Elementor page builder in WordPress.
* Version: 1.1.2
* Author: POSIMYTH Themes
* Author URI: http://posimyththemes.com
* Text Domain: theplus
* Elementor tested up to: 2.3.8
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
defined( 'THEPLUS_VERSION' ) or define( 'THEPLUS_VERSION', '1.1.1' );
define( 'THEPLUS_FILE__', __FILE__ );

define( 'THEPLUS_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEPLUS_PBNAME', plugin_basename(__FILE__) );
define( 'THEPLUS_PNAME', basename( dirname(__FILE__)) );
define( 'THEPLUS_URL', plugins_url( '/', __FILE__ ) );
define( 'THEPLUS_ASSETS_URL', THEPLUS_URL . 'assets/' );
define( 'THEPLUS_INCLUDES_URL', THEPLUS_PATH . 'includes/' );
define( 'THEPLUS_PRO', 'https://elementor.theplusaddons.com/pricing/' );



/* theplus language plugins loaded */
function theplus_pluginsLoaded() {
	load_plugin_textdomain( 'theplus', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'theplus_elementor_load_notice' );
		return;
	}else{
	add_action('admin_init', 'theplus_redirect_pro_version');
	}
	// Elementor widget loader
    require( THEPLUS_PATH . 'widgets_loader.php' );
}
add_action( 'plugins_loaded', 'theplus_pluginsLoaded' );

/* theplus elementor load notice */
function theplus_elementor_load_notice() {	
	$plugin = 'elementor/elementor.php';	
	if ( theplus_elementor_activated() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) { return; }
		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
		$admin_notice = '<p>' . esc_html__( 'Something Missing : It\'s Elementor. You already installed that, Please activate Elementor, Unless The Plus Addons will not be working.', 'theplus' ) . '</p>';
		$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'theplus' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) { return; }
		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		$admin_notice = '<p>' . esc_html__( 'Something Missing : It\'s Elementor. Please install Elementor, Unless The Plus Addons will not be working.', 'theplus' ) . '</p>';
		$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'theplus' ) ) . '</p>';
	}
	echo '<div class="notice notice-error is-dismissible">'.$admin_notice.'</div>';
	
}


/**
 * Redirect to options page
 *
 * @since v1.0.0
 */
 function theplus_activate() {
    add_option('theplus_activation_redirect', true);
}
register_activation_hook(__FILE__, 'theplus_activate');

function theplus_redirect_pro_version() {
    if (get_option('theplus_activation_redirect', false)) {
        delete_option('theplus_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("admin.php?page=theplus_purchase_code");
        }
    }
}

/**
	* Elementor activated or not
*/
if ( ! function_exists( 'theplus_elementor_activated' ) ) {
	
	function theplus_elementor_activated() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();
		
		return isset( $installed_plugins[ $file_path ] );
	}
}