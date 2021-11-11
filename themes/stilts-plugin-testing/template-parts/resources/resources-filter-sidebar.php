<?php
  $resource_taxonomies = get_terms( array(
    'taxonomy' => 'resource-types',
    'hide_empty' => false,
  ) );

  $audience_taxonomies = get_terms( array(
    'taxonomy' => 'resource-audiences',
    'hide_empty' => false,
  ) );
?>


<?php if(!empty($audience_taxonomies)): ?>

  <form class="filter-form" style="flex-basis: 50%;">
    <h2>I am:</h2>
    <ul>

    <?php
      foreach($audience_taxonomies as $term):
    ?>

      <li>
          <input 
            type="checkbox" 
            id="<?php echo $term->slug ?>" 
            name="resource-audiences[]" 
            value="<?php echo $term->slug; ?>"
            onchange="runFilter('resources', 'resource-audiences', this.value)" >

          <label for="<?php echo $term->slug ?>">A <?php echo $term->name; ?></label>
      </li>

    <?php 
      endforeach; 
    ?>

    </ul>
  </form>

  <hr/>

<?php endif; ?>

<?php if(!empty($resource_taxonomies)): ?>

  <form class="filter-form" style="flex-basis: 50%;">
    <h2>I'm looking for:</h2>
    <ul>

			<?php
				foreach($resource_taxonomies as $term):
			?>

			<li>
					<input 
						type="checkbox" 
						id="<?php echo $term->slug ?>" 
						name="resource-types[]" 
						value="<?php echo $term->slug; ?>"
						onchange="runFilter('resources', 'resource-types', this.value)"  >
					<label for="<?php echo $term->slug ?>"><?php echo $term->name; ?>s</label>
				</li>

			<?php 
				endforeach; 
			?>
			
		</ul>
	</form>

<?php endif; ?>