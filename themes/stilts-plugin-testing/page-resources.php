<?php
get_header();
?>
<style>
  .search-bar-container,
  .filter-form{
    border: 1px solid #000;
  }

</style>

<main id="primary" class="site-main">
  <div id="post-<?php the_ID(); ?>" <?php post_class('resources'); ?>>
    <div class="container">

    
      <div class="resource-filters" style="display: flex;">
        <?php get_template_part('template-parts/resources/resources-filter-sidebar'); ?>
      </div>
        
      <div class="results container">

        <div id="filterResultsContainer" class="row">
          <?php //This DIV gets overwritten with filter results ?>

          <?php
            $args = array(
              'numberposts'	=> 5,
              'post_type'		=> 'resources'
            );
            $resources = new WP_Query($args);	

            while ( $resources->have_posts() ) :
              $resources->the_post();
              get_template_part( 'template-parts/resources/resources-archive-card');
            endwhile;
          ?>
        </div> <!-- #filterResults Container -->

        <div class="load-more-container">
          <button 
            id="loadmore" 
            class="wp-block-button white" 
            onClick="loadmore()" 
            data-posttype="resources" 
            data-pagenum="1">
              LOAD MORE
          </button>
        </div> 


      </div> <!-- results -->


    </div> <!-- container -->
  </div> <!-- #post-ID -->
</main><!-- #main -->

<?php
get_footer();
