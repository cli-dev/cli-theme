<?php

if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
		'page_title' 	=> 'Company Info',
		'menu_title'	=> 'Company Info',
		'menu_slug' 	=> 'company-info',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
  
  acf_add_options_page(array(
		'page_title' 	=> 'Custom CSS',
		'menu_title'	=> 'Custom CSS',
		'menu_slug' 	=> 'theme-custom-css',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

?>