<?php
  $id = get_the_ID();
  $articlemeta = get_post_meta($id);
?>

<div class="articles-grid__column">
  <div class="articles-grid__item-container">
    <div class="articles-grid__author-container">
      <div class="articles-grid__author-image">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
      </div>
      <div class="articles-grid__author-name">
        <?php
          _e('By &nbsp;' , 'general-texts');
          the_author();
        ?>
      </div>
    </div>
    <a class="grid-item__image-container" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <?php echo get_the_post_thumbnail( $post->ID, 'magazine', array( 'class' => 'grid-item__image attachment-portfolio wp-post-image' ) ); ?>
      <div class="grid-item__meta-container">
        <?php the_date('F j, Y'); ?>
      </div>
    </a>
    <div class="grid-item__title-container">
      <h3 class="grid-item__title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
    </div>
    <div class="grid-item__description-container">
      <p>
        <?php echo( get_the_excerpt() ); ?>
      </p>
    </div>
    <div class="grid-item__footer">
      <div class="grid-item__additional-info-container">
      </div>
      <div class="grid-item__cta-container">
        <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="grid-item__read-more"><?php _e('Read More' , 'general-texts') ?></a>
      </div>
    </div>
  </div>
</div>
