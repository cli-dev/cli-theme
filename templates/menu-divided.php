<?php
  $logo = get_field('logo', 'option');
  $is_header_in_grid = get_field('is_header_in_grid', 'option');
  $hide_menu_on_desktop = get_field('hide_menu_on_desktop', 'option');
  $hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
  $hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
  $header_in_grid = ($is_header_in_grid == 1) ? ' header-in-grid' : '';
?>

<header id="header" class="<?php echo $header_in_grid; ?>">
  <div class="header-inner">
  <?php wp_nav_menu( array( 'theme_location' => 'divided-left-menu', 'container_class' => 'left-side-menu',) ); ?>
  <div class="site-logo" itemtype="http://schema.org/LocalBusiness"> 
    <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?>" rel="home"><img src="<?php if ($logo) { echo $logo; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?> Logo" itemprop="logo" class="site-main-logo"/></a>
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'divided-right-menu', 'container_class' => 'right-side-menu',) ); ?>
  </div>
  
</header>