<?php
	global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
    $cats = get_the_category();
		$title 	= get_the_title(); //if the blog is attached to a page use this title
		$t_link = get_category_link( $cats[0] );
		$meta = get_post_meta( get_the_ID() );
		$image['masonry'] =   get_the_post_thumbnail_url(get_the_ID(),'masonry');

	if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $cats[0]->cat_name, 'link' => $t_link));

?>

<div class='main'>
	<div id="business-intro" class="avia-section main_color avia-section-default avia-no-shadow avia-bg-style-scroll el_before_av_section  container_wrap fullsize">
		<div class="container">
			<div class="template-page content  twelve alpha units">
				<div class="post-entry post-entry-type-lgbusiness post-entry-">
					<div class="entry-content-wrapper clearfix">
						<div class="flex_column av_one_half first el_after_av_textblock  el_before_av_one_half">
							<header class="entry-content-header">
								<h1 class="post-title entry-title business-title"><?php the_title() ?></h1>
							</header>
							<div class="small-business-contacts">
								<?php
								echo $meta['lgb-name'][0] . ', ' . $meta['wpcf-lg-address'][0] . ', ' . $meta['lgb-zip'][0] . $meta['lgb-city'][0] . ' ('  . $meta['lgb-state'][0];

								echo ') ,' . $meta['lgb-country'][0] . ' &bull; ' ?><a href="#lgb-book">
									<?php
									if ($meta['wpcf-lgb-contactform'][0] == 1) {
										_e('Request a Stay' , 'Business');
									}
									else if ($meta['wpcf-lgb-contactform'][0] == 2) {
										_e('Book a Table' , 'Business');
									}
									else if ($meta['wpcf-lgb-contactform'][0] == 3) {
										_e('Request a Visit' , 'Business');
									}
									else if ($meta['wpcf-lgb-contactform'][0] == 4) {
										_e('Contact Us' , 'Business');
									}
								?></a> &bull; Tel: <?php echo $meta['lgb-telephone'][0] ?> &bull; Fax: <?php echo $meta['lgb-fax'][0]; ?>
							</div>
							<?php if (!empty($meta['wpcf-lgbspecial-offer-title'][0])) : ?>
							<div class="avia_message_box avia-color-green avia-size-large avia-icon_select-yes avia-border-">
								<span class="avia_message_box_title"><?php _e('Special Offer' , 'Business') ?></span>
								<h3><?php echo $meta['wpcf-lgbspecial-offer-title'][0] ?></h3>
								<?php echo $meta['wpcf-lgbspecial-offer-text'][0] ?>
								<div class="avia-button-wrap avia-button-center">
									<a href="<?php echo $meta['wpcf-lgbspecial-offer-link'][0] ?>" target="new"  target="new" onClick="__gaTracker('send', 'event', 'Link SB', '<?php echo $meta['wpcf-lgbspecial-offer-link'][0] ?>');" class="avia-button  avia-icon_select-yes-left-icon avia-color-theme-color avia-size-medium avia-position-center ">
										<span class="avia_button_icon avia_button_icon_left " aria-hidden="true" data-av_icon="?" data-av_iconfont="entypo-fontello"></span><span class="avia_iconbox_title"><?php echo $meta['wpcf-lgbspecial-offer-button-text'][0] ?></span>
									</a>
								</div>
							</div>
							<?php endif; ?>
							<?php the_content(); ?>
						</div>
						<div class="flex_column av_one_half  el_after_av_one_half  avia-builder-el-last">
							<img src="<?php echo $image['masonry'] ?>" class="attachment-masonry size-masonry wp-post-image" alt="<?php the_title() ?>" />
							<?php if (!empty($meta['wpcf-lg-images'][0])) : ?>

							<div id="gallery-1" class="gallery galleryid-68005 gallery-columns-6 gallery-size-thumbnail">

								<?php foreach ($meta['wpcf-lg-images'] as $key => $value) : ?>

								<dl style="float:left" class="gallery-item">
									<dt class="gallery-icon portrait">
										<a href="<?php echo $value ?>" data-rel="gallery-<?php echo $key ?>" class="lightbox-added">
											<img width="70" height="60" src="<?php echo(types_render_field( "lg-images", array( "alt" => "<?php the_title() ?>", "size" => "thumbnail", "url" => "true", "index" => $key ) )); ?>" class="attachment-thumbnail size-thumbnail">
										</a>
									</dt>
								</dl>
							<?php endforeach;?>
							</div>
							<?php
							else :
								echo do_shortcode('[gallery link="file" columns="6"]');
							endif; ?>
							<article class="iconbox iconbox_top business-details main_color  avia-builder-el-39  avia-builder-el-no-sibling ">
								<div class="iconbox_content">
									<header class="entry-content-header">
										<a class="iconbox_icon heading-color" aria-hidden="true" data-av_icon="?" data-av_iconfont="entypo-fontello"></a>
									</header>
									<div class="iconbox_content_container lgleft lgbusinessbox" itemprop="text">
										<div class="left-col">
											<h3 class="iconbox_content_title"><?php _e('Information' , 'Business') ?></h3>
											<p>
												<strong><?php _e('Business Hours' , 'Business') ?>:</strong> <?php echo $meta['lgb-time'][0] ?><br/>
												<strong><?php _e('Closing day' , 'Business') ?>:</strong> <?php echo $meta['lgb-closing'][0] ?><br/>
												<strong><?php _e('Holidays' , 'Business') ?>:</strong> <?php echo $meta['lgb-holidays'][0] ?><br/><br/>
												<a href="mailto:<?php echo $meta['lgb-email'][0] ?>" target="new" onClick="__gaTracker('send', 'event', 'Mail SB', '<?php echo $meta['lgb-email'][0] ?>', '<?php the_title() ?>');">Email</a> |
												<a href="<?php echo $meta['lgb-url'][0] ?>" target="new" onClick="__gaTracker('send', 'event', 'Link SB', '<?php echo $meta['lgb-url'][0] ?>', '<?php the_title() ?>');"><?php _e('Website' , 'Business') ?></a><br/>
												<strong>Tel:</strong> <?php echo $meta['lgb-telephone'][0] ?><br/>
												<strong>Fax:</strong> <?php echo $meta['lgb-fax'][0] ?>
											</p>
											<?php if ( !empty($meta['lgb-rooms'][0] || !empty($meta['lgb-apartments'][0]) || !empty($meta['lgb-ov-dr-hi'][0] ))) :?>

												<h3 class="iconbox_content_title"><?php _e('Lodging' , 'Business') ?></h3>
												<p>
													<?php if (!empty($meta['lgb-rooms'][0])) : ?>
														<strong><?php _e('N. of Rooms' , 'Business') ?>:</strong> [wpv-post-field name="lgb-rooms"]<br/>
													<?php endif;

													if (!empty($meta['lgb-ov-dr-hi'][0])) : ?><strong><?php _e('Double Room' , 'Business') ?>:</strong> [wpv-post-field name="lgb-ov-dr-hi"] €<br/>
													<?php endif;
													if (!empty($meta['lgb-suite'][0])) : ?>
													[wpv-if suite="lgb-suite" evaluate="!empty($suite)"]<strong><?php _e('N. of Suites' , 'Business') ?>:</strong> [wpv-post-field name="lgb-suite"]<br/>
													<?php endif;
													if (!empty($meta['lgb-plot'][0])) : ?> <!-- HERE -->
													[wpv-if plot="lgb-plot" evluate="!empty($plot)"]<strong><?php _e('N. of tent plots' , 'Business') ?>:</strong> [wpv-post-field name="lgb-plot"]<br/>[/wpv-if]
													[wpv-if sr_hi="lgb-ov-sr-hi" evaluate="!empty($sr_hi)"]<strong><?php _e('Single Room' , 'Business') ?>:</strong> [wpv-post-field name="lgb-ov-sr-hi"] €<br/>[/wpv-if]
													[wpv-if add_bed="lgb-add-bed" evaluate="!empty($add_bed)"]<strong><?php _e('Additional Bed' , 'Business') ?>:</strong> [wpv-post-field name="lgb-add-bed"] €<br/>[/wpv-if]
													[wpv-if apartments="lgb-apartments" evaluate="!empty($apartments)"]<strong><?php _e('N. of apartments' , 'Business') ?>:</strong> [wpv-post-field name="lgb-apartments"]<br/>[/wpv-if]
												</p>
											<?php endif; ?>
											[wpv-if covers="lgb-covers" evaluate="!empty($covers)"]
												<h3 class="iconbox_content_title">[wpml-string context="Business"]Restaurant[/wpml-string]</h3>
												<p>
													<strong>[wpml-string context="Business"]N Covers[/wpml-string]:</strong> [wpv-post-field name="lgb-covers"]<br/>
													<strong>[wpml-string context="Business"]Veg Menu[/wpml-string]:</strong> [types field="lgb-veg"][/types]<br/>
													<strong>[wpml-string context="Business"]Celiac Menu[/wpml-string]:</strong> [types field="lgb-celiac"][/types]<br/>
													[wpv-if specialdish="wpcf-lgb-specialdish" evaluate="!empty($specialdish)"]<strong>[wpml-string context="Business"]Special Dish[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-specialdish"]<br/>[/wpv-if]
													[wpv-if menu="lgb-menu" evaluate="!empty($menu)"]<strong>[wpml-string context="Business"]Tasting Menu:[/wpml-string]</strong> [wpv-post-field name="lgb-menu"] €<br/>[/wpv-if]
													[wpv-if glass="wpcf-lgb-vinob" evaluate="!empty($glass)"]<strong>[wpml-string context="Business"]Glass of wine[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-vinob"] €<br/>[/wpv-if]
												</p>
											[/wpv-if]
											[wpv-if vineyards="wpcf-lgb-vineyards" wines="wpcf-lgb-wines" bottles="wpcf-lgb-bottles" evaluate="!empty($vineyards)OR !empty($wines) OR !empty($bottles)"]
												<h3 class="iconbox_content_title">[wpml-string context="Business"]Cellar[/wpml-string]</h3>
												<p>
													<strong>[wpml-string context="Business"]Vineyards[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-vineyards"] ha<br/>
													<strong>[wpml-string context="Business"]Wines[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-wines"]<br/>
													<strong>[wpml-string context="Business"]Bottles[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-bottles"]<br/>
													<strong>[wpml-string context="Business"]Vineyards location[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-vines"]<br/>
													<strong>[wpml-string context="Business"]Method[/wpml-string]:</strong> [wpv-post-field name="wpcf-lgb-method"]<br/>
													<strong>[wpml-string context="Business"]Biologic Method[/wpml-string]:</strong> [types field="lgb-bio" state="checked"][wpml-string context="Business"]Yes[/wpml-string][/types][types field="lgb-bio" state="unchecked"]No[/types]<br/>
												</p>
											[/wpv-if]
										</div>
										<div class="right-col">
                    	<h3 class="iconbox_content_title">[wpml-string context="Business"]Services[/wpml-string]</h3>
											[types field="lgb-shopping" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-shopping.png"><br/><span class="small-business-info">On-line<br/>Shopping</span></div>[/types]
											[types field="lgb-dsales" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-dsales.png"><br/><span class="small-business-info">Direct<br/>Sales</span></div>[/types]
											[types field="lgb-access" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-access.png"><br/><span class="small-business-info">Accessible<br/> </span></div>[/types]
											[types field="lgb-animals" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-animals.png"><br/><span class="small-business-info">Animal<br/>Friendly</span></div>[/types]
											[types field="lgb-aircond" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-aircond.png"><br/><span class="small-business-info">Air<br/>Cond</span></div>[/types]
											[types field="lgb-parking" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-parking.png"><br/><span class="small-business-info">Parking<br/> </span></div>[/types]
											[types field="lgb-terrace" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-terrace.png"><br/><span class="small-business-info">Terrace<br/> </span></div>[/types]
											[types field="lgb-meeting" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-meeting.png"><br/><span class="small-business-info">Meeting<br/>Room</span></div>[/types][types field="lgb-meeting" state="unchecked"][/types]
											<h3 class="iconbox_content_title">Pagamenti</h3>
											[types field="lgb-cartasi" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-cartasi.png">[/types]
											[types field="lgb-atm" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-atm.png">[/types]
											[types field="lgb-visa" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-visa.png">[/types]
											[types field="lgb-americanexp" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-americanexp.png">[/types]
											[types field="lgb-diners" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-diners.png">[/types]
											[types field="lgb-masercard" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-mastercard.png">[/types]
											[types field="lgb-paypal" state="checked"]<img width="50px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-paypal.png">[/types][types field="lgb-paypal" state="unchecked"][/types]
										</div>[/wpv-noautop]
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="lgb-book" class="avia-section socket_color avia-section-default avia-no-shadow avia-bg-style-scroll  el_after_av_textblock  el_before_av_section  container_wrap fullsize">
		<div class="container">
			<div class="template-page content  twelve alpha units">
				<div class="post-entry post-entry-type-lgbusiness post-entry-">
					<div class="business__booking-container">
						[wpv-if form="wpcf-lgb-contactform" evaluate="$form = 1"]
							<div class="business__booking-title">
								<h2 class="title">[wpml-string context="Business"]Request a Stay[/wpml-string]</h2>
							</div>
							<div class="business__booking-column">
								<p>[wpml-string context="Business"]Use the module below to request a stay in[/wpml-string] [wpv-post-title]</p>
								[types field="lgb-contactform"][/types]
							</div>
						[/wpv-if]
						[wpv-if form="wpcf-lgb-contactform" evaluate="$form = 2"]
							<div class="business__booking-title">
								<h2 class="title">[wpml-string context="Business"]Book a Table[/wpml-string]</h2>
							</div>
							<div class="business__booking-column">
								<p>[wpml-string context="Business"]Use the module below to request a table at[/wpml-string] [wpv-post-title]</p>
								[types field="lgb-contactform"][/types]
							</div>
						[/wpv-if]
						[wpv-if form="wpcf-lgb-contactform" evaluate="$form = 3"]
							<div class="business__booking-title">
								<h2 class="title">[wpml-string context="Business"]Request a visit[/wpml-string]</h2>
							</div>
							<div class="business__booking-column">
								<p>[wpml-string context="Business"]Use the module below to request a visit at[/wpml-string] [wpv-post-title]</p>
								[types field="lgb-contactform"][/types]
							</div>
						[/wpv-if]
						[wpv-if form="wpcf-lgb-contactform" evaluate="$form = 4"]
							<div class="business__booking-title">
								<h2 class="title">[wpml-string context="Business"]Contact Us[/wpml-string]</h2>
							</div>
							<div class="business__booking-column">
								<p>[wpml-string context="Business"]Use the module below to send a message to[/wpml-string] [wpv-post-title]</p>
								[types field="lgb-contactform"][/types]
							</div>
						[/wpv-if]
	          [wpv-if form="wpcf-lgb-contactform" evaluate="$form = 5"]
							<div class="business__booking-title">
								<h2 class="title">[wpml-string context="Business"]Contact Us[/wpml-string]</h2>
							</div>
							<!-- <iframe width="100%" height="600px" src="//booking.langhe.net/it/widget/tours/list?referral=LANGHE&tourGroupId=[types field="lg-trekksoft-activity-overview"][/types]" style="magin: 0 auto;"></iframe> -->
	            <div class="business__booking-column">
	            <iframe class="business_booking-form" width="100%" height="100%" src="//booking.langhe.net/it/widget/activity/book/[types field="lg-trekksoft-activity"][/types]"></iframe>

	            </div>
	          [/wpv-if]
						<div class="business__booking-column">
							<div class="tabcontainer  top_tab">
									<section class="av_tab_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
										<div data-fake-id="#tab-id-1" class="tab active_tab" itemprop="headline">[wpv-post-field name="wpcf-lgb-tab1title"]</div>
										<div id="tab-id-1-container" class="tab_content active_tab_content">
											<div class="tab_inner_content invers-color" itemprop="text">
	                                          	[types field="lgb-tab1txt"][/types]
											</div>
										</div>
									</section>
									[wpv-if tab2title="wpcf-lgb-tab2title" evaluate="!empty($tab2title)"]<section class="av_tab_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
										<div data-fake-id="#tab-id-2" class="tab" itemprop="headline">[wpv-post-field name="wpcf-lgb-tab2title"]</div>
										<div id="tab-id-2-container" class="tab_content ">
											<div class="tab_inner_content invers-color" itemprop="text">
												[wpv-post-field name="wpcf-lgb-tab2txt"]
											</div>
										</div>
									</section>
									[/wpv-if]
									<section class="av_tab_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
										<div data-fake-id="#tab-id-3" class="tab" itemprop="headline">[wpml-string context="Business"]Contacts[/wpml-string]</div>
										<div id="tab-id-3-container" class="tab_content ">
											<div class="tab_inner_content invers-color" itemprop="text">
												[wpv-noautop]<h3>[wpv-post-field name="lgb-name"]</h3>
													<p><strong>[wpml-string context="Business"]Address[/wpml-string]:</strong> [wpv-post-field name="wpcf-lg-address"], [wpv-post-field name="lgb-zip"] [wpv-post-field name="lgb-city"] ([wpv-post-field name="lgb-state"]), [wpv-post-field name="lgb-country"]<br/><br/>
													<strong>[wpml-string context="Business"]Business Hours[/wpml-string]:</strong> [wpv-post-field name="lgb-time"]<br/>
													<strong>[wpml-string context="Business"]Closing Day[/wpml-string]:</strong> [wpv-post-field name="lgb-closing"]<br/>
													<strong>[wpml-string context="Business"]Holidays[/wpml-string]:</strong> [wpv-post-field name="lgb-holidays"]<br/><br/>
													<a href="mailto:[wpv-post-field name="lgb-email"]">Email</a> | <a href="http://[wpv-post-field name="lgb-url"]">[wpml-string context="Business"]Website[/wpml-string]</a><br/>
													<strong>Tel:</strong> [wpv-post-field name="lgb-telephone"]<br/>
													<strong>Fax:</strong> [wpv-post-field name="lgb-fax"]</p>
											[/wpv-noautop]</div>
										</div>
									</section>
								<section class="av_tab_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
									<div data-fake-id="#tab-id-4" class="tab" itemprop="headline">[wpml-string context="Business"]Services[/wpml-string]</div>
									<div id="tab-id-4-container" class="tab_content">
										<div class="tab_inner_content invers-color" itemprop="text">[wpv-noautop]
												<h3>Servizi</h3>
											[types field="lgb-shopping" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-shopping.png">	<span class="small-business-info">On-line<br/>Shopping</span></div>[/types][types field="lgb-dsales" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-dsales.png"><span class="small-business-info">Direct <br/>Sales</span></div>[/types][types field="lgb-access" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-access.png"><span class="small-business-info">Accessible<br/> </span></div>[/types][types field="lgb-animals" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-animals.png"><span class="small-business-info">Animal<br/>friendly</span></div>[/types][types field="lgb-aircond" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-aircond.png"><span class="small-business-info">Air<br/>Conditioning</span></div>[/types][types field="lgb-parking" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-parking.png"><span class="small-business-info">Private<br>Parking</span></div>[/types][types field="lgb-terrace" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-terrace.png"><span class="small-business-info">Terrace<br/> </span></div>[/types][types field="lgb-meeting" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-meeting.png"><span class="small-business-info">Meeting<br/>Room</span></div>[/types][types field="lgb-meeting" state="unchecked"][/types][types field="lgb-ecolabel" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-ecolabel.png"><span class="small-business-info">Ecolabel<br/> </span></div>[/types][types field="lgb-shuttle" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-shuttle.png"><span class="small-business-info">Shuttle<br/>Service</span></div>[/types][types field="lgb-garage" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-garage.png"><span class="small-business-info">Garage<br/> </span></div>[/types][types field="lgb-elevator" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-elevator.png"><span class="small-business-info">Elevator<br/> </span></div>[/types][types field="lgb-convention" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-convention.png"><span class="small-business-info">Convention<br/>Center</span></div>[/types][types field="lgb-roomservice" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-roomservice.png"><span class="small-business-info">Room<br/>Service</span></div>[/types][types field="lgb-bar" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-roomservice.png"><span class="small-business-info">Bar<br/> </span></div>[/types][types field="lgb-restaurant" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-restaurant.png"><span class="small-business-info">Restaurant<br/> </span></div>[/types][types field="lgb-nursery" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-nursery.png"><span class="small-business-info">Nursery<br/> </span></div>[/types][types field="lgb-garden" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-garden.png"><span class="small-business-info">Private<br/>Garden</span></div>[/types][types field="lgb-internet" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-internet.png"><span class="small-business-info">Internet<br/>Connection</span></div>[/types][types field="lgb-custody" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-custody.png"><span class="small-business-info">Safe<br/>Deposit</span></div>[/types][types field="lgb-safe" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-safe.png"><span class="small-business-info">In-room<br/>Safe</span></div>[/types][types field="lgb-tv" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-tv.png"><span class="small-business-info">Tv Set<br/>in Room</span></div>[/types][types field="lgb-minibar" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-minibar.png"><span class="small-business-info">Minibar<br/> </span></div>[/types][types field="lgb-laundry" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-laundry.png"><span class="small-business-info">Laundry<br/> </span></div>[/types][types field="lgb-pool" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-pool.png"><span class="small-business-info">Pool</span></div>[/types][types field="lgb-bike" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-bike.png"><span class="small-business-info">Bike<br/>Rental</span></div>[/types][types field="lgb-sport" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-sport.png"><span class="small-business-info">Sports<br/>Equipment</span></div>[/types][types field="lgb-kids" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-kids.png"><span class="small-business-info">Children<br/>Playground</span></div>[/types][types field="lgb-horse" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-horse.png"><span class="small-business-info">Riding<br/>School</span></div>[/types][types field="lgb-work" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-work.png"><span class="small-business-info">Farm<br/>Work</span></div>[/types][types field="lgb-cooking" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-cooking.png"><span class="small-business-info">Cooking<br/>School</span></div>[/types][types field="lgb-bikepath" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-bikepath.png"><span class="small-business-info">Bicycle<br/>Tracks</span></div>[/types][types field="lgb-hiking" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-hiking.png"><span class="small-business-info">Hiking<br/>Routes</span></div>[/types][types field="lgb-hiking" state="unchecked"][/types]
											<h3 style="clear:both;">Pagamenti</h3>
											[types field="lgb-cartasi" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-cartasi.png"></div>[/types][types field="lgb-atm" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-atm.png"></div>[/types][types field="lgb-visa" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-visa.png"></div>[/types][types field="lgb-americanexp" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-americanexp.png"></div>[/types][types field="lgb-diners" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-diners.png"></div>[/types][types field="lgb-mastercard" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-mastercard.png"></div>[/types][types field="lgb-paypal" state="checked"]<div class="business-services"><img width="60px" class="business-services" src="/../wp-content/themes/langhe/images/lgicons/business/lgb-paypal.png"></div>[/types][types field="lgb-paypal" state="unchecked"][/types]
										[/wpv-noautop]</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="map" class="avia-section main_color avia-section-default avia-no-shadow avia-bg-style-scroll  el_after_av_textblock  el_before_av_section  container_wrap fullsize">
		<div class="container">
			<div class="template-page content twelve alpha units">
				<div class="post-entry post-entry-type-page">
					<div class="entry-content-wrapper clearfix">
	                  [types field="langhe_map"][/types]
					</div>
				</div>
			</div>
		</div>
	</div>
	[wpv-if town="_wpcf_belongs_lgtown_id" evaluate="( !empty($town) ) AND ($town > 0)"]
	<div id="lgtown-fw" class="avia-section header_color avia-section-default avia-no-shadow av-section-color-overlay-active avia-bg-style-fixed el_before_av_section container_wrap fullsize lg-related-fw" style="background-repeat: no-repeat; background-image: url('[wpv-post-featured-image size="full" raw="true" id="$lgtown"]'); background-attachment: fixed; background-position: center center; " data-section-bg-repeat="no-repeat">
		<div class="av-section-color-overlay-wrap">
			<div class="av-section-color-overlay b-overlay"><!-- fare CSS --></div>
			<a href="#next-section" title="" class="scroll-down-link lg-darrow" aria-hidden="true" data-av_iconfont="entypo-fontello"></a>
			<div class="container">
				<main role="main" class="template-page content  av-content-full alpha units">
					<div class="post-entry post-entry-type-page">
						<div class="entry-content-wrapper clearfix">
							<h2 class="title"><a href="[wpv-post-url id="$lgtown"]">[wpml-string context="RelatedContent"]Discover[/wpml-string] [wpv-post-title id="$lgtown"]</a></h2>
							<div class="lg-excerpt">
								[wpv-post-excerpt id="$lgtown"]
							</div>
							<div class="avia-button-wrap avia-button-center"><a class="avia-button  avia-icon_select-no avia-color-light avia-size-x-large avia-position-center" href="[wpv-post-url id="$lgtown"]"><span class="avia_iconbox_title">[wpml-string context="RelatedContent"]Discover[/wpml-string] [wpv-post-title id="$lgtown"]</span></a>
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>
	[/wpv-if]
	<div id="related-sights" class="avia-section main_color avia-section-default avia-no-shadow avia-bg-style-scroll el_before_av_section  container_wrap fullsize">
		<div class="container">
			<div class="template-page content  twelve alpha units">
				<div class="post-entry post-entry-type-lgbusiness post-entry-">
					<div class="entry-content-wrapper clearfix">
	                  <h2 class="title">[wpml-string context="RelatedContent"]To see nearby[/wpml-string]</h2>
	                  [wpv-view name="Related Cosa Vedere in Area"]
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="related-business" class="avia-section alternate_color avia-section-default avia-no-shadow avia-bg-style-scroll el_before_av_section  container_wrap fullsize">
		<div class="container">
			<div class="template-page content  twelve alpha units">
				<div class="post-entry post-entry-type-lgbusiness post-entry-">
					<div class="entry-content-wrapper clearfix">
	                  <h2 class="title">[wpml-string context="RelatedContent"]You May also Like[/wpml-string]</h2>
	                  [wpv-view name="Related Business in Area"]
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="lgb-book" class="avia-section main_color avia-section-default avia-no-shadow avia-bg-style-scroll  el_after_av_textblock  el_before_av_section  container_wrap fullsize">
	  <div class='container'>
	    <div class='template-page content twelve alpha units'>
	      <div class='post-entry post-entry-type-page'>
	        <div class='entry-content-wrapper clearfix'>
	          <?php
	            comments_template( '/includes/comments.php');
	          ?>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>


</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>
