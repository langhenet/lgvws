<?php
  $id = get_the_ID();
  $businessmeta = get_post_meta($id);
  $town_id = wpcf_pr_post_get_belongs( get_the_ID(), 'lgtown' );
  $town_post = get_post( $town_id );
?>

<div class="activity-grid__column">
  <div class="activity-grid__item-container">
    <a class="grid-item__image-container" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <?php echo get_the_post_thumbnail( $post->ID, 'magazine', array( 'class' => 'grid-item__image attachment-portfolio wp-post-image' ) ); ?>
      <div class="grid-item__meta-container">
        <p class="grid-item__meta package-item__meta">
          <?php echo $town_post->post_title ?>
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
      </div>
      <div class="grid-item__cta-container">
        <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="grid-item__book-now"><?php _e('Read More' , 'activities') ?></a>
      </div>
    </div>
  </div>
</div>
