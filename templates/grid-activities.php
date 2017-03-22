<?php
  $tax = wp_get_post_terms( $id, 'lgarea' );
  $id = get_the_ID();
  $activitymeta = get_post_meta($id);
?>

<div class="activity-grid__column">
  <div class="activity-grid__item-container">
    <a class="grid-item__image-container" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <?php echo get_the_post_thumbnail( $post->ID, 'magazine', array( 'class' => 'grid-item__image attachment-portfolio wp-post-image' ) ); ?>
      <div class="grid-item__meta-container">
        <p class="grid-item__meta package-item__meta">
          <?php echo $tax[0]->name; ?>
        </p>
      </div>
    </a>
    <div class="grid-item__title-container">
      <h3 class="grid-item__title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
    </div>
    <div class="grid-item__description-container">
      <?php the_excerpt(); ?>
    </div>
    <div class="grid-item__footer">
      <div class="grid-item__additional-info-container">
      <p class="grid-item__additional-info grid-item__price"><strong><?php echo $activitymeta['wpcf-lgp-price'][0] ?>€</strong></p>
      </div>
      <div class="grid-item__cta-container">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="grid-item__read-more"><?php _e('Read More') ?> &raquo;</a>
        <a id="book-now--<?php echo $activitymeta['wpcf-lg-trekksoft-activity'][0] ?>" href="#" title="<?php the_title(); ?>" class="grid-item__book-now"><?php _e('Book Now') ?></a>
        <script src="//booking.langhe.net/it/api/public"></script>
        <script>
            (function() {
                var button = new TrekkSoft.Embed.Button();
                button
                      .setAttrib("target", "fancy")
                      .setAttrib("entryPoint", "tour")
                      .setAttrib("tourId", "<?php echo $activitymeta['wpcf-lg-trekksoft-activity'][0] ?>")
                      .setAttrib("fancywidth", "95%")
                      .registerOnClick("#book-now--<?php echo $activitymeta['wpcf-lg-trekksoft-activity'][0] ?>");
            })();
        </script>
      </div>
    </div>
  </div>
</div>
