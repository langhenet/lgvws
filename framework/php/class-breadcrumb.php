<?php

if(!class_exists('avia_breadcrumb'))
{
	class avia_breadcrumb
	{
		var $options;

	function __construct($options = ""){

		$this->options = array( 	//change this array if you want another output scheme
		'before' => '<span class="arrow"> ',
		'after' => ' </span>',
		'delimiter' => '&raquo;'
		);

		if(is_array($options))
		{
			$this->options = array_merge($this->options, $options);
		}


		$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];

		global $post;
		echo '<p class="breadcrumb"><span class="breadcrumb_info">'.__('You are here:','avia_framework').'</span> <a href="'.get_bloginfo('url').'">';
			bloginfo('name');
			echo "</a>";
			if(!is_front_page()){echo $markup;}

			$output = $this->simple_breadcrumb_case($post);

			echo "<span class='current_crumb'>";
			if ( is_page() || is_single()) {
			the_title();
			}else{
			echo $output;
			}
			echo " </span></p>";
		}

		function simple_breadcrumb_case($der_post)
		{
			global $post;

			$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
			if (is_page()){
				 if($der_post->post_parent) {
					 $my_query = get_post($der_post->post_parent);
					 $this->simple_breadcrumb_case($my_query);
					 $link = '<a href="';
					 $link .= get_permalink($my_query->ID);
					 $link .= '">';
					 $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
					 echo $link;
				  }
			return;
			}

		if(is_single())
		{
			$category = get_the_category();
			if (is_attachment()){

				$my_query = get_post($der_post->post_parent);
				$category = get_the_category($my_query->ID);

				if(isset($category[0]))
				{
					$ID = $category[0]->cat_ID;
					$parents = get_category_parents( $ID, true, $markup, false );
					if(!is_object($parents)) echo $parents;
					previous_post_link("%link $markup");
				}

			}else{

				$postType = get_post_type();

				if($postType == 'post')
				{
					$ID = $category[0]->cat_ID;
					echo get_category_parents( $ID, true, $markup, false );
				}
				else if($postType == 'portfolio')
				{
					$terms = get_the_term_list( $post->ID, 'portfolio_entries', '', '$$$', '' );
					$terms = explode('$$$',$terms);
					echo $terms[0].$markup;

				}
			}
		return;
		}

		if(is_tax()){
			  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			  return $term->name;

		}


		if(is_category()){
			$category = get_the_category();
			$i = $category[0]->cat_ID;
			$parent = $category[0]-> category_parent;

			if($parent > 0 && $category[0]->cat_name == single_cat_title( "", false ) ){
				echo get_category_parents( $parent, true, $markup, false );
			}
		return single_cat_title( '', false );
		}


		if(is_author()){
			$curauth = get_userdatabylogin(get_query_var('author_name'));
			return "Author: ".$curauth->nickname;
		}
		if(is_tag()){ return "Tag: " . single_tag_title( '', false ); }

		if(is_404()){ return __("404 - Page not Found",'avia_framework'); }

		if(is_search()){ return __("Search",'avia_framework');}

		if(is_year()){ return get_the_time('Y'); }

		if(is_month()){
		$k_year = get_the_time('Y');
		echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
		return get_the_time('F'); }

		if(is_day() || is_time()){
		$k_year = get_the_time('Y');
		$k_month = get_the_time('m');
		$k_month_display = get_the_time('F');
		echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
		echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;

		return get_the_time('jS (l)'); }

		}

	}
}




/*-----------------------------------------------------------------------------------*/
/* avia_breadcrumbs() - Custom breadcrumb generator function  */
/*
/* Params:
/*
/* Arguments Array:
/*
/* 'separator' 			- The character to display between the breadcrumbs.
/* 'before' 			- HTML to display before the breadcrumbs.
/* 'after' 				- HTML to display after the breadcrumbs.
/* 'front_page' 		- Include the front page at the beginning of the breadcrumbs.
/* 'show_home' 			- If $show_home is set and we're not on the front page of the site, link to the home page.
/* 'echo' 				- Specify whether or not to echo the breadcrumbs. Alternative is "return".
/* 'show_posts_page'	- If a static front page is set and there is a posts page, toggle whether or not to display that page's tree.
/*
/*-----------------------------------------------------------------------------------*/



