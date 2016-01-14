<?php 

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$accordion_class = get_sub_field('accordion_class', $item_id);
$open_icon = get_sub_field('open_tab_icon', $item_id);
$close_icon = get_sub_field('close_tab_icon', $item_id);

?>

<?php if( have_rows('accordion', $item_id) ): ?>

  <div class="accordion<?php echo ' ' . $accordion_class; ?>">

  <?php while( have_rows('accordion', $item_id) ): the_row(); 

    // vars
    $title = get_sub_field('accordion_tab_title');
    $content = get_sub_field('accordion_tab_content');
    $title_bg = (get_sub_field('accordion_tab_title_background_color')) ? ' style="background-color: ' . get_sub_field('accordion_tab_title_background_color') . ';"' : '';
    $content_bg = (get_sub_field('accordion_tab_content_background_color')) ? ' style="background-color: ' . get_sub_field('accordion_tab_content_background_color') . '; display:none;"' : ' style="display:none;"';
    $custom_class = get_sub_field('custom_class');

    ?>

    <div class="accordion-tab<?php echo ' ' . $custom_class; ?>">
      <div class="accordion-tab-title"<?php echo $title_bg; ?>>
        <div class="accordion-tab-title-content"><?php echo $title; ?></div>
        <div class="accordion-tab-icon"><i class="fa<?php echo ' ' . $open_icon; ?>"></i></div>
      </div>
      <div class="accordion-content"<?php echo $content_bg; ?>><?php echo $content; ?></div>
    </div>
    

  <?php endwhile; ?>

  </div>

  <script>
    jQuery(document).ready(function($){

      element = $('.<?php echo $accordion_class; ?>').children('.accordion-tab');

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