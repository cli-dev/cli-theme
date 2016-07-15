<?php 

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$accordion_class = get_sub_field('accordion_class', $item_id);
$open_icon = get_sub_field('open_tab_icon', $item_id);
$close_icon = get_sub_field('close_tab_icon', $item_id);
$tab_title_bg_color = get_sub_field('tab_title_background_color', $item_id);
$tab_content_bg_color = get_sub_field('tab_content_background_color', $item_id);
$tab_bg_hover_color = get_sub_field('tab_background_hover_color', $item_id);
$active_tab_bg_color = get_sub_field('active_tab_background_color', $item_id);

?>

<?php if( have_rows('accordion', $item_id) ): ?>

  <?php if ($tab_title_bg_color || $tab_content_bg_color || $tab_bg_hover_color || $active_tab_bg_color) { ?>
    <style type="text/css">
      <?php if ($tab_title_bg_color ) { ?>
        .accordion.<?php echo $accordion_class; ?> .accordion-tab-title{
          background-color: <?php echo $tab_title_bg_color; ?>;
        }
      <?php } ?>
      <?php if ($tab_content_bg_color) { ?>
        .accordion.<?php echo $accordion_class; ?> .accordion-content{
          background-color: <?php echo $tab_content_bg_color; ?>;
        }
      <?php } ?>
      <?php if ($tab_bg_hover_color) { ?>
        .accordion.<?php echo $accordion_class; ?> .accordion-tab-title:hover{
          background-color: <?php echo $tab_bg_hover_color; ?>;
        }
      <?php } ?>
      <?php if ($active_tab_bg_color) { ?>
        .accordion.<?php echo $accordion_class; ?> .accordion-tab.active-tab .accordion-tab-title{
          background-color: <?php echo $active_tab_bg_color; ?>;
        }
      <?php } ?>
    </style>

  <?php } ?>

  <div class="accordion<?php echo ' ' . $accordion_class; ?>">

  <?php while( have_rows('accordion', $item_id) ): the_row(); 

    // vars
      $title = get_sub_field('accordion_tab_title');
      $content = get_sub_field('accordion_tab_content');
      $custom_class = get_sub_field('custom_class');
      $open_by_default = (get_sub_field('open_by_default') == 1) ? ' default-open-tab' : '';
    ?>

    <div class="accordion-tab<?php echo ' ' . $custom_class . $open_by_default; ?>">
      <div class="accordion-tab-title">
        <div class="accordion-tab-title-content"><?php echo $title; ?></div>
        <div class="accordion-tab-icon"><i class="fa<?php echo ' ' . $open_icon; ?>"></i></div>
      </div>
      <div class="accordion-content"><?php echo $content; ?></div>
    </div>
    

  <?php endwhile; ?>

  </div>

  <script>
    jQuery(document).ready(function($){

      element = $('.accordion.<?php echo $accordion_class; ?>').children('.accordion-tab');
      $('.accordion-content').hide();
      $('.accordion-tab.default-open-tab').addClass('active-tab');
      $('.accordion-tab.default-open-tab .accordion-content').show();

      $(element).click(function() {
        if($(this).children('.accordion-content').css('display') === 'none'){
          $('.accordion-content').slideUp();
          $('.<?php echo $accordion_class; ?> .fa').removeClass('<?php echo $close_icon; ?>').addClass('<?php echo $open_icon; ?>');
          $(this).addClass('active-tab').siblings().removeClass('active-tab');
          $(this).children('.accordion-content').slideDown();
          $(this).find('.fa').removeClass('<?php echo $open_icon; ?>').addClass('<?php echo $close_icon; ?>');
        } else{
          $(this).children('.accordion-content').slideUp();
          $(this).removeClass('active-tab');
          $(this).find('.fa').removeClass('<?php echo $close_icon; ?>').addClass('<?php echo $open_icon; ?>');
        }
      });

    });
  </script>

<?php endif; ?>