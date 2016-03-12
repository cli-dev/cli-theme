<?php
  $logo = $myoptions['logo'];
  $desktop_logo_maximum_width = $myoptions['desktop_logo_maximum_width'];
  $hide_menu_on_desktop = $myoptions['hide_menu_on_desktop'];
  $hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
  $hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
  $logo_height = $myoptions['logo_height'] ? ' height: ' . $myoptions['logo_height'] . 'px;' : '';
?>
  <div class="site-logo center-logo" itemtype="http://schema.org/LocalBusiness"<?php if ($desktop_logo_maximum_width) { echo ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"'; } ?>> 
    <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;' . $logo_height . '"';}; ?>>
      <img src="<?php if ($logo) { echo $logo; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo"/>
    </a>
  </div>
  <nav class="desktop-menu menu-center">
    <div class="menu-button-area<?php echo $hide_button; ?>">
      <button class="menu-button">
        <span>toggle menu</span>
      </button>
      <span class="menu-button-txt">Menu</span>
    </div>
    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => $hide_menu, 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
  </nav>
