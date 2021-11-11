<?php
/**
 * Callback functions for various filters/endpoints.
 *
 * As additional functions are added, might make sense to break each out into it's own file?
 *
 * @package stilts-rest-filter
 */

/** Callbacks */
class Callbacks {

	/** Construct */
	public function __construct() {
		// Not sure if we need this?
	}

	/**
	 * Standard filter callback function
	 *
	 * @param WP_Object $request -> WP request object.
	 * */
	public static function stilts_filter_standard( $request ) {

		// Access arguments associated with REST Route.
		// Defined in rest-api-endpoints.php.
		$attributes = $request->get_attributes();

		// Extract needed data.
		$args              = $attributes['args'];
		$post_type         = $args['postType'][0];
		$query_args        = $args['queryArgs'];
		$all_filter_params = $query_args['filter_parameters'];
		$output_template   = $args['template'];

		// Pagination.
		$per_page = $args['per_page'];
		$page_num = intval( $request->get_param( 'page' ) );
		$offset   = $per_page * $page_num;

		$response = '';

		// Generate WP Query arguments.
		$tax_query = array( 'relation' => 'AND' );

		foreach ( $all_filter_params as $filter_parameter ) {

			// Check URL parameter to see if it's one we filter based on.
			$param = $request->get_param( $filter_parameter->rest_parameter );

			if ( $param ) {
				// For each query term, add to $tax_query array.
				array_push(
					$tax_query,
					array(
						'taxonomy' => $filter_parameter->wp_filter_field_slug,
						'field'    => 'slug',
						'terms'    => $param,
					)
				);
			}
		}

		$wp_query_order   = 'ASC';  // default value.
		$wp_query_orderby = 'date'; // default value.

		// Run WP Query based on above data.
		global $post;
		$filtered_posts = get_posts(
			array(
				'post_type'      => $post_type,
				'posts_per_page' => $per_page,
				'offset'         => $offset,
				'tax_query'      => $tax_query,
				'order'          => $wp_query_order,
				// 'meta_query'  => $metaQuery, //includes searching ACF meta fields
				// 's'           => $search,
			)
		);

		// For each returned CPT post, output the HTML template.
		// Need to set to $post (WP global) for templates to work. Maybe there's a better way?
		foreach ( $filtered_posts as $post ) {
			ob_start();
			get_template_part( 'template-parts/' . $output_template );
			$response .= ob_get_clean();
		}

		wp_reset_query();

		return $response;
	}
}
