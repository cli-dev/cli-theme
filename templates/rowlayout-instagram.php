<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $instagram_user_id = get_sub_field('instagram_user_id', $item_id);
  $block_id = get_sub_field('block_id', $item_id);
  $access_token = get_sub_field('access_token', $item_id);
$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $animation_class . $item_animation_effect; ?>"<?php echo $animation;?>>
        
<div class="instagram-wrapper"><div id="<?php echo $block_id; ?>" class="instagram-block <?php echo $custom_class; ?>"></div></div> 
        
<script type="text/javascript">
  var userFeed = new Instafeed({
    target: '<?php echo $block_id; ?>',
    get: 'user',
    userId: <?php echo $instagram_user_id; ?>,
    accessToken: '<?php echo $access_token; ?>',
    template: '<a href="{{link}}" class="instagram-img" target="_blank" ><img src="{{image}}" /></a>',
    resolution: 'standard_resolution',
    limit: 1,
  });
  userFeed.run();
</script>

</div>