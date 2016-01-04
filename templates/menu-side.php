<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
  <?php if ( is_active_sidebar( 'side-menu-bottom-widget' ) ) : ?>  
    <div id="side-widget-area">  
      <?php dynamic_sidebar( 'side-menu-bottom-widget' ); ?>
    </div>
  <?php endif; ?>
