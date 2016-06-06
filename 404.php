<?php get_header(); ?>
<section id="content" role="main">
  <header class="page-header wow fadeIn" data-wow-delay="0.5s" <?php $header_image = get_field( '404_header_image', 'option' );  echo 'style="background: url(' . $header_image . ') center no-repeat; background-size: cover;"';
  ?>>
    <div class="page-header-inner-wrapper">
      <div class="page-header-inner in-grid flex-row flex-direction-column flex-position-center flex-align-center">
        <div class="header-block">   
          <h1>404</h1>
          <p>Page not found</p>
        </div>
      </div>
    </div>
  </header>
  <article id="post-0" class="post not-found">
    <section class="entry-content">
      <div class="row-wrapper">
        <div class="flex-row flex-direction-row flex-position-center flex-align-start nowrap in-grid">
          <div class="flex-col col-12 wow fadeInUp" data-wow-delay="1s" data-wow-offset="100"> 
            <div class="col-inner  flex-direction-column"> 
              <p style="text-align:center">We're sorry, but it appears the page you are looking for cannot be found. Try a search instead?</p>
              <?php get_search_form(); ?>   
            </div>
          </div>   
        </div>
      </div>
    </section>
  </article>
</section>
<?php get_footer(); ?>