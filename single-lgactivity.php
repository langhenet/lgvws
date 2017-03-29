<?php
	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
	 $type = get_post_type();
	 $id = get_the_ID();
	 $activitymeta = get_post_meta($id);
	 $tax = wp_get_post_terms( $id, 'lgarea' );
?>
<!-- Header -->
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
				<p class="activity__title-details">€<?php echo $activitymeta['wpcf-lgp-price'][0] ?> / <?php echo __( 'Duration', 'activities' ) .  ' ' . $activitymeta['wpcf-lg-duration'][0] . ' ' . __('hours' , 'activities') ?></p>
			</div>
		</div>
	</div>
</div>
<!-- Content -->
<div class="activity__content">
	<div class="activity__content-inner">
		<div class="activity__content-row">
			<div class="activity__content-text">
				<h2 class="activity-content__title"><?php _e('Activity Details' , 'activities') ?></h2>

				<?php the_content(); ?>

				<?php if ( !empty($activitymeta['_wpcf_belongs_lgbusiness_id'][0]) ) : ?>
					<h3 class="activity-content__title"><?php echo __('About' , 'activities') , ' ' , get_the_title( $activitymeta['_wpcf_belongs_lgbusiness_id'][0] ) ?></h3>
					<?php echo get_the_excerpt( $activitymeta['_wpcf_belongs_lgbusiness_id'][0] ) ?>
				<?php endif; ?>
			</div>
			<div class="activty__info-container">
				<div class="activity__info-box">
					<div class="info-box__title">
						<h3><?php _e('Book this activity' , 'activities') ?></h3>
					</div>
					<p class="info-box__price">€<?php echo $activitymeta['wpcf-lgp-price'][0] ?></p>
					<p class="info-box__additional-info"><?php  echo __( 'Duration:', 'activities' ) .  ' ' . $activitymeta['wpcf-lg-duration'][0] . ' ' . __('hours' , 'activities') ?></p>
					<p class="info-box__button-container">
						<a href="#" id="book-now" class="info-box__button"><?php _e('Book Now' , 'activities'); ?></a>
					</p>
					<script src="//booking.langhe.net/it/api/public"></script>
					<script>
							(function() {
									var button = new TrekkSoft.Embed.Button();
									button
												.setAttrib("target", "fancy")
												.setAttrib("entryPoint", "tour")
												.setAttrib("tourId", "<?php echo $activitymeta['wpcf-lg-trekksoft-activity'][0] ?>")
												.setAttrib("fancywidth", "95%")
												.registerOnClick("#book-now");
							})();
					</script>
					<p class="activity__trigger-question"><strong><?php _e('NOT SURE?' , 'activities'); ?></strong></p>
					<input type="checkbox" id="activity__form-trigger" class="activity__form-trigger" />
					<p class="activity__trigger-container">
						<label for="activity__form-trigger"><?php _e('ask us a question &raquo' , 'activities') ?></label>
					</p>
					<div class="activity__form-container">
						<?php gravity_form( 65, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = true, $tabindex = 1, $echo = true ); ?>
					</div>
				</div>
				<div class="activity__gallery">
					<div class="avia-gallery deactivate_avia_lazyload avia_animate_when_visible avia_start_animation">
						<div class="avia-gallery-thumb gallery-columns-2 popup-gallery">
							<?php
							// soluzione alternativa https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
							foreach ($activitymeta['wpcf-lg-images'] as $key => $value) : ?>
							<a href="<?php echo $value ?>" data-rel="gallery-<?php echo $key ?>" class="" itemprop="contentURL">
								<img src="<?php echo(types_render_field( "lg-images", array( "alt" => "<?php the_title() ?>", "size" => "portfolio", "url" => "true", "index" => $key ) )); ?>" class="activity-gallery__image">
							</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<p class="mobile-button__container">
	<a href="#" id="mobile-book-now" class="mobile__button"><?php _e('Book<br/>Now' , 'activities'); ?></a>
</p>
<script src="//booking.langhe.net/it/api/public"></script>
<script>
		(function() {
				var button = new TrekkSoft.Embed.Button();
				button
							.setAttrib("target", "fancy")
							.setAttrib("entryPoint", "tour")
							.setAttrib("tourId", "<?php echo $activitymeta['wpcf-lg-trekksoft-activity'][0] ?>")
							.setAttrib("fancywidth", "95%")
							.registerOnClick("#mobile-book-now");
		})();
</script>
<div class="activity__related">
	<div class="activity__related-inner">
		<h2 class="activity__section-title"><?php _e('Activities Nearby' , 'activities'); ?></h2>
		<div class="activity__related-row">
			<?php
				$related_activities = new WP_Query( array(
	    		'post_type' => 'lgactivity',
	    		'posts_per_page' => 6,
					'no_found_rows' => true,
					'meta_key' => 'wpcf-lg-public',
					'meta_value' => '1',
					'meta_compare' => '=',
					'tax_query' => array(
						array(
							'taxonomy' => 'lgarea',
							'field'    => 'slug',
							'terms'    => $tax[0]->slug,
						),
					),
				) );
				if ( $related_activities->have_posts() ) :
				    while ( $related_activities->have_posts() ) :
				        $related_activities->the_post();
								get_template_part( 'templates/grid', 'activities' );
				    endwhile;
						wp_reset_postdata();
				endif;
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
