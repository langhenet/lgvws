<?php
/*
  Template Name: Business Template
  Template Post Type: lgbusiness
*/
	 get_header();
	 $type = get_post_type();
	 $id = get_the_ID();
	 $businessmeta = get_post_meta($id);
	 $area = wp_get_post_terms( $id, 'lgarea' );
	 $businesstype = wp_get_post_terms( $id, 'lgtype' );
?>
<div class="activity__header" style="background-image: url(<?php the_post_thumbnail_url( 'full' ) ?>)">
	<div class="activity__breadcrumbs-container">
		<div class="activity__breadcrumbs">
			<?php echo yoast_breadcrumb('<p class="breadcrumb"><span class="breadcrumb_info">','</span></p>',false); ?>
		</div>
	</div>
	<div class="activity__header-inner">
		<div class="activity__header-row">
			<div class="activity__title-container">
				<h1 class="<?php echo $type ?>__title"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</div>
<div class="activity__content">
	<div class="activity__content-inner">
		<div class="activity__content-row">
			<div class="activity__content-text">
				<?php the_content(); ?>
      </div>
      <div class="business__content-additional-info">
      </div>
    </div>
  </div>
</div>
<div id="book" class="business__book">
  <div class="business__book-inner">
		<div class="business__book-row">
			<div class="business__book-form">
      </div>
      <div class="business__book-tabs">
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
