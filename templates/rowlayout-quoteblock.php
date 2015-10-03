<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
              
  $quote_block_title = get_sub_field('quote_block_title', $item_id);
  $quote_block_title_color = (get_sub_field('quote_block_title_color', $item_id)) ? 'style="color: ' . get_sub_field('quote_block_title_color', $item_id) . ';"' : '';
  $quote_block_text = get_sub_field('quote_block_text', $item_id);
  $quote_block_text_color = (get_sub_field('quote_block_text_color', $item_id)) ? 'style="color: ' . get_sub_field('quote_block_text_color', $item_id) . ';"' : '';
  $quote_block_author = get_sub_field('quote_block_author', $item_id);
  $quote_block_author_color = (get_sub_field('quote_block_author_color', $item_id)) ? 'style="color: ' . get_sub_field('quote_block_author_color', $item_id) . ';"' : '';
  $quote_block_title = get_sub_field('quote_block_title', $item_id);
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $quote_block_background_color = (get_sub_field('quote_block_background_color', $item_id)) ? ' style="background-color: ' . get_sub_field('quote_block_background_color', $item_id) . ';"' : '';
  
  $layout_classes = 'class="quote ' . $custom_class . '"';
 
 ?>
<div <?php echo $layout_classes . $quote_block_background_color; ?>>
  <div class="quote-title" <?php echo $quote_block_title_color;?>><?php echo $quote_block_title;?></div>
  <div class="quote-text" <?php echo $quote_block_text_color;?>><?php echo $quote_block_text;?></div>
  <div class="quote-author" <?php echo $quote_block_author_color;?>><?php echo $quote_block_author;?></div>
</div>