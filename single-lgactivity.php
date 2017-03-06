<?php
	//global $avia_config;
	$type = get_post_type();
	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
 //   $cats = get_the_category();
	//	$title 	= get_the_title(); //if the blog is attached to a page use this title
	//	$t_link = get_category_link( $cats[0] );

	//if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $cats[0]->cat_name, 'link' => $t_link));

?>
<div class="activity__header">
	<div class="activity__header-inner">
		<div class="activity__header-row">
			<div class="activity__title-container">
				<h1 class="<?php echo $type ?>__title"><?php the_title(); ?></h1>
			</div>
			<div class="activity__excerpt"><?php the_excerpt(); ?></div>
			<div class="activity__breadcrumbs">
				<?php echo yoast_breadcrumb('<p class="breadcrumb"><span class="breadcrumb_info">','</span></p>',false); ?>
			</div>
		</div>
	</div>
</div>
	<div class="activity__content"><?php the_content(); ?></div>
	<div class="activity__gallery"><?php ?></div>
	<p>bitch</p>
<?php get_footer(); ?>
