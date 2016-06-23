<?php get_header(); ?>
<section id="content" role="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-wrapper'); ?>>
      <section class="entry-content">
        <?php get_template_part( 'entry', 'content' ); ?>
      </section>
    </article>
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>