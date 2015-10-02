<?php
  $logo = get_field('logo', 'option');
  $logo_position = get_field('logo_position', 'option');
  $is_header_in_grid = get_field('is_header_in_grid', 'option');
  $hide_menu_on_desktop = get_field('hide_menu_on_desktop', 'option');
  $hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
  $hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
  $header_in_grid = ($is_header_in_grid == 1) ? ' header-in-grid' : '';
  $header_type = get_field('header_type', 'option');
  
  $detect = new Mobile_Detect;
?>

<?php if ($header_type === 'Top Menu') { ?>
  <div id="content-wrapper">
    <header id="header" class="<?php echo $header_in_grid; ?>">
      <div class="header-inner">
        <?php 
          if ($detect->isMobile() ) { 
            get_template_part('templates/menu' , 'mobile');
          } else { 
           
            if($logo_position === 'center'){ 
              get_template_part('templates/menu' , 'divided'); 
            } 
            else { 
              get_template_part('templates/menu' , 'right'); 
            } 
            
          } 
         ?>
      </div>
    </header>

<?php } else { ?>
  <?php
    $desktop_logo_maximum_width = get_field('desktop_logo_maximum_width', 'option');
  ?>
  <nav id="side-menu" class="<?php echo $hide_menu; if ($header_type === 'Right Menu') { echo ' right-menu';} else {echo ' left-menu';} ?>">
    <div class="site-logo" itemtype="http://schema.org/LocalBusiness"> 
      <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;'; if ($desktop_logo_maximum_width) { echo ' max-width: ' . $desktop_logo_maximum_width . 'px;"'; } else {echo '"';}}; ?>><img src="<?php if ($logo) { echo $logo; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?> Logo" itemprop="logo" class="site-main-logo"/></a>
    </div>
    <?php get_template_part('templates/menu' , 'side'); ?>
  </nav>
  <div id="content-wrapper" class="<?php if($hide_menu_on_desktop == 0) { if ($header_type === 'Right Menu') { echo 'has-right-menu';} else {echo 'has-left-menu';} } ?>">
    <header id="header" class="has-side-menu <?php echo $header_in_grid; ?>">
      <div class="header-inner">
        <?php if ( is_active_sidebar( 'header-widgets' ) ) : ?>  
          <div id="header-widgets">  
            <?php dynamic_sidebar( 'header-widgets' ); ?>
          </div>
        <?php endif; ?>
        <div class="menu-button-area<?php echo $hide_button; if ($header_type === 'Right Menu') { echo ' right-menu-btn';} else {echo ' left-menu-btn';}?>">
          <button class="menu-button">
            <span>toggle menu</span>
          </button>
          <span class="menu-button-txt">Menu</span>
        </div>
      </div>
    </header>
<?php } ?>