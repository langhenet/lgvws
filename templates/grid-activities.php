<?php
  $id = get_the_ID();
  $activitymeta = get_post_meta($id);
?>

<div class="activity-grid__column">
  <div class="activity-grid__item-container">
    <a class="grid-item__image-container" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <?php echo get_the_post_thumbnail( $post->ID, 'magazine', array( 'class' => 'grid-item__image attachment-portfolio wp-post-image' ) ); ?>
      <div class="grid-item__meta-container">
        <p class="grid-item__meta package-item__meta">
          <?php echo __('Duration' , 'activities') . ': ' . $activitymeta['wpcf-lg-duration'][0] . ' ' . __('hours' , 'activities'); ?>
        </p>
      </div>
    </a>
    <div class="grid-item__title-container">
      <h3 class="grid-item__title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
    </div>
    <div class="grid-item__description-container">
      <p>
        <?php echo(get_the_excerpt()); ?>
      </p>
    </div>
    <div class="grid-item__footer">
      <div class="grid-item__additional-info-container">
      <p class="activity-grid__price"><strong><?php echo $activitymeta['wpcf-lgp-price'][0] ?>€</strong></p>
      </div>
      <div class="grid-item__cta-container">
        <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="grid-item__book-now"><?php _e('Book Now' , 'activities') ?></a>
      </div>
    </div>
  </div>
</div>
