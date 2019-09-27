<?php
/*
Plugin Name: HYP AI Product Recommendations
Plugin URI: https://github.com/hypericumimpex/hyp-aipr/
Description: Recommends your products to your visitors with artificial intelligence and increase sales!
Author: Divcoder
Version: 1.1.9
Author URI: https://github.com/hypericumimpex/
Domain Path: /languages
WC requires at least: 2.6.0
WC tested up to: 3.7.0
*/

if ( !function_exists( 'add_action' ) ) {
    exit;
}

//Plugin DIR URL
define( 'DCAS_URL', plugin_dir_url( __FILE__ ) );
//Plugin DIR Path
define( 'DCAS_DIR', plugin_dir_path( __FILE__ ) );

//Admin Styles
add_action( 'admin_init', 'DCAS_echo_css' );

function DCAS_echo_css() {
	//Add CSS Style for Admin Panel
   wp_enqueue_style( 'DCAS-style', DCAS_URL."admin/assets/css/style.css", array(), "1.0.0" );
}

/*
* Load Admin Settings
*/
include DCAS_DIR ."admin/index.php";

/*
* Load Functions
*/
include DCAS_DIR ."functions/DCAS-functions.php";
include DCAS_DIR ."functions/DCAS-widgets.php";
include DCAS_DIR ."functions/DCAS-shortcodes.php";

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function DCAS_language() {
  load_plugin_textdomain( 'DCAS-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

//Load Plugin Functions
add_action( 'plugins_loaded', 'DCAS_language' );

/*
* Default Options for Plugin
*/
function DCAS_activation() {

	add_option("DCAS_start","0");
	add_option("DCAS_advSettings","0");
	
	//advanced settings
	add_option("DCAS_suggestType", 1);
	add_option("DCAS_suggestTime", 2629743);
	add_option("DCAS_idLimit", 10);
	add_option("DCAS_purchProducts", 1);
	//ADDED 1.1.2
	add_option("DCAS_cartProducts", 1);
	
}

//Register Options
register_activation_hook( __FILE__, 'DCAS_activation' );

// Plugin WP-Admin Settings Text
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'DCAS_plugin_page');

function DCAS_plugin_page( $links ) {
    $links[] = '<a href="' . admin_url( 'admin.php?page=DCAS_plugin_dashboard' ) . '">' . __('Settings') . '</a>';
    $links[] = '<a target="_blank" href="https://codecanyon.net/user/divcoderplugins/portfolio">' . __('Other Plugins') . '</a>';
    return $links;
}