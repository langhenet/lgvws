<?php
	//global $avia_config;
	$type = get_post_type();
	$activitymeta = get_post_meta(get_the_ID());
	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
 //   $cats = get_the_category();
	//	$title 	= get_the_title(); //if the blog is attached to a page use this title
	//	$t_link = get_category_link( $cats[0] );

	//if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $cats[0]->cat_name, 'link' => $t_link));

?>
<!-- <script>
jQuery(function(){
        // Check the initial Position of the fixed_nav_container
        var stickyHeaderTop = jQuery('.info-box__title').offset().top;

        jQuery(window).scroll(function(){
                if( jQuery(window).scrollTop() > stickyHeaderTop + 210 ) {
                        jQuery('.info-box__title').addClass('lg-sticky');

                } else {
                        jQuery('.info-box__title').removeClass('lg-sticky');
                }
        });
  });
</script> -->
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
				<p class="activity__title-details">€<?php echo $activitymeta['wpcf-lgp-price'][0] ?> / <?php _e( 'Duration', 'activities' ); echo ' ' . $activitymeta['wpcf-lgp-price'][0] ?></p>
			</div>
		</div>
	</div>
</div>
<!-- Content -->
<div class="activity__content">
	<div class="activity__content-inner">
		<div class="activity__content-row">
			<div class="activty__info-container">
				<div class="activity__info-box">
					<div class="info-box__title">
						<h3><?php _e('Book this activity') ?></h3>
					</div>
					<p class="info-box__price">€<?php echo $activitymeta['wpcf-lgp-price'][0] ?></p>
					<p class="info-box__additional-info"><?php _e( 'Duration', 'activities' ); ?>: <?php echo $activitymeta['wpcf-lgp-price'][0] ?></p>
					<p class="info-box__button-container">
						<a href="#" id="trekksoft_2428" class="info-box__button">Book Now</a>
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
												.registerOnClick("#trekksoft_2428");
							})();
					</script>
					<p style="text-align:center; margin-top: 3em; margin-bottom:0;"><strong>NOT SURE?</strong></p>
					<input type="checkbox" id="activity__form-trigger" class="activity__form-trigger" />
					<p style="text-align:center;margin-bottom:0;">
						<label for="activity__form-trigger"><?php _e('ask us a question &raquo') ?></label>
					</p>
					<div class="activity__form-container">
						<?php gravity_form( 3, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = true, $tabindex = 1, $echo = true ); ?>
					</div>
				</div>
			</div>
			<div class="activity__content-text">
				<?php the_content(); ?>
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
			<pre><?php var_dump($activitymeta) ?></pre>
		</div>
	</div>
</div>
<?php get_footer(); ?>
