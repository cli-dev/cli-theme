<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
  <nav id="nav-below-feed" class="navigation" role="navigation">
  <?php if (function_exists("pagination")) {
      pagination($additional_loop->max_num_pages);
  } ?>
  </nav>
<?php } ?>