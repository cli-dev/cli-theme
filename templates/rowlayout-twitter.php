<?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$is_slider = get_sub_field('is_slider', $item_id);
$custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $animation_class . $item_animation_effect . $custom_class; ?>"<?php echo $animation;?>>
  <div class="twitter-feed-wrapper">
    <div class="twitter-feed<?php if ($is_slider == 1) { echo ' twitter-slider'; }?>">
      <?php $twitter_posts = get_sub_field('twitter_posts', $item_id); echo do_shortcode('[timeline-twitter-feed]'); ?>
    </div>
  </div>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var sliderWidth = $('.twitter-slider').width();
      $('.twitter-slider .timeline-twitter-feed').owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        autoHeight:true,
        onInitialized: function(){
          $('.twitter-slider .owl-item').width(sliderWidth);
          $('.twitter-slider .owl-stage-outer').width(sliderWidth);
        }
      });
    });
  </script>
</div>