<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

/*
* Menu Settings
*/
add_action( 'admin_menu', 'DCAS_menu' );

function DCAS_menu(){
    add_menu_page( __('AI Product Recommendations', 'DCAS-plugin'), __('AI Product Recommendations', 'DCAS-plugin'), 'administrator', 'DCAS_plugin_dashboard', 'DCAS_plugin_dashboard', "dashicons-feedback" );
	
	//advanced Settings Tab
	if( get_option("DCAS_advSettings") == 1) {
		add_submenu_page( 'DCAS_plugin_dashboard', __('Dashboard &lsaquo; AI Product Recommendations', 'DCAS-plugin' ), __( 'Dashboard', 'DCAS-plugin' ), 'administrator', 'DCAS_plugin_dashboard' );
	}
	
	add_submenu_page( 'DCAS_plugin_dashboard', __('Shortcode Generator &lsaquo; AI Product Recommendations', 'DCAS-plugin' ), __( 'Shortcode Generator', 'DCAS-plugin' ), 'administrator', 'DCAS_plugin_editor', 'DCAS_plugin_editor' );
	
	if( get_option("DCAS_advSettings") == 1) {
		add_submenu_page( 'DCAS_plugin_dashboard', __('Settings &lsaquo; AI Product Recommendations', 'DCAS-plugin' ), __( 'Advanced Settings', 'DCAS-plugin' ), 'administrator', 'DCAS_plugin_advSettings', 'DCAS_plugin_advSettings' );
	}	
}


/*
* Call
*/
require DCAS_DIR . 'admin/admin.php';
require DCAS_DIR . 'admin/advanced.php';
require DCAS_DIR . 'admin/editor.php';
