<?php 

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

get_sub_field('raw_html', $item_id);

echo get_post_meta ( $item_id, 'row_0_columns_0_column_content_1_raw_html');

?>

<p>raw html test</p>