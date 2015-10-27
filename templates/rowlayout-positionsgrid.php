<?php 
        
//Vars

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$display_intro_block = get_sub_field('display_intro_block', $item_id);

$first_block_background_color = (get_sub_field('first_block_background_color', $item_id)) ? ' style="background-color: ' . get_sub_field('first_block_background_color', $item_id) . ';"' : '';
$first_block_text_color = (get_sub_field('first_block_text_color', $item_id)) ? ' style="color: ' . get_sub_field('first_block_text_color', $item_id) . ';"' : '';
$first_block_intro_text = get_sub_field('first_block_intro_text', $item_id);


$block_background_color = (get_sub_field('block_background_color', $item_id)) ? ' style="background-color: ' . get_sub_field('block_background_color', $item_id) . ';"' : '';
$block_title_color = (get_sub_field('block_title_color', $item_id)) ?  ' style="color: ' . get_sub_field('block_title_color', $item_id) . ';"' : '';
$block_text_color = (get_sub_field('block_text_color', $item_id)) ?  ' style="color: ' . get_sub_field('block_text_color', $item_id) . ';"' : '';
$extra_class = (get_sub_field('extra_class', $item_id)) ? get_sub_field('extra_class', $item_id) : '';
$number_of_columns = 'style="width: ' . get_sub_field('number_of_columns', $item_id) . ';"';

$display_button = get_sub_field('display_button', $item_id);
$button_text = get_sub_field('button_text', $item_id);
$button_class = (get_sub_field('button_class', $item_id)) ? ' ' . get_sub_field('button_class', $item_id) : '';

$button = ($display_button == 1) ? '<div class="btn' . $button_class . '">' . $button_text . '</div>' : '';

$first_block = ($display_intro_block == 1) ? '<div class="position-block"' . $number_of_columns . '><div class="position-block-inner"' . $first_block_background_color . '><h2'. $first_block_text_color. '>' . $first_block_intro_text . '</h2></div></div>' : '';

?>

<?php

$args1 = array (
  'post_type' => array( 'position' ),
);

$query1 = new WP_Query( $args1 );

if ( $query1->have_posts() ) : ?>
  <div class="positions">
    <?php echo $first_block; ?>
    <?php while ( $query1->have_posts() ) : $query1->the_post(); ?>
      <?php
        $description = get_field('description');
      ?>
      <a href="<?php the_permalink(); ?>" class="position-block" <?php echo $number_of_columns; ?>>
        <div class="position-block-inner <?php echo $extra_class; ?>" <?php echo $block_background_color; ?>>
          <h3<?php echo $block_title_color; ?>><?php the_title(); ?></h3>
          <div class="job-description">
            <p<?php echo $block_text_color; ?>><?php echo $description; ?></p>
          </div>
          <?php echo $button; ?>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>