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
<script>
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
</script>
<div class="activity__header" style="background-image: url(<?php the_post_thumbnail_url( 'full' ) ?>)">
	<div class="activity__header-inner">
		<div class="activity__header-row">
			<div class="activity__title-container">
				<h1 class="<?php echo $type ?>__title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="activity__breadcrumb-row">
			<div class="activity__breadcrumbs">
				<?php echo yoast_breadcrumb('<p class="breadcrumb"><span class="breadcrumb_info">','</span></p>',false); ?>
			</div>
		</div>
	</div>
</div>
<div class="activity__content">
	<div class="activity__content-inner">
		<div class="activity__content-row">
			<div class="activty__info-container">
				<div class="activity__info-box">
					<div class="info-box__title">
						<h3>Details</h3>
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


				</div>
			</div>
			<div class="activity__content-text">
				<!-- <h2><?php _e( 'Activity Details', 'activities' ); ?></h2> -->
				<!-- <div class="activity__excerpt"><?php the_excerpt(); ?></div> -->
				<?php the_content(); ?>
			</div>
			<div class="activity__gallery">
				<?php
				// retrieves the attachment ID from the file URL
					function pippin_get_image_id($image_url) {
						global $wpdb;
						$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
									return $attachment[0];
					};
				?>
				<p>
					<?php foreach ($activitymeta['wpcf-lg-images'] as $key => $value) : ?>
						<p><?php
						//Capire questa soluzione https://deliciousbrains.com/introducing-wp-image-processing-queue/
						$image_url = $value;
						$image_id = pippin_get_image_id($image_url);
						echo $image_id ?></p>
						<img src="<?php echo $value ?>"/>
						<?php endforeach; ?>
				</p>
			</div>

			<pre><?php var_dump($activitymeta) ?></pre>
		</div>
	</div>
</div>
<?php get_footer(); ?>
