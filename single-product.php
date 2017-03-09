<?php
	global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();

  $pcats = get_the_terms($post->ID, 'product_cat');
  $title  = __('Blog - Latest News', 'avia_framework'); //default blog title
  $t_link = get_category_link( $pcats[0] );
  $t_sub = "";

	if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $pcats[0]->name, 'link' => $t_link, 'subtitle' => $t_sub));

?>

		<div class='container_wrap container_wrap_first main_color template-shop shop_columns_3 <?php avia_layout_class( 'main' ); ?>'>

			<div class='container template-blog template-single-blog '>


		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


				<?php
				$avia_config['currently_viewing'] = "shop";
				//get the sidebar
				get_sidebar();


				?>


			</div><!--end container-->

		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>