<?php
add_action( 'after_setup_theme', 'cli_theme_setup' );
function cli_theme_setup(){
	load_theme_textdomain( 'cli_theme', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) 
		$content_width = 640;
		register_nav_menus(
			array( 'mobile-menu' => __( 'Mobile Menu', 'cli_theme' ) )
		);
}

add_action( 'wp_enqueue_scripts', 'cli_theme_load_scripts' );
function cli_theme_load_scripts() {
	wp_enqueue_script( 'jquery' );
}

add_action( 'comment_form_before', 'cli_theme_enqueue_comment_reply_script' );
function cli_theme_enqueue_comment_reply_script(){
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'cli_theme_title' );
function cli_theme_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'cli_theme_filter_wp_title' );
function cli_theme_filter_wp_title( $title ){
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'cli_theme_widgets_init' );
function cli_theme_widgets_init(){
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'cli_theme' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

function cli_theme_custom_pings( $comment ){
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }

add_filter( 'get_comments_number', 'cli_theme_comments_number' );
function cli_theme_comments_number( $count ){
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

require_once('inc/mobile_detect.php');
require_once('inc/custom_css.php');
require_once('inc/my-plugins.php');
require_once('inc/theme-options.php');
require_once('inc/custom_functions.php');
require_once('inc/shortcodes.php');
require_once('inc/widget-areas.php');
require_once('inc/company_info.php');
require_once('inc/job_position.php');
require_once('inc/page_builder.php');
require_once('inc/page_header_options.php');
require_once('inc/team_member.php');
require_once('inc/theme_fields.php');