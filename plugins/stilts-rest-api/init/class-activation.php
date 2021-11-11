<?php
/**
 * Activation class for plugin, fires whenever plugin is activated.
 * Not used for anything currently, but keeping in case we want to do something later.
 *
 * @package stilts-rest-filter
 */

/** Activation */
class Activation {

	/** Constructor */
	public function __construct() {
		error_log( 'Plugin activated' );
	}
}
