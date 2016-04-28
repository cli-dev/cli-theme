<?php
$myoptions = get_option( 'themesettings_');
$sticky_header = $myoptions['sticky_header'];
$sticky = ($sticky_header == "1") ? 'sticky-header' : '';
$logoimg = $myoptions['logo'];
$logosvg = $myoptions['svg_desktop_logo'];
$logo = ($logosvg) ? $logosvg : $logoimg;
$sticky_logo = '';
$desktop_logo_maximum_width = $myoptions['desktop_logo_maximum_width'];
$is_header_in_grid = $myoptions['is_header_in_grid'];
$hide_menu_on_desktop = $myoptions['hide_menu_on_desktop'];
$hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
$hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
$header_in_grid = ($is_header_in_grid == 1) ? ' header-in-grid' : '';
if ($sticky_header == "1") {$sticky_logo = ($myoptions['sticky_header_logo']) ? $myoptions['sticky_header_logo'] : $logo;}
$sticky_header_height = '';
if ($sticky_header == "1") {$sticky_header_height = $myoptions['sticky_header_height'];}
$sticky_height = ($sticky_header_height) ? ' style="height: ' . $sticky_header_height . 'px;"' : '';

if ($sticky_header == "1") {?>
<div class="<?php echo $sticky; ?>">
  <nav class="sticky-nav-inner"<?php echo $sticky_height; ?>>
    <div class="site-logo" itemtype="http://schema.org/LocalBusiness"<?php if ($desktop_logo_maximum_width) { echo ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"'; } ?>> 
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($sticky_logo) { echo 'style="background: url(' . $sticky_logo . ') center no-repeat; background-size: contain;"';}; ?>>
        <img src="<?php echo $sticky_logo; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" class="site-main-logo"/>
      </a>
    </div>
    <div class="menu-button-area<?php echo $hide_button; ?>">
      <button class="menu-button">
        <span>toggle menu</span>
      </button>
      <span class="menu-button-txt">Menu</span>
    </div>
    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => $hide_menu, 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
  </nav>
  </div>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    var header = new Headhesive('.sticky-header');
  });
</script>
<?php } ?>
<nav class="desktop-menu">
 <div class="site-logo" itemtype="http://schema.org/LocalBusiness"<?php if ($desktop_logo_maximum_width) { echo ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"'; } ?>> 
   <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;"';}; ?>>
    <img src="<?php if ($logoimg) { echo $logoimg; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo"/>
  </a>
</div>
<div class="menu-button-area<?php echo $hide_button; ?>">
 <button class="menu-button">
   <span>toggle menu</span>
 </button>
 <span class="menu-button-txt">Menu</span>
</div>
<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => $hide_menu, 'link_before' => '<span class="link-text">', 'link_after' => '</span>') ); ?>
</nav>
