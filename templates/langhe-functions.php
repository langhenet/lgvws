<?php
//PAGINAZIONE PER VIEWS// i dati per le funzioni della paginaziona sono: framework/php/function-set-avia-frontend.php
// Get the page number into wp_pagenavi
function pagenavi_paged($q) {
  if (get_query_var('paged')) {
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $q->set('paged', $paged);
  }
}
add_action('pre_get_posts', 'pagenavi_paged');

// Add a custom wp_pagenavi shortcode
function wpv_pagenavi($args, $content) {
  global $WP_Views;
  return wp_pagenavi( array('query' => $WP_Views->post_query, 'echo'=>false) );
}
add_shortcode('wpv-pagenavi', 'wpv_pagenavi');

//STLI CUSTOM TINYMCE

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
array_unshift( $buttons, 'styleselect' );
return $buttons;
}

// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
        // Define the style_formats array
        $style_formats = array(
                // Each array child is a format with it's own settings
                array(
                        'title' => 'Titolone',
                        'block' => 'h2',
                        'classes' => 'title',
                        'wrapper' => false,

                ),
                array(
                        'title' => 'Psmall',
                        'block' => 'p',
                        'classes' => 'lg-small',
                        'wrapper' => false,
                ),
                array(
                        'title' => 'P come h1',
                        'block' => 'p',
                        'classes' => 'lg-ph1',
                        'wrapper' => false,
                ),
                array(
                        'title' => 'P come h2',
                        'block' => 'p',
                        'classes' => 'lg-ph2',
                        'wrapper' => false,
                ),
                array(
                        'title' => 'P come h3',
                        'block' => 'p',
                        'classes' => 'lg-ph3',
                        'wrapper' => false,
                ),
        );
        // Insert the array, JSON ENCODED, into 'style_formats'
        $init_array['style_formats'] = json_encode( $style_formats );

        return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


//GET LANGUAGE SHORTCODE
add_shortcode('get_wpml_language_code_value', 'func_wpml_language_code_value_func');
function func_wpml_language_code_value_func() {
  $return = ICL_LANGUAGE_CODE;
  return $return;
}

//Shortcode Attività
add_shortcode( 'activities', 'lg_listactivities' );
function lg_listactivities($atts) {
  ob_start();
  $atts = shortcode_atts( array(
      'number'   => -1,
      'type' => '',
      'orderby' => 'title'
  ), $atts );

  $tax_query = array();

  if (!empty($atts['type'])) {
    $tax_query[] = array(
      'taxonomy' => 'lgactivity-type',
      'field' => 'term_id',
      'terms' => $atts['type'],
    );
  }

  $activities = new WP_Query( array(
    'post_type' => 'lgactivity',
    'posts_per_page' => $atts['number'],
    'no_found_rows' => true,
    'meta_key' => 'wpcf-lg-public',
    'meta_value' => '1',
    'meta_compare' => '=',
    'tax_query' => $tax_query,
    'order' => 'ASC',
    'orderby' => $atts['orderby'],
  ) );
  ?>
    <div class="activity__related-row">
  <?php  if ( $activities->have_posts() ) :
      while ( $activities->have_posts() ) :
          $activities->the_post();
          get_template_part( 'templates/grid', 'activities' );
      endwhile;
      wp_reset_postdata();
  endif;
  ?>
</div>
<?php
  $output = ob_get_clean();
  return $output;
}

//Shortcode POST
add_shortcode( 'articles', 'lg_listarticles' );
function lg_listarticles($atts) {
  ob_start();
  $atts = shortcode_atts( array(
      'number'   => 6,
      'category' => '',
      'tag' => '',
      'pagination' => 'true'
  ), $atts );

  //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $articles = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => $atts['number'],
    'category_name' => $atts['category'],
    'tag_id' => $atts['tag'],
    'paged' => get_query_var('paged')
  ) );
  ?>
    <div class="articles__related-row">
  <?php  if ( $articles->have_posts() ) :
      while ( $articles->have_posts() ) :
          $articles->the_post();
          get_template_part( 'templates/grid', 'posts' );
      endwhile; ?>
    </div>
    <?php
    if ( $atts['pagination'] == 'true') {
      wp_pagenavi( array( 'query' => $articles) );
    }
    wp_reset_postdata();


  endif;

  $output = ob_get_clean();
  return $output;
}

//Shortcode Business
add_shortcode( 'business', 'lg_listbusiness' );
function lg_listbusiness($atts) {
  ob_start();
  $atts = shortcode_atts( array(
      'number'   => 6,
      'type' => '',
      'custom-field' => '',
      'orderby' => 'title',
  ), $atts );

  $tax_query = array();
  $integerIDs = json_decode('[' . $atts['type'] . ']', true);

  if (!empty($atts['type'])) {
    $tax_query[] = array(
      'relation' => 'OR',
      array(
        'taxonomy' => 'lgtypes',
        'field' => 'term_id',
        'terms' => $integerIDs,
    ));
  }

  $business = new WP_Query( array(
    'post_type' => 'lgbusiness',
    'posts_per_page' => $atts['number'],
    'no_found_rows' => true,
    'meta_key' => $atts['custom-field'],
    'meta_value' => '1',
    'meta_compare' => '=',
    'tax_query' => $tax_query,
    'orderby' => $atts['orderby'],
    'order' => 'ASC'
  ) );
  ?>
    <div class="articles__related-row">
  <?php  if ( $business->have_posts() ) :
      while ( $business->have_posts() ) :
          $business->the_post();
          get_template_part( 'templates/grid', 'business' );
      endwhile; ?>
    </div>
    <?php
    //wp_pagenavi( array( 'query' => $business) );
    wp_reset_postdata();
  endif;

  $output = ob_get_clean();
  return $output;
}

//FIX MAPS
add_filter( 'avf_load_google_map_api', '__return_false' );

//SHORTCODE BREADCRUMBS
add_shortcode('lg-breadcrumbs', 'avia_breadcrumbs');

/**
 * Disable ACF on Frontend
 *
 */
function ea_disable_acf_on_frontend( $plugins ) {
	if( is_admin() )
		return $plugins;
	foreach( $plugins as $i => $plugin )
		if( 'advanced-custom-fields-pro/acf.php' == $plugin )
			unset( $plugins[$i] );
	return $plugins;
}
add_filter( 'option_active_plugins', 'ea_disable_acf_on_frontend' );


/*
 * Updates Google API Key
 * https://www.advancedcustomfields.com/resources/google-map/
 */
 function my_acf_google_map_api( $api ){
 	$api['key'] = 'AIzaSyBj1koD1ZVP71YxMZeMLzIpOPxvu4v_v0U';
 	return $api;
 }
 add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
