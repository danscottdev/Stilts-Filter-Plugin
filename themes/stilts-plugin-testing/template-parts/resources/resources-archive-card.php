<?php
  $title = get_the_title();

  $resource_types = get_field('resource_types');
  $resource_audience = get_field('resource_audience');
  $resource_link = get_field('resource_link');
  $resource_description = get_field('resource_description') ?: 'Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis';

  $resource_address = get_field('resource_address');
  $resource_phone = get_field('resource_phone');

  $term_obj_list = get_the_terms( $post->ID, 'resource-audiences' );
  $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

  // var_dump()
  // var_dump($resource_audience);

?>

<div class="resource col-12 col-md-6 col-lg-4" style="border:1px dotted #000;">
  <div class="resource-type"><strong>Resource Type:</strong> <?php echo ($resource_types->name); ?></div>
  <div class="resource-type"><strong>Resource Audience:</strong> <?php echo ($terms_string); ?></div>
  <div class="resource-type">Post: <?php the_title(); ?></div>
</div>