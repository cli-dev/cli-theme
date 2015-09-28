<?php
  $logo = get_field('logo', 'option');
  $logo_position = get_field('logo_position', 'option');
  $is_header_in_grid = get_field('is_header_in_grid', 'option');
  $hide_menu_on_desktop = get_field('hide_menu_on_desktop', 'option');
  $hide_menu = ($hide_menu_on_desktop == 1) ? 'menu-container hidden-menu' : 'menu-container';
  $hide_button = ($hide_menu_on_desktop == 0) ? ' hide_button' : '';
  $header_in_grid = ($is_header_in_grid == 1) ? ' header-in-grid' : '';
  
  $detect = new Mobile_Detect;
?>

<header id="header" class="<?php echo $header_in_grid; ?>">
  <div class="header-inner">
    <?php if ($detect->isMobile() ) { ?>
      <?php get_template_part('templates/menu' , 'mobile') ?>
    <?php } else { ?>
      <?php if($logo_position === 'left') { ?>
        <?php get_template_part('templates/menu' , 'right') ?>
      <?php } else if($logo_position === 'center'){ ?>
        <?php get_template_part('templates/menu' , 'divided') ?>
      <?php } ?>
    <?php } ?>
  </div>
</header>