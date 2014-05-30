<?php

    elgg_register_event_handler('init', 'system', 'theme_kPAX_init');

    function theme_kPAX_init() {
        global $CONFIG;

        elgg_unregister_menu_item('topbar', 'elgg_logo');
	    $pageHandler = 'theme_kPAX';
		elgg_register_page_handler($pageHandler,'theme_kPAX_page_handler');
		elgg_register_js('kpax_js','mod/kpax_theme_responsive/views/default/js/kpax.js','footer');
		elgg_load_js("Modernizr");
		elgg_load_js('kpax_js');
    }

    function theme_kPAX_page_handler($page){
		global $CONFIG;
		$plugin_name = 'theme_kPAX';
		$pageHandler = 'theme_kPAX';
		return true;

	}
?> 