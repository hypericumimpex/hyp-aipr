<?php

//Remove Options for Uninstall

if( !defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) exit;

	delete_option("DCAS_start");
	delete_option("DCAS_advSettings");
	
	delete_option("DCAS_suggestType");
	delete_option("DCAS_suggestTime");
	delete_option("DCAS_idLimit");
	delete_option("DCAS_purchProducts");
	//ADDED 1.1.2
	delete_option("DCAS_cartProducts");
	
	

	//***