 <?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;
 
$blog_posts = get_sub_field('blog_posts', $item_id);
$post_offset = get_sub_field('post_offset', $item_id);
$custom_class = get_sub_field('custom_class', $item_id);
$blog_category = get_sub_field('blog_category', $item_id);
$post_layout = get_sub_field('post_layout', $item_id);
$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';

$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $animation_class . $item_animation_effect . $custom_class; ?>"<?php echo $animation;?>>
        
<?php $args = array ('posts_per_page' => $blog_posts, 'offset' => $post_offset, 'cat' => $blog_category); $query = new WP_Query( $args ); if ( $query->have_posts() ) : ?>
  <div class="blog-feed-wrapper">
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <?php get_template_part('templates/post-layouts/post-layout-' . $post_layout); ?>
  <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
</div>