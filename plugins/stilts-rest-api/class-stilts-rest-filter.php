<?php
/**
 * Stilts_Rest_Filter
 * Main filter class for plugin
 *
 * - Registers API Endpoints
 * - Registers Callback functions
 * - Enqueues javascript for front-end filtering
 *
 * @package   stilts-rest-filter
 */

/** Stilts_Rest_Filter */
class Stilts_Rest_Filter {

	/** Add actions & setup */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_javascript' ) );

		$this->register_callbacks();
	}

	/** Register custom API endpoints */
	public function register_endpoints() {
		require_once STILTS_FUNC_PATH . '/endpoints/class-endpoints.php';
		new Endpoints();
	}

	/** Callback functions for various endpoints */
	public function register_callbacks() {
		require_once STILTS_FUNC_PATH . '/callbacks/class-callbacks.php';
		new Callbacks();
	}

	/** Enqueue javascript for front-end filter capability */
	public function enqueue_javascript() {
		// @todo look into re-implementing conditional loading, so JS only loads on pages that it's needed.
		wp_enqueue_script( 'rest-filter', plugin_dir_url( __FILE__ ) . '/js/filter.js', array(), 'PLUGIN_STILTS_REST_FILTER_VERSION', true );
	}

}
