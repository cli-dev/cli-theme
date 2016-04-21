<?php

  $myoptions = get_option( 'themesettings_');
  $logo = $myoptions['footer_logo'];

?>

<div class="footer-logo"> 
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home">
    <img src="<?php echo $logo;?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" />
  </a>
</div>