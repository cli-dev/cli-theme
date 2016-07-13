<?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();
$item_id = (is_blog()) ? $page_for_posts : $postid;
$images = get_sub_field('images', $item_id);
$custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
$columns_on_desktop = get_sub_field('columns_on_desktop', $item_id);
$number_of_columns = ($columns_on_desktop) ? ' data-col-number="' . $columns_on_desktop . '"' : '';
$column_spacing = intval(get_sub_field( get_sub_field('spacing_between_images', $item_id)));
$gallery_negative_margin = ($column_spacing) ? ' style="margin: -' . ($column_spacing/2) . 'px"' : '';
$gallery_spacing = ($column_spacing) ? ' style="padding: ' . ($column_spacing/2) . 'px"' : '';
$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';
$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
  <div class="col-item<?php echo $animation_class . $item_animation_effect; ?>"<?php echo $animation;?>>
    <?php if( $images ): ?>
    <div class="img-gallery<?php echo $custom_class; ?>"<?php echo $gallery_negative_margin; ?>>
      <?php foreach( $images as $image ): ?>
      <div class="gallery-img-wrap"<?php echo $gallery_spacing; ?>>
        <a href="<?php echo $image['url']; ?>" rel="gallery1" title="<?php echo $image['title']; ?>" class="gallery-img" style="background-image: url(<?php echo $image['sizes']['medium']; ?>)"></a>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
</div>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".gallery-img").fancybox({
     padding: 0,
     maxWidth: 700,
     margin: [50, 40, 20, 40]
   });
    var columns = <?php echo $columns_on_desktop; ?>;
    var maxWidth = 1/columns * 100;
    if($(window).width() >= 1000){
      $('.gallery-img-wrap').css('max-width', maxWidth + '%');
    }
    $(window).resize(function(event) {
      if($(window).width() >= 1000){
        $('.gallery-img-wrap').css('max-width', maxWidth + '%');
      } else if($(window).width() >= 600){
        $('.gallery-img-wrap').css('max-width','50%');
      }
      else{
        $('.gallery-img-wrap').css('max-width',  'none');
      }
    });
  });
</script>