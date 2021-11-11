<?php
/**
 * Register Custom REST Endpoints
 *
 * @package stilts-rest-filter
 */

/** Endpoints */
class Endpoints {

	/** Construct
	 * Endpoints{} creation is already hooked to 'rest_api_init'
	 * No need to hook it again here.
	 */
	public function __construct() {
		$this->create_endpoints();
	}


	/**
	 * Create custom REST endpoints based on the inputs provided in config.json
	 *
	 * @todo Error checking if config.json is not found, or incorrectly formatted.
	 * @todo Security considerations for file_get_contents()?
	 */
	public function create_endpoints() {

		$input     = file_get_contents( STILTS_FUNC_PATH . 'config.json' );
		$config    = json_decode( $input );
		$endpoints = $config->endpoints;

		// Generate REST routes.
		foreach ( (array) $endpoints as $endpoint ) {

			register_rest_route(
				$endpoint->rest_route_name,
				'all',
				array(
					'methods'             => 'GET',
					'callback'            => 'Callbacks::' . $endpoint->callback_fn,
					'permission_callback' => '__return_true',
					'args'                => array(
						'postType'  => array( $endpoint->wp_post_type_slug ),
						'per_page'  => $endpoint->per_page,
						'queryArgs' => (array) $endpoint->query_args,
						'template'  => $endpoint->result_template,
					),
				)
			);
		}
	}
}
