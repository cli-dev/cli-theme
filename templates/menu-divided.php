<?php
  $myoptions = get_option( 'themesettings_');
  $logo = $myoptions['logo'];
  $desktop_logo_maximum_width = $myoptions['desktop_logo_maximum_width'];
?>
	<nav id="menu-right" class="desktop-menu">
	  <?php wp_nav_menu( array( 'theme_location' => 'divided-left-menu', 'container_class' => 'left-side-menu', 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
	  <div class="site-logo" itemtype="http://schema.org/LocalBusiness"<?php if ($desktop_logo_maximum_width) { echo ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"'; } ?>> 
	    <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;';}; ?>><img src="<?php if ($logo) { echo $logo; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo"/></a>
	  </div>
	  <?php wp_nav_menu( array( 'theme_location' => 'divided-right-menu', 'container_class' => 'right-side-menu', 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
	  </div>
  </nav>