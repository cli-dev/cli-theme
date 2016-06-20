<div class="post-wrapper">
  <header class="post-header">
    <h1><?php the_title(); ?></h1>
    <div class="entry-meta">
      <div class="entry-categories">
        <?php $categories = get_the_category();

        foreach( $categories as $category ) {
          echo '<span class="entry-cat ' . $category->slug . '" >' . $category->name . '</span>';
        } ?>
      </div>
      <div class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?>
    </div>
    </div>
  </header>
  <section class="post-content">
    <?php the_content(); ?>
  </section>
  <?php get_template_part( 'entry-footer' ); ?>
</div>
