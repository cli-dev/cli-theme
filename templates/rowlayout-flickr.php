<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $user_id = get_sub_field('user_id', $item_id);
  $number_of_photos = get_sub_field('number_of_photos', $item_id);
  $is_slider = get_sub_field('is_slider', $item_id);

?>
        
<div class="flickr-wrapper<?php if ($is_slider == 1) { echo ' owl-carousel'; } echo ' ' .$custom_class;?>"></div> 
        
<script type="text/javascript">
jQuery(document).ready(function($) {
  
var endpoint = "https://api.flickr.com/services/rest/"
var apiKey = "d68a0e53fd8a83221f86bdbaecc40d76";
var userId = encodeURIComponent(<?php echo '"' . $user_id . '"'; ?>);
var extras = "url_o";
var photoNum = <?php echo $number_of_photos; ?>;
var method = "flickr.people.getPublicPhotos";

var request = endpoint+"?method="+method+
            "&api_key="+apiKey+
            "&user_id="+userId+
            "&extras="+extras+
            "&per_page="+photoNum+
            "&format=json&nojsoncallback=1";
$.getJSON(request,function(data){
        
//loop through the results with the following function
  $.each(data.photos.photo, function(i,item){

    //build the url of the photo in order to link to it
    var photoURL = item.url_o;

    var photoTitle = item.title;

    var photoStructure = '<div><a href="' + photoURL + '" rel="flickr-gallery" title="' + photoTitle + '" class="flickr-img" style="background: url(' + photoURL + ') center no-repeat; background-size: cover;"></a></div>';

    $(photoStructure).appendTo('.flickr-wrapper');
    
  });

});

$(".flickr-img").fancybox({
  padding: 0,
  beforeLoad: function() {
    this.title = $(this.element).attr('title');
  }
});

<?php if ($is_slider == 1) { ?>
  $('.owl-carousel').owlCarousel({
    items: 1,
    nav: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
  });
<?php } ?>

});

</script>