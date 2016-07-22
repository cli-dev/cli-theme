<?php
  
  $myoptions = get_option( 'themesettings_');
  
  $logoimg = $myoptions['logo'];
  $logosvg = $myoptions['svg_desktop_logo'];
  $logo = ($logosvg) ? $logosvg : $logoimg;
  $logo_position = $myoptions['logo_position'];
  $is_header_in_grid = $myoptions['is_header_in_grid'];
  $hide_menu_on_desktop = $myoptions['hide_menu_on_desktop'];
  $hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
  $hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
  $header_in_grid = ($is_header_in_grid == 1) ? ' header-in-grid ' : '';
  $header_type = $myoptions['header_type'];
  $top_header_type = $myoptions['top_header_position'];
  $center_logo_menu_type = '';
  if($logo_position === 'center'){$center_logo_menu_type = $myoptions['center_logo_menu_type'];}

  $header_classes = 'class="site-header ' . $header_in_grid . $top_header_type . '"';

?>

<?php if ($header_type === 'Top Menu') { ?>
  <div id="content-wrapper">
    <header <?php echo $header_classes; ?>>
      <div class="header-inner">
        <?php if ( is_active_sidebar( 'header-widgets' ) ) : ?>  
          <div class="header-widgets">  
            <div class="header-widgets-inner"><?php dynamic_sidebar( 'header-widgets' ); ?></div>
          </div>
        <?php endif; ?>
        <?php  
          get_template_part('templates/menu' , 'mobile');
       
          if($logo_position === 'center' && $center_logo_menu_type === 'divided'){ 
            get_template_part('templates/menu' , 'divided'); 
          } 
          else if($logo_position === 'center' && $center_logo_menu_type === 'top'){
            get_template_part('templates/menu' , 'center'); 
          }
          else { 
            get_template_part('templates/menu' , 'right'); 
          }  
         ?>
      </div>
    </header>

    <?php if($top_header_type === "header-overlap") { ?>
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          var siteHeaderHeight = $('.site-header').outerHeight();

          $('.overlapping-header').css('padding-top', siteHeaderHeight);

          $(window).resize(function(event) {

            var siteHeaderHeight2 = $('.site-header').outerHeight();

            $('.overlapping-header').css('padding-top', siteHeaderHeight2);

          });
        });
      </script>

    <?php } ?>

<?php } else { ?>
  <?php
    $desktop_logo_maximum_width = $myoptions['desktop_logo_maximum_width'];
    $header_classes = 'class="site-header has-side-menu ' . $header_in_grid . $top_header_type . '"';
  ?>
  <nav id="side-menu" class="<?php echo $hide_menu; if ($header_type === 'Right Side Menu') { echo ' right-menu';} else {echo ' left-menu';} ?>">
    <div class="site-logo" itemtype="http://schema.org/LocalBusiness"<?php if ($desktop_logo_maximum_width) { echo ' style="max-width: ' . $desktop_logo_maximum_width . 'px;"'; } ?>> 
      <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?>" rel="home" <?php if ($logo) { echo 'style="background: url(' . $logo . ') center no-repeat; background-size: contain;';}; ?>><img src="<?php if ($logoimg) { echo $logoimg; }; ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ), 'cli-theme' ); ?> Logo" itemprop="logo" class="site-main-logo"/></a>
    </div>
    <?php get_template_part('templates/menu' , 'side'); ?>
  </nav>
  <div id="content-wrapper" class="<?php if($hide_menu_on_desktop == 0) { if ($header_type === 'Right Side Menu') { echo 'has-right-menu';} else {echo 'has-left-menu';} } ?>">
    <header <?php echo $header_classes; ?>>
      <div class="header-inner">
        <div class="header-widgets">  
          <div class="header-widgets-inner">
            <?php if ( is_active_sidebar( 'header-widgets' ) ) {dynamic_sidebar( 'header-widgets' );} ?>  
            <div class="menu-button-area<?php echo $hide_button; if ($header_type === 'Right Menu') { echo ' right-menu-btn';} else {echo ' left-menu-btn';}?>">
              <button class="menu-button">
                <span>toggle menu</span>
              </button>
              <span class="menu-button-txt">Menu</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php if($top_header_type === "header-overlap") { ?>
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          var siteHeaderHeight = $('.header-inner').outerHeight();

          $('.overlapping-header').css('padding-top', siteHeaderHeight);

          $(window).resize(function(event) {

            var siteHeaderHeight2 = $('.header-inner').outerHeight();

            $('.overlapping-header').css('padding-top', siteHeaderHeight2);

          });
        });
      </script>
    <?php } ?>
  <?php } ?>

