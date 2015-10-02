<?php wp_nav_menu( array( 'theme_location' => 'right-menu',) ); ?>
  <?php if ( is_active_sidebar( 'side-menu-widget' ) ) : ?>  
    <div id="side-widget-area">  
      <?php dynamic_sidebar( 'side-menu-widget' ); ?>
    </div>
  <?php endif; ?>
