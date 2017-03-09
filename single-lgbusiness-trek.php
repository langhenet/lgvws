<?php
/**
 Template Name: Treksoft
 Template Post Type: lgbusiness 
 */
	//global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
 //   $cats = get_the_category();
	//	$title 	= get_the_title(); //if the blog is attached to a page use this title
	//	$t_link = get_category_link( $cats[0] );

	//if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $cats[0]->cat_name, 'link' => $t_link));

?>

<h1 class="business__title"><?php the_title(); ?></h1>
<div class="business__breadcrumbs"><?php echo yoast_breadcrumb('<p class="breadcrumb"><span class="breadcrumb_info">','</span></p>',false); ?></div>
<div class="business__excerpt"><?php the_excerpt(); ?></div>
<div class="business__gallery"><?php ?></div>
<?php get_footer(); ?>