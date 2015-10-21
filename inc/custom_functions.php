<?php

define( 'ACFGFS_API_KEY', 'AIzaSyCb6qQxNAuJiQm-iEBkCs3KF1Iopl1gw0U' );

define('CLI_ROOT', get_template_directory_uri());

function main_stylesheet() {

  wp_register_style( 'main', CLI_ROOT . '/css/style.css', false, false, 'all' );
  wp_enqueue_style( 'main' );

}
add_action( 'wp_enqueue_scripts', 'main_stylesheet' );

if(!function_exists('cli_is_css_folder_writable')) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function cli_is_css_folder_writable() {
		$css_dir = get_template_directory().'/css';

		return is_writable($css_dir);
	}
}

function cli_generate_dynamic_css_and_js() {

		if(cli_is_css_folder_writable()) {
			$css_dir = get_template_directory().'/css/';

			ob_start();
			include_once('css/style_dynamic.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic.css', $css, LOCK_EX);

		}
	}

function cli_add_dynamic_css(){
  if (file_exists(dirname(__FILE__) ."/css/style_dynamic.css") && cli_is_css_folder_writable() && !is_multisite() && !is_admin()) {
    wp_enqueue_style("style_dynamic", CLI_ROOT . "/css/style_dynamic.css", array(), filemtime(dirname(__FILE__) ."/css/style_dynamic.css"));
  } 
  else if(!is_admin()) {
    wp_enqueue_style("style_dynamic", CLI_ROOT . "/css/style_dynamic.php");
  }
}
add_action( 'wp_enqueue_scripts', 'cli_add_dynamic_css' );

function bac_variable_length_excerpt($text, $length, $finish_sentence){
  //Word length of the excerpt. This is exact or NOT depending on your '$finish_sentence' variable.
  $length = 15; /* Change the Length of the excerpt as you wish. The Length is in words. */
  
  //1 if you want to finish the sentence of the excerpt (No weird cuts).
  $finish_sentence = 1; // Put 0 if you do NOT want to finish the sentence.
   
  $tokens = array();
  $out = '';
  $word = 0;
   
  //Divide the string into tokens; HTML tags, or words, followed by any whitespace.
  $regex = '/(<[^>]+>|[^<>\s]+)\s*/u';
  preg_match_all($regex, $text, $tokens);
  foreach ($tokens[0] as $t){ 
    //Parse each token
    if ($word >= $length && !$finish_sentence){ 
    //Limit reached
    break;
    }
    if ($t[0] != '<'){ 
    //Token is not a tag. 
    //Regular expression that checks for the end of the sentence: '.', '?' or '!'
    $regex1 = '/[\?\.\!]\s*$/uS';
    if ($word >= $length && $finish_sentence && preg_match($regex1, $t) == 1){ 
      //Limit reached, continue until ? . or ! occur to reach the end of the sentence.
      $out .= trim($t);
      break;
    }   
    $word++;
    }
    //Append what's left of the token.
    $out .= $t;     
  }
  //Add the excerpt ending as a link.
  $excerpt_end = ' [&hellip;]';
   
  //Add the excerpt ending as a non-linked ellipsis with brackets.
  //$excerpt_end = ' [&hellip;]';
   
  //Append the excerpt ending to the token. 
  $out .= $excerpt_end;
   
  return trim(force_balance_tags($out)); 
}

function bac_excerpt_filter($text){
  //Get the full content and filter it.
  $finish_sentence = 1;

  $length = 15;

  $text = get_the_content('');
  $text = strip_shortcodes( $text );
  $text = apply_filters('the_content', $text);
   
  $text = str_replace(']]>', ']]&gt;', $text);
   
  /**By default the code allows all HTML tags in the excerpt**/
  //Control what HTML tags to allow: If you want to allow ALL HTML tags in the excerpt, then do NOT touch.
   
  //If you want to Allow SOME tags: THEN Uncomment the next line + Line 80.
  //$allowed_tags = '<p>,<a>,<strong>'; /* Here I am allowing p, a, strong tags. Separate tags by comma. */
   
  //If you want to Disallow ALL HTML tags: THEN Uncomment the next line + Line 80, 
  //$allowed_tags = ''; /* To disallow all HTML tags, keep it empty. The Excerpt will be unformated but newlines are preserved. */
  //$text = strip_tags($text, $allowed_tags); /* Line 80 */
   
  //Create the excerpt.
  $text = bac_variable_length_excerpt($text, $length, $finish_sentence);  
  return $text;
}
//Hooks the 'bac_excerpt_filter' function to a specific (get_the_excerpt) filter action.
add_filter('get_the_excerpt','bac_excerpt_filter',5);

