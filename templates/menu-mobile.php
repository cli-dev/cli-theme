<?php
  $myoptions = get_option( 'themesettings_');
  $logoimg = $myoptions['mobile_logo'];
  $logosvg = $myoptions['svg_mobile_logo'];
  $logo = ($logosvg) ? $logosvg : $logoimg;
  $mobile_logo_maximum_width = $myoptions['mobile_logo_maximum_width'];
?>
<nav class="mobile-nav">
  <div class="site-logo" itemtype="http://schema.org/LocalBusiness" <?php if ($mobile_logo_maximum_width) { echo 'style="max-width: ' . $mobile_logo_maximum_width . 'px;"'; } ?>> 
    <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;'; if ($mobile_logo_maximum_width) { echo ' max-width: ' . $mobile_logo_maximum_width . 'px;"'; } else {echo '"';}}; ?>><img src="<?php if ($logoimg) { echo $logoimg; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo"/></a>
  </div>
  <div class="menu-button-area">
    <button class="menu-button">
      <span>toggle menu</span>
    </button>
    <span class="menu-button-txt">Menu</span>
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'container_class' => 'menu-mobile-container', 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
</nav>
