<?php

function resource_filter() { 
		ob_start();
		get_template_part('template-parts/resources', 'filter');
		return ob_get_clean();
	} 
	add_shortcode('resource-filter', 'resource_filter');

?>