add_filter('widget_text', 'do_shortcode');

function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

function displayfullAddress() {
  
  $address_1 = get_field('address_line_1', 'option');
  $city = get_field('city', 'option');
  $state = get_field('state', 'option');
  $zip = get_field('zip', 'option');
  $phone = get_field('phone', 'option');
  $email = get_field('email', 'option');
  
  if($address_1){
    $addressCode = '<div itemprop="streetAddress">' . $address_1 . '</div>';  
  }
  
  if($city){
    $cityCode = '<span itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span itemprop="postalCode">' . $zip . '</span>';  
  }
  
  if($phone){
    $phoneCode = '<div itemprop="telephone">' . $phone . '</div>';  
  }
  
  if($email){
    $emailCode = '<div><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div>' . $cityCode . $stateCode . ' ' . $zipCode . '</div></div>' . $phoneCode . $emailCode . '</div>';
  
}

function displayAddress() {
  
  $address_1 = get_field('address_line_1', 'option');
  $city = get_field('city', 'option');
  $state = get_field('state', 'option');
  $zip = get_field('zip', 'option');
  
  if($address_1){
    $addressCode = '<div itemprop="streetAddress">' . $address_1 . '</div>';  
  }
  
  if($city){
    $cityCode = '<span itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span itemprop="postalCode">' . $zip . '</span>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div>' . $cityCode . $stateCode . ' ' . $zipCode . '</div></div></div>';
  
}

function displayContactInfo() {
  
  $phone = get_field('phone', 'option');
  $email = get_field('email', 'option');
  
  if($phone){
    $phoneCode = '<div itemprop="telephone">' . $phone . '</div>';  
  }
  
  if($email){
    $emailCode = '<div><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">' . $phoneCode . $emailCode . '</div>';
  
}

function displaySocialProfiles($icon_type, $extra_class) {
  
  $custom_class = $extra_class;
  $type_of_icon = $icon_type;
  $facebook= get_field('facebook', 'options');
  $twitter = get_field('twitter', 'options');
  $google = get_field('google', 'options');
  $linkedin = get_field('linkedin', 'options');
  $tumblr = get_field('tumblr', 'options');
  $pinterest = get_field('pinterest', 'options');
  $flickr = get_field('flickr', 'options');
  $newswire = get_field('newswire', 'options');
  $instagram = get_field('instagram', 'options');

  $facebookCode = '';
  $twitterCode = '';
  $googleCode = '';
  $linkedinCode = '';
  $tumblrCode = '';
  $pinterestCode = '';
  $flickrCode = '';
  $newswireCode = '';
  $instagramCode = '';
  
  if($facebook){
    if($type_of_icon === 'icon1'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-square-round"></i></a></div>';  
    }
    else{
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="facebook" fill="none" stroke="#3C599B" stroke-miterlimit="10" d="M25 1C11.7 1 1 11.7 1 25c0 13.3 10.7 24 24 24 13.3 0 24-10.7 24-24C49 11.7 38.3 1 25 1zM32.5 15.5h-2.8c-2.2 0-3.2 0.7-3.2 2.2v3.8h5.8l-0.7 5h-5.1v14h-5v-14h-5v-5h5v-4.3c0-4.5 2.9-6.9 6.9-6.9 1.9 0 3.1 0.1 4.1 0.2V15.5z"/></svg></a></div>';  
    }
    
  }
  
  if($twitter){
    if($type_of_icon === 'icon1'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-square-round"></i></a></div>';  
    }
    else{
    $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="twitter" fill="none" stroke="#32CCFE" stroke-miterlimit="10" d="M25 1C11.7 1 1 11.7 1 25c0 13.3 10.7 24 24 24 13.3 0 24-10.7 24-24C49 11.7 38.3 1 25 1zM36.7 19c0 0.3 0 0.5 0 0.8 0 8-6.1 17.1-17.1 17.1-3.4 0-6.6-1-9.2-2.7 0.5 0.1 1 0.1 1.5 0.1 2.8 0 5.4-1 7.5-2.6-2.6-0.1-4.9-1.8-5.6-4.2 0.4 0.1 0.7 0.1 1.1 0.1 0.5 0 0.6-0.1 1.1-0.2-2.8-0.6-5.3-3-5.3-5.9 0 0 0-0.1 0-0.1 1 0.4 2.2 0.7 3.2 0.8-1.6-1.1-2.4-2.9-2.4-5 0-1.1 0.4-2.1 0.9-3 3 3.7 7.5 6 12.5 6.3-0.1-0.4-0.1-0.9-0.1-1.4 0-3.3 2.7-6 6-6 1.7 0 3.3 0.7 4.4 1.9 1.4-0.3 2.7-0.8 3.8-1.5-0.4 1.4-1.4 2.6-2.6 3.3 1.2-0.1 2.4-0.5 3.5-0.9C38.9 17.1 37.8 18.2 36.7 19z"/></svg></a></div>';  
    }

  }
  
  if($google){
    if($type_of_icon === 'icon1'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-square-round"></i></a></div>';  
    }
    else{
    $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="google" fill="none" stroke="#DD4B39" stroke-miterlimit="10" d="M25.5 0.5c-13.3 0-24 10.7-24 24 0 13.3 10.7 24 24 24 13.3 0 24-10.7 24-24C49.5 11.2 38.8 0.5 25.5 0.5zM28 32.4c-3.1 4.4-9.3 5.6-14.2 3.8 -4.9-1.9-8.3-7-7.9-12.2 0.1-6.4 6-12 12.4-11.8 3.1-0.1 6 1.2 8.3 3.1 -1 1.1-2 2.2-3.2 3.3 -2.8-2-6.9-2.5-9.7-0.3 -4 2.8-4.2 9.4-0.3 12.4 3.8 3.4 10.9 1.7 12-3.5 -2.4 0-4.7 0-7.1-0.1 0-1.4 0-2.8 0-4.2 4 0 7.9 0 11.9 0C30.5 26.1 30 29.6 28 32.4zM40.2 27.3v3.2h-3.4v-3.2h-3.2v-2.8h3.2v-3h3.4v3h3.1v2.8H40.2z"/></svg></a></div>';  
    }

  }
  
  if($linkedin){
    if($type_of_icon === 'icon1'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-square-round"></i></a></div>';  
    }
    else{
    $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve""><path id="linkedin fill="none" stroke="#0977B4" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5 13.5 0 24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM16.5 39.5h-7v-19h7V39.5zM13.6 17.5L13.6 17.5c-2.2 0-3.6-1.4-3.6-3.2 0-1.9 1.4-3.3 3.6-3.3 2.2 0 3.6 1.4 3.6 3.3C17.2 16.1 15.8 17.5 13.6 17.5zM39.5 39.5h-6V29.3c0-2.6-0.9-4.4-3.2-4.4 -1.8 0-3 1.2-3.4 2.3 -0.2 0.4-0.3 1-0.3 1.6v10.6h-6.1c0.1-17 0-19 0-19h6.1v2.6c1-1.3 2.3-3.2 5.7-3.2 4.2 0 7.3 2.8 7.3 8.7V39.5z"/></svg></a></div>';  
    }

  }
  
  if($tumblr){
    if($type_of_icon === 'icon1'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-square"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-square-round"></i></a></div>';  
    }
    else{
    $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="tumblr" fill="none" stroke="#2D4865" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5s24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM28 40c-6.5 0.1-9.5-4.7-9.5-8v-9.5h-3v-4.2c5-1.6 6.1-5.5 6.3-7.8 0-0.1 0.6 0 0.7 0 0 0 0 0 4 0v8h6v4h-6v9c0 1.3 0.7 3 3.1 3 0.8 0 2-0.3 2.5-0.5l1.3 4.3C32.8 39 30.2 40 28 40z"/></svg></a></div>'; 
    }

  }
  
  if($pinterest){
    if($type_of_icon === 'icon1'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-square-round"></i></a></div>';  
    }
    else{
    $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="pinterest" fill="none" stroke="#CB2027" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5s24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM27.4 33.1c-2 0-3.8-1.1-4.5-2.3 -1.1 4.2-1.3 5-1.3 5 -0.4 1.4-1.5 3.3-1.9 3.9 -0.3 0.6-2.2 0.1-2.1-0.8 0-0.9 0-2.8 0.3-4.2 0 0 0.4-1.5 2.4-10 -0.6-1.2-0.6-2.9-0.6-2.9 0-2.7 1.6-4.7 3.5-4.7 1.7 0 2.5 1.3 2.5 2.8 0 1.7-1.1 4.2-1.6 6.5 -0.5 2 1 3.5 2.9 3.5 3.5 0 5.8-4.5 5.8-9.7 0-4-2.7-7-7.6-7 -5.6 0-9 4.2-9 8.8 0 1.6 0.5 2.7 1.2 3.6 0.3 0.4 0.4 0.5 0.3 1 -0.1 0.3-0.3 1.1-0.4 1.5 -0.1 0.5-0.5 0.6-0.9 0.5 -2.6-1-3.7-3.9-3.7-7C12.7 16.3 17 10 25.7 10c7 0 11.6 5.1 11.6 10.5C37.3 27.7 33.3 33.1 27.4 33.1z"/></svg></a></div>'; 
    }

  }
  
  if($flickr){
    if($type_of_icon === 'icon1'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-square-round"></i></a></div>';  
    }
    else{
    $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="flickr" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM16 31.8c-3.8 0-6.8-3-6.8-6.8s3-6.8 6.8-6.8 6.8 3 6.8 6.8S19.8 31.8 16 31.8zM34 31.8c-3.8 0-6.8-3-6.8-6.8s3-6.8 6.8-6.8 6.8 3 6.8 6.8S37.8 31.8 34 31.8z"/></svg></a></div>';  
    }

  }
  
  if($newswire){
    if($type_of_icon === 'icon1'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-square-round"></i></a></div>';  
    }
    else{
    $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="newswire" fill="none" stroke="#1357A8" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5s24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM37.5 37.5c0 1.4-1 2.5-2.4 2.5 -0.7 0-1.2-0.3-1.6-0.7 0 0 0 0 0 0 0 0 0-0.1-0.1-0.1 -0.1-0.1-0.6-0.2-0.6-0.3L16.5 19.5v17.9c0 1.4-1.1 2.5-2.5 2.5s-2.5-1.1-2.5-2.5V12.5c0-1.4 1.5-2.5 2.9-2.5 0.5 0 1.1 0.1 1.5 0.4 0.3 0.2 0.6 0.4 0.8 0.7l15.8 19.3V12.5c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5V37.5z"/></svg></a></div>';  
    }

  }
  
  if($instagram){
    if($type_of_icon === 'icon1'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-square-round"></i></a></div>';  
    }
    else{
    $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="instagram" fill="none" stroke="#7C5641" stroke-miterlimit="10" d="M25 30.8c3.3 0 6-2.6 6-5.8 0-3.2-2.7-5.8-6-5.8 -3.3 0-6 2.6-6 5.8C19 28.2 21.7 30.8 25 30.8zM34.4 25.7c0 5-4.2 8.8-9.3 8.8 -5.1 0-9.3-3.7-9.3-8.7 0-0.9 0.1-2.3 0.4-2.3h-3.6v11.9c0 0.7 1.4 2.1 2 2.1h20.9c0.7 0 1.1-1.5 1.1-2.1V23.5H34C34.2 23.5 34.4 24.8 34.4 25.7zM25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5s24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM39.5 36.2c0 2.1-1.2 4.3-3.3 4.3H13.8c-2.1 0-4.3-2.2-4.3-4.3V13.8c0-2.1 2.2-3.3 4.3-3.3h22.3c2.1 0 3.3 1.2 3.3 3.3V36.2zM35.3 13.5h-3.4c-0.7 0-1.4 0.4-1.4 1.2v3.2c0 0.7 0.6 1.6 1.4 1.6h3.4c0.7 0 1.2-0.8 1.2-1.6v-3.2C36.5 13.9 36 13.5 35.3 13.5z"/></svg></a></div>';  
    }

  }
  
  

return '<div id="social-profiles" class="social ' . $type_of_icon . ' ' . $custom_class . '">' . $facebookCode . $twitterCode . $googleCode . $linkedinCode . $tumblrCode  . $pinterestCode  . $flickrCode  . $newswireCode . $instagramCode . '</div>';
  
}

function displaySocialShare() {
  
  $type_of_icon = get_field('type_of_icon', 'options');

    if($type_of_icon === 'icon1'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-square-round"></i></a></div>';  
    }
    else{
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="facebook" fill="none" stroke="#3C599B" stroke-miterlimit="10" d="M25 1C11.7 1 1 11.7 1 25c0 13.3 10.7 24 24 24 13.3 0 24-10.7 24-24C49 11.7 38.3 1 25 1zM32.5 15.5h-2.8c-2.2 0-3.2 0.7-3.2 2.2v3.8h5.8l-0.7 5h-5.1v14h-5v-14h-5v-5h5v-4.3c0-4.5 2.9-6.9 6.9-6.9 1.9 0 3.1 0.1 4.1 0.2V15.5z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-square-round"></i></a></div>';  
    }
    else{
    $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="twitter" fill="none" stroke="#32CCFE" stroke-miterlimit="10" d="M25 1C11.7 1 1 11.7 1 25c0 13.3 10.7 24 24 24 13.3 0 24-10.7 24-24C49 11.7 38.3 1 25 1zM36.7 19c0 0.3 0 0.5 0 0.8 0 8-6.1 17.1-17.1 17.1-3.4 0-6.6-1-9.2-2.7 0.5 0.1 1 0.1 1.5 0.1 2.8 0 5.4-1 7.5-2.6-2.6-0.1-4.9-1.8-5.6-4.2 0.4 0.1 0.7 0.1 1.1 0.1 0.5 0 0.6-0.1 1.1-0.2-2.8-0.6-5.3-3-5.3-5.9 0 0 0-0.1 0-0.1 1 0.4 2.2 0.7 3.2 0.8-1.6-1.1-2.4-2.9-2.4-5 0-1.1 0.4-2.1 0.9-3 3 3.7 7.5 6 12.5 6.3-0.1-0.4-0.1-0.9-0.1-1.4 0-3.3 2.7-6 6-6 1.7 0 3.3 0.7 4.4 1.9 1.4-0.3 2.7-0.8 3.8-1.5-0.4 1.4-1.4 2.6-2.6 3.3 1.2-0.1 2.4-0.5 3.5-0.9C38.9 17.1 37.8 18.2 36.7 19z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-square-round"></i></a></div>';  
    }
    else{
    $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="google" fill="none" stroke="#DD4B39" stroke-miterlimit="10" d="M25.5 0.5c-13.3 0-24 10.7-24 24 0 13.3 10.7 24 24 24 13.3 0 24-10.7 24-24C49.5 11.2 38.8 0.5 25.5 0.5zM28 32.4c-3.1 4.4-9.3 5.6-14.2 3.8 -4.9-1.9-8.3-7-7.9-12.2 0.1-6.4 6-12 12.4-11.8 3.1-0.1 6 1.2 8.3 3.1 -1 1.1-2 2.2-3.2 3.3 -2.8-2-6.9-2.5-9.7-0.3 -4 2.8-4.2 9.4-0.3 12.4 3.8 3.4 10.9 1.7 12-3.5 -2.4 0-4.7 0-7.1-0.1 0-1.4 0-2.8 0-4.2 4 0 7.9 0 11.9 0C30.5 26.1 30 29.6 28 32.4zM40.2 27.3v3.2h-3.4v-3.2h-3.2v-2.8h3.2v-3h3.4v3h3.1v2.8H40.2z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-square-round"></i></a></div>';  
    }
    else{
    $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="linkedin" fill="none" stroke="#0977B4" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5 13.5 0 24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM16.5 39.5h-7v-19h7V39.5zM13.6 17.5L13.6 17.5c-2.2 0-3.6-1.4-3.6-3.2 0-1.9 1.4-3.3 3.6-3.3 2.2 0 3.6 1.4 3.6 3.3C17.2 16.1 15.8 17.5 13.6 17.5zM39.5 39.5h-6V29.3c0-2.6-0.9-4.4-3.2-4.4 -1.8 0-3 1.2-3.4 2.3 -0.2 0.4-0.3 1-0.3 1.6v10.6h-6.1c0.1-17 0-19 0-19h6.1v2.6c1-1.3 2.3-3.2 5.7-3.2 4.2 0 7.3 2.8 7.3 8.7V39.5z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-square"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-circle"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon4'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-square-round"></i></a></div>';  
    }
    else{
    $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="tumblr" fill="none" stroke="#2D4865" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5s24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM28 40c-6.5 0.1-9.5-4.7-9.5-8v-9.5h-3v-4.2c5-1.6 6.1-5.5 6.3-7.8 0-0.1 0.6 0 0.7 0 0 0 0 0 4 0v8h6v4h-6v9c0 1.3 0.7 3 3.1 3 0.8 0 2-0.3 2.5-0.5l1.3 4.3C32.8 39 30.2 40 28 40z"/></svg></a></div>'; 
    }

    if($type_of_icon === 'icon1'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-square-round"></i></a></div>';  
    }
    else{
    $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="pinterest" fill="none" stroke="#CB2027" stroke-miterlimit="10" d="M25 0.5C11.5 0.5 0.5 11.5 0.5 25c0 13.5 11 24.5 24.5 24.5s24.5-11 24.5-24.5C49.5 11.5 38.5 0.5 25 0.5zM27.4 33.1c-2 0-3.8-1.1-4.5-2.3 -1.1 4.2-1.3 5-1.3 5 -0.4 1.4-1.5 3.3-1.9 3.9 -0.3 0.6-2.2 0.1-2.1-0.8 0-0.9 0-2.8 0.3-4.2 0 0 0.4-1.5 2.4-10 -0.6-1.2-0.6-2.9-0.6-2.9 0-2.7 1.6-4.7 3.5-4.7 1.7 0 2.5 1.3 2.5 2.8 0 1.7-1.1 4.2-1.6 6.5 -0.5 2 1 3.5 2.9 3.5 3.5 0 5.8-4.5 5.8-9.7 0-4-2.7-7-7.6-7 -5.6 0-9 4.2-9 8.8 0 1.6 0.5 2.7 1.2 3.6 0.3 0.4 0.4 0.5 0.3 1 -0.1 0.3-0.3 1.1-0.4 1.5 -0.1 0.5-0.5 0.6-0.9 0.5 -2.6-1-3.7-3.9-3.7-7C12.7 16.3 17 10 25.7 10c7 0 11.6 5.1 11.6 10.5C37.3 27.7 33.3 33.1 27.4 33.1z"/></svg></a></div>'; 
    }


return '<div id="social-share" class="social">' . $facebookCode . $twitterCode . $googleCode . $linkedinCode . $tumblrCode  . $pinterestCode  . '</div>';
  
}

function hex2rgb($hex) {
  $hex = str_replace("#", "", $hex);
  
  if(strlen($hex) == 3) {
  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
  } else {
  $r = hexdec(substr($hex,0,2));
  $g = hexdec(substr($hex,2,2));
  $b = hexdec(substr($hex,4,2));
  }
  $rgb = array($r, $g, $b);
  
  //return $rgb; // returns an array with the rgb values
  
  $Final_Rgb_color = implode(", ", $rgb);
  
  return $Final_Rgb_color;
}

function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

add_image_size( 'sidebar-thumb', 50, 50, true );

function position() {

	$labels = array(
		'name'                => _x( 'Positions', 'Post Type General Name', 'cli_theme' ),
		'singular_name'       => _x( 'Position', 'Post Type Singular Name', 'cli_theme' ),
		'menu_name'           => __( 'Open Positions', 'cli_theme' ),
		'name_admin_bar'      => __( 'Open Positions', 'cli_theme' ),
		'parent_item_colon'   => __( 'Parent Item:', 'cli_theme' ),
		'all_items'           => __( 'All Positions', 'cli_theme' ),
		'add_new_item'        => __( 'Add New Position', 'cli_theme' ),
		'add_new'             => __( 'Add New', 'cli_theme' ),
		'new_item'            => __( 'New Position', 'cli_theme' ),
		'edit_item'           => __( 'Edit Position', 'cli_theme' ),
		'update_item'         => __( 'Update Position', 'cli_theme' ),
		'view_item'           => __( 'View Position', 'cli_theme' ),
		'search_items'        => __( 'Search Position', 'cli_theme' ),
		'not_found'           => __( 'Not found', 'cli_theme' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cli_theme' ),
	);
	$args = array(
		'label'               => __( 'Position', 'cli_theme' ),
		'description'         => __( 'Open job positions', 'cli_theme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-index-card',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'position', $args );

}
add_action( 'init', 'position', 0 );

function team_member() {

	$labels = array(
		'name'                => _x( 'Team Members', 'Post Type General Name', 'cli_theme' ),
		'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'cli_theme' ),
		'menu_name'           => __( 'Team Members', 'cli_theme' ),
		'name_admin_bar'      => __( 'Team Members', 'cli_theme' ),
		'parent_item_colon'   => __( 'Team Member:', 'cli_theme' ),
		'all_items'           => __( 'All Team Members', 'cli_theme' ),
		'add_new_item'        => __( 'Add New Team Member', 'cli_theme' ),
		'add_new'             => __( 'Add New Team Member', 'cli_theme' ),
		'new_item'            => __( 'New Team Member', 'cli_theme' ),
		'edit_item'           => __( 'Edit Team Member', 'cli_theme' ),
		'update_item'         => __( 'Update Team Member', 'cli_theme' ),
		'view_item'           => __( 'View Team Member', 'cli_theme' ),
		'search_items'        => __( 'Search Team Member', 'cli_theme' ),
		'not_found'           => __( 'Not found', 'cli_theme' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cli_theme' ),
	);
	$args = array(
		'label'               => __( 'Team Member', 'cli_theme' ),
		'description'         => __( 'Post Type Description', 'cli_theme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessman',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'team_member', $args );

}
add_action( 'init', 'team_member', 0 );

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

function my_acf_load_field( $field ) {
  
  $theme_fonts = get_field('theme_fonts', 'option');
  
  $font_choices = array();
  
  if($theme_fonts)
  {  
    foreach($theme_fonts as $theme_font)
    {
      $font = $theme_font['theme_font'];
      
      array_push($font_choices, $font["font"]);
    }
  }
  
  $field['choices'] = $font_choices;
  
  return $field;
    
}
add_filter('acf/load_field/name=default_font_family', 'my_acf_load_field');
add_filter('acf/load_field/name=menu_font_family', 'my_acf_load_field');
add_filter('acf/load_field/name=headings_font_family', 'my_acf_load_field');
add_filter('acf/load_field/name=paragraph_font_family', 'my_acf_load_field');

function custom_navigation_menus() {

  $logo_position = get_field('logo_position', 'option');

  $locations = '';

  if($logo_position === 'center'){
    $locations = array(
      'divided-right-menu' => __( 'Divided menu right side', 'cli_theme' ),
      'divided-left-menu' => __( 'Divided menu left side', 'cli_theme' ),
    );
  } else {
    $locations = array(
      'right-menu' => __( 'Main Menu', 'cli_theme' ),
    );
  }
  register_nav_menus( $locations );

}
add_action( 'init', 'custom_navigation_menus' );


function pagination($pages = '', $range = 1){  
  $showitems = ($range * 2)+1;  
  
  global $paged;
  if(empty($paged)) $paged = 1;
  
  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }   
  if(1 != $pages){
    echo '<div class="pagination">';
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'"><i class="fa fa-angle-double-left"></i></a>';
    if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'"><i class="fa fa-angle-left"></i></a>';
    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        echo ($paged == $i)? '<span class="current">'.$i.'</span>':'<a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a>';
      }
    }
    if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'"><i class="fa fa-angle-right"></i></a>';  
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($pages).'"><i class="fa fa-angle-double-right"></i></a>';
    echo '</div>';
  }
}

function my_search_form( $form ) {
  $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
  <input type="text" value="' . get_search_query() . '" name="s" id="s" />
  <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" class="btn black outline" />
  </form>';

  return $form;
}

add_filter( 'get_search_form', 'my_search_form' );