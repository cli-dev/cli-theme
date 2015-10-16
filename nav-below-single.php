<nav id="nav-below" class="navigation" role="navigation">
<?php
$prev_post = get_previous_post();
$prevsection = get_field( 'post_section', $prev_post->ID );
if (!empty( $prev_post )): ?>
 <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="previous-post btn"><i class="fa fa-angle-left"></i> <span class="nav-txt">previous post</span></a>
<?php endif; ?>
<?php
$next_post = get_next_post();
if ( is_a( $next_post , 'WP_Post' ) ) { $nextsection = get_field( 'post_section', $next_post->ID );?>
  <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next-post btn"><span class="nav-txt">next post</span> <i class="fa fa-angle-right"></i></a>
<?php } ?>
</nav>