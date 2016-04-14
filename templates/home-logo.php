<?php

  $myoptions = get_option( 'themesettings_');
  $logoimg = $myoptions['logo'];
  $logosvg = $myoptions['svg_desktop_logo'];
  $logo = ($logosvg) ? $logosvg : $logoimg;

  $logo_bg = ($logo) ? ' style="background: url(' . $logo . ') center no-repeat; background-size: contain;"' : '';

?>

<div class="site-logo" itemtype="http://schema.org/LocalBusiness"> 
  <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home"<?php echo $logo_bg; ?>>
    <img src="<?php if ($logoimg) { echo $logoimg; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo" />
  </a>
</div>