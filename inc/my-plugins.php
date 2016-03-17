<?php

function add_my_plugins() {
  
  wp_register_script( 'headerJS', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'),'2.0', false);
  wp_enqueue_script( 'headerJS' );
  
  wp_register_script( 'footerJS', get_template_directory_uri() . '/js/footer-scripts.js', array('jquery'),'', true);
  wp_enqueue_script( 'footerJS' );

}
 
add_action( 'wp_enqueue_scripts', 'add_my_plugins' );