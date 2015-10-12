<?php
  $logo = get_field('logo', 'option');
  $desktop_logo_maximum_width = get_field('desktop_logo_maximum_width', 'option');
  $is_header_in_grid = get_field('is_header_in_grid', 'option');
  $hide_menu_on_desktop = get_field('hide_menu_on_desktop', 'option');
  $hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
  $hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
  $header_in_grid = ($is_header_in_grid == 1) ? ' header-in-grid' : '';
?>
	<nav id="menu-right" class="desktop-menu">
	  <div class="site-logo" itemtype="http://schema.org/LocalBusiness"<?php if ($desktop_logo_maximum_width) { echo ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"'; } ?>> 
			<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;';}; ?>>
				<img src="<?php if ($logo) { echo $logo; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo"/>
			</a>
		</div>
	  <div class="menu-button-area<?php echo $hide_button; ?>">
			<button class="menu-button">
			  <span>toggle menu</span>
			</button>
			<span class="menu-button-txt">Menu</span>
	  </div>
	  <?php wp_nav_menu( array( 'theme_location' => 'right-menu', 'container_class' => $hide_menu,) ); ?>
  </nav>
