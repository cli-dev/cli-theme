<?php get_header(); ?>
<?php get_template_part('templates/page', 'header') ; 
$careers_page = get_id_by_slug( 'careers' );
?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
  <section class="position-content">
    <div class="position-content-inner">
      <header class="position-header">
        <div class="position-header-inner">
          <h1><?php the_title(); ?></h1>
        </div>
      </header>
      <?php 
        $description = get_field('description');
        $category = get_field('category');
        $location= get_field('location');
        $apply_form= get_field('apply_form');
      ?>
      <div class="position-description">
        <?php echo $description; ?>
      </div>
      <div class="position-row">
        <div class="position-col">
        <?php if($category) {?>
          <div class="position-meta-box">
            <div class="position-meta-box-inner">
              <div>
              <h4>Category:</h4>
              </div>
              <div>
              <?php echo $category; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($location) {?>
          <div class="position-meta-box">
            <div class="position-meta-box-inner">
              <div>
                <h4>Location:</h4>
              </div>
              <div>
                <?php echo $location; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if( have_rows('benefits') ): ?>
          <div class="position-meta-box">
            <div class="position-meta-box-inner">
              <div>
              <h4>Benefits:</h4>
              </div>
              <div>
              <?php while( have_rows('benefits') ): the_row(); $benefit = get_sub_field('benefit');?>
                <span class="benefit"><?php echo $benefit; ?></span>
              <?php endwhile; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        </div>
        <div class="position-col">
        <a class="position-btn back-to-careers btn color4 solid" href="<?php echo get_permalink($careers_page); ?>"><span>See Other Jobs</span></a>
        <div class="position-btn show-apply-form btn color1 solid">
          <span>Apply Now</span>
        </div>
        </div>
      </div>
    </div>
  </section>
  <div class="form position-form">
    <?php echo $apply_form; ?>
  </div>
</article>
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>