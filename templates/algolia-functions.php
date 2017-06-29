<?php

/**
 * @param array   $shared_attributes
 * @param WP_Post $post
 *
 * @return array
 */
function my_post_shared_attributes( array $shared_attributes, WP_Post $post ) {
    // Here we make sure we push the post's language data to Algolia.
    $shared_attributes['wpml'] = apply_filters( 'wpml_post_language_details', null,  $post->ID );

    return $shared_attributes;

    // Switch language before getting the permalink
    global $sitepress;
    $sitepress->switch_lang($attributes['wpml']['language_code']);
    $attributes['permalink'] = get_permalink($post);
}

// Push WPML data for both posts and searchable posts indices.
add_filter( 'algolia_post_shared_attributes', 'my_post_shared_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'my_post_shared_attributes', 10, 2 );

/**
 * @param array $settings
 *
 * @return array
 */
function my_posts_index_settings( array $settings ) {
    // We add the language code to the facets to be able to easily filter on it.
    $settings['attributesForFaceting'][] = 'wpml.language_code';

    return $settings;
}

add_filter( 'algolia_posts_index_settings', 'my_posts_index_settings' );
add_filter( 'algolia_searchable_posts_index_settings', 'my_posts_index_settings' );

add_shortcode( 'algolia-articles', 'lg_algolia_articles' );
function lg_algolia_articles($atts) { ?>
  <input type="text" id="search-box" />
    <div id="hits-container"></div>
    <div id="pagination-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@1/dist/instantsearch.min.js"></script>
    <script>
      var search = instantsearch({
        appId: 'L01F8VRZMR',
        apiKey: '08d8f3b6435adb6f6339f7320b6db9c9',
        indexName: 'wp_searchable_posts'
      });

      search.addWidget(
        instantsearch.widgets.searchBox({
          container: '#search-box',
          placeholder: 'Search for products...'
        })
      );

      search.addWidget(
        instantsearch.widgets.hits({
          container: '#hits-container',
          templates: {
            item: '{{permalink}}'
          }
        })
      );

      search.addWidget(
        instantsearch.widgets.pagination({
          container: '#pagination-container'
        })
      );

      search.start();
    </script>
  <?php
}

add_shortcode( 'algolia-alt', 'lg_algolia_alt' );
function lg_algolia_alt($atts) { ?>
  <input type="text" id="search-box" />
    <div id="hits-container"></div>
    <div id="pagination-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@1/dist/instantsearch.min.js"></script>
    <script>
      var search = instantsearch({
        appId: 'L01F8VRZMR',
        apiKey: '08d8f3b6435adb6f6339f7320b6db9c9',
        indexName: 'wp_searchable_posts',

        searchParameters: {
        //  facetingAfterDistinct: true,
          /*facetsRefinements: {
            wpml: [true]
          },*/
          facets: ['wpml.language_code']
        },
      });

      search.addWidget(
        instantsearch.widgets.searchBox({
          container: '#search-box',
          placeholder: 'Search for products...'
        })
      );

/*      search.addWidget({
        init: function(options){
          options.helper.addFacetRefinement('wpml.language_code', 'it');
        }
      });*/

      search.addWidget(
        instantsearch.widgets.hits({
          container: '#hits-container',
          templates: {
            item: '{{post_title}} #//# {{permalink}}'
          }
        })
      );

      search.addWidget(
        instantsearch.widgets.pagination({
          container: '#pagination-container'
        })
      );

      search.start();
    </script>
  <?php
}
