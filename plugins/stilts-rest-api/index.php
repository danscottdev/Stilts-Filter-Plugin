<?php
/**
 * REST API Filter + Search + Sort Plugin
 *
 * Plugin Name:       Stilts REST API
 * Version:           1.0.0
 *
 * In theory, will be easily extendable to new post types/taxonomies/metadata by simply updating config.json
 *
 * @package stilts-rest-api
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Definitions used throughout plugin.
define( 'PLUGIN_STILTS_REST_FILTER_VERSION', '1.0.0' );
define( 'STILTS_FUNC_PATH', plugin_dir_path( __FILE__ ) );


/**
 * Plugin Activation Hook
 * Doesn't really do anything, but leaving it in case we end up wanting to use it later
 */
register_activation_hook(
	__FILE__,
	function() {
		require_once STILTS_FUNC_PATH . 'init/class-activation.php';
		new Activation();
	}
);


/**
 * Launch actual filter functionality
 */
add_action(
	'init',
	function() {
		require_once STILTS_FUNC_PATH . 'class-stilts-rest-filter.php';
		new Stilts_Rest_Filter();
	}
);
