<?php
	global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();

  $ecats = get_the_terms($post->ID, 'event-categories');
  $title  = __('Blog - Latest News', 'avia_framework'); //default blog title
  $t_link = get_category_link( $ecats[0] );
  $t_sub = "";

	if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $ecats[0]->name, 'link' => $t_link, 'subtitle' => $t_sub));

?>

		<div class='container_wrap container_wrap_first sidebar_right  '>
                    <?php
                    /* Run the loop to output the posts.
                    * If you want to overload this in a child theme then include a file
                    * called loop-index.php and that will be used instead.
                    *
                    */
                        //get_template_part( 'includes/loop', 'index' );
                        //get_template_part( 'includes/loop', 'about-author' );						
                        //show related posts based on tags if there are any
                        the_content();
                       //wordpress function that loads the comments template "comments.php"
?>
                        
                       <div class='avia-section main_color avia-section-default avia-no-shadow avia-bg-style-scroll  el_after_av_textblock  el_before_av_section  container_wrap fullsize'>
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