/**
 * The code below is an inspired/modified version by woothemes breadcrumb function which in turn is inspired by Justin Tadlock's Hybrid Core :)
 */


function avia_breadcrumbs( $args = array() ) {
		//ouptutta yoast!
    $langhe_breadcrumb = yoast_breadcrumb('<p class="breadcrumb"><span class="breadcrumb_info">','</span></p>',false);
   
     return $langhe_breadcrumb;

} // End avia_breadcrumbs()

/*-----------------------------------------------------------------------------------*/
/* avia_breadcrumbs_get_parents() - Retrieve the parents of the current page/post */
/*-----------------------------------------------------------------------------------*/
/**
 * Gets parent pages of any post type or taxonomy by the ID or Path.  The goal of this function is to create
 * a clear path back to home given what would normally be a "ghost" directory.  If any page matches the given
 * path, it'll be added.  But, it's also just a way to check for a hierarchy with hierarchical post types.
 *
 * @since 3.7.0
 * @param int $post_id ID of the post whose parents we want.
 * @param string $path Path of a potential parent page.
 * @return array $trail Array of parent page links.
 */
function avia_breadcrumbs_get_parents( $post_id = '', $path = '' ) {

	/* Set up an empty trail array. */
	$trail = array();

	/* If neither a post ID nor path set, return an empty array. */
	if ( empty( $post_id ) && empty( $path ) )
		return $trail;

	/* If the post ID is empty, use the path to get the ID. */
	if ( empty( $post_id ) ) {

		/* Get parent post by the path. */
		$parent_page = get_page_by_path( $path );

		/* ********************************************************************
		Modification: The above line won't get the parent page if
		the post type slug or parent page path is not the full path as required
		by get_page_by_path. By using get_page_with_title, the full parent
		trail can be obtained. This may still be buggy for page names that use
		characters or long concatenated names.
		Author: Byron Rode
		Date: 06 June 2011
		******************************************************************* */

		if( empty( $parent_page ) )
		        // search on page name (single word)
			$parent_page = get_page_by_title ( $path );

		if( empty( $parent_page ) )
			// search on page title (multiple words)
			$parent_page = get_page_by_title ( str_replace( array('-', '_'), ' ', $path ) );

		/* End Modification */

		/* If a parent post is found, set the $post_id variable to it. */
		if ( !empty( $parent_page ) )
			$post_id = $parent_page->ID;
	}

	/* If a post ID and path is set, search for a post by the given path. */
	if ( $post_id == 0 && !empty( $path ) ) {

		/* Separate post names into separate paths by '/'. */
		$path = trim( $path, '/' );
		preg_match_all( "/\/.*?\z/", $path, $matches );

		/* If matches are found for the path. */
		if ( isset( $matches ) ) {

			/* Reverse the array of matches to search for posts in the proper order. */
			$matches = array_reverse( $matches );

			/* Loop through each of the path matches. */
			foreach ( $matches as $match ) {

				/* If a match is found. */
				if ( isset( $match[0] ) ) {

					/* Get the parent post by the given path. */
					$path = str_replace( $match[0], '', $path );
					$parent_page = get_page_by_path( trim( $path, '/' ) );

					/* If a parent post is found, set the $post_id and break out of the loop. */
					if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
						$post_id = $parent_page->ID;
						break;
					}
				}
			}
		}
	}

	$parents = array();
	
	/* While there's a post ID, add the post link to the $parents array. */
	while ( $post_id ) {

		/* Get the post by ID. */
		$page = get_post( $post_id );
		
		/**
		 * Allow to translate breadcrumb trail - fixes a problem with parent page for portfolio
		 * https://kriesi.at/support/topic/parent-page-link-works-correct-but-translation-doesnt/
		 * 
		 * @used_by				config-wpml\config.php						10
		 * @since 4.5.1
		 * @param int $post_id
		 * @return int
		 */
		$translated_id = apply_filters( 'avf_breadcrumbs_get_parents', $post_id );

		/* Add the formatted post link to the array of parents. */
		$parents[]  = '<a href="' . get_permalink( $translated_id ) . '" title="' . esc_attr( get_the_title( $translated_id ) ) . '">' . get_the_title( $translated_id ) . '</a>';

		/* Set the parent post's parent to the post ID. */
		if(is_object($page))
		{
			$post_id = $page->post_parent;
		}
		else
		{
			$post_id = "";
		}
	}

	/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
	if ( ! empty( $parents ) )
	{
		$trail = array_reverse( $parents );
	}

	/* Return the trail of parent posts. */
	return $trail;

} // End avia_breadcrumbs_get_parents()

