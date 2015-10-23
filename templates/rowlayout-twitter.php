<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
  
  $is_slider = get_sub_field('is_slider', $item_id);
  $custom_class = get_sub_field('custom_class', $item_id);
 ?>
<div class="twitter-feed-wrapper <?php echo $custom_class; ?>">
<div class="twitter-feed<?php if ($is_slider == 1) { echo ' twitter-slider'; }?>">
  <?php $twitter_posts = get_sub_field('twitter_posts', $item_id); echo do_shortcode('[timeline-twitter-feed]'); ?>
</div>

<i class="social-grid-icon fa fa-twitter"></i>
</div>