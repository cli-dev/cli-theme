<?php
  $logo = get_field('logo', 'option');
  $desktop_logo_maximum_width = get_field('desktop_logo_maximum_width', 'option');
  $is_header_in_grid = get_field('is_header_in_grid', 'option');
?>

<header id="header" class="<?php echo $header_in_grid; ?>">
  <div class="header-inner">
  <?php wp_nav_menu( array( 'theme_location' => 'divided-left-menu', 'container_class' => 'left-side-menu',) ); ?>
  <div class="site-logo" itemtype="http://schema.org/LocalBusiness"> 
    <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;'; if ($desktop_logo_maximum_width) { echo ' max-width: ' . $desktop_logo_maximum_width . 'px;"'; } else {echo '"';}}; ?>><img src="<?php if ($logo) { echo $logo; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?> Logo" itemprop="logo" class="site-main-logo"/></a>
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'divided-right-menu', 'container_class' => 'right-side-menu',) ); ?>
  </div>
  
</header>