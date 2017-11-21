<?php
	global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
    $cats = get_the_category();
		$title 	= get_the_title(); //if the blog is attached to a page use this title
		$t_link = get_category_link( $cats[0] );

	if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title(array('heading'=>'strong', 'title' => $cats[0]->cat_name, 'link' => $t_link));

?>

		<div class='main'>
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