/*-----------------------------------------------------------------------------------*/
/* avia_breadcrumbs_get_term_parents() - Retrieve the parents of the current term */
/*-----------------------------------------------------------------------------------*/
/**
 * Searches for term parents of hierarchical taxonomies.  This function is similar to the WordPress
 * function get_category_parents() but handles any type of taxonomy.
 *
 * @since 3.7.0
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return array $trail Array of links to parent terms.
 */
function avia_breadcrumbs_get_term_parents( $parent_id = '', $taxonomy = '' ) {

	/* Set up some default arrays. */
	$trail = array();
	$parents = array();

	/* If no term parent ID or taxonomy is given, return an empty array. */
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $trail;

	/* While there is a parent ID, add the parent term link to the $parents array. */
	while ( $parent_id ) {

		/* Get the parent term. */
		$parent = get_term( $parent_id, $taxonomy );

		/* Add the formatted term link to the array of parent terms. */
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';

		/* Set the parent term's parent as the parent ID. */
		$parent_id = $parent->parent;
	}

	/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
	if ( !empty( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent terms. */
	return $trail;

} // End avia_breadcrumbs_get_term_parents()


/**
 * Filters the trail and removes the first entries that have the same href's and link text
 * Trail must be an array
 * 
 * @since 4.3.2
 * @param mixed|array $trail
 * @return mixed|array
 */
function avia_make_unique_breadcrumbs( $trail )
{
	if( ! is_array( $trail ) || empty( $trail ) )
	{
		return $trail;
	}
	
	$splitted = array();
	
	foreach( $trail as $key => $link ) 
	{
		$url = array();
		$text = array();
		preg_match( '/href=["\']?([^"\'>]+)["\']?/', $link, $url );
		preg_match( '/<\s*a[^>]*>([^<]*)<\s*\/\s*a\s*>/', $link, $text );
		
		$splitted[] = array( 
						'url'	=> isset( $url[1] ) ? $url[1] : '',
						'text'	=> isset( $text[1] ) ? $text[1] : $link
				);
	}
	
	$last_index = count( $trail );
	foreach( $splitted as $key => $current ) 
	{
		for( $i = $key + 1; $i < $last_index; $i++ )
		{
			$check = $splitted[ $i ];
			
			//	entry without url we do not remove - normally the last entry
			if( empty( $check['url'] ) )
			{
				continue;
			}
			
			if( ( strcasecmp( $current['url'], $check['url'] ) == 0 ) && ( strcasecmp( $current['text'], $check['text'] ) == 0 ) )
			{
				$splitted[ $key ]['delete'] = true;
				break;
			}
		}
	}
	
	$deleted = false;
	foreach( $splitted as $key => $current )
	{
		if( ! empty( $current['delete'] ) && ( true === $current['delete'] ) )
		{
			unset( $trail[ $key ] );
			$deleted = true;
		}
	}
	
	if( $deleted )
	{
		$trail = array_merge( $trail );
	}
	
	return $trail;
}
