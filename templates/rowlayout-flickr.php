<?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();
$item_id = (is_blog()) ? $page_for_posts : $postid;
$custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
$user_id = get_sub_field('user_id', $item_id);
$number_of_photos = get_sub_field('number_of_photos', $item_id);
$is_slider = get_sub_field('is_slider', $item_id);
$columns_on_desktop = get_sub_field('columns_on_desktop', $item_id);
$columns = intval($columns_on_desktop);
$column_spacing = get_sub_field('grid_spacing', $item_id);
$gallery_negative_margin = ($column_spacing) ? '" style="margin: -' . ($column_spacing/2) . 'px"' : '"';
$gallery_spacing = ($column_spacing) ? ' style="padding: ' . ($column_spacing/2) . 'px"' : ''; 
$hover_panel_background_color = (get_sub_field('hover_color', $item_id)) ? hex2rgb(get_sub_field('hover_color', $item_id)) : '';
$bg_color_opacity = (get_sub_field('hover_color_opacity', $item_id)) ? get_sub_field('hover_color_opacity', $item_id) : '';
$hover_bg = ($hover_panel_background_color) ? ' style="background-color: rgba(' . $hover_panel_background_color . ',' . $bg_color_opacity . ');"' : '';
$hover_icon_color = (get_sub_field('hover_icon_color', $item_id)) ? ' style="color: ' . get_sub_field('hover_icon_color', $item_id) . '"' : '';
$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';
$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>

<div class="col-item<?php echo $animation_class . $item_animation_effect . $custom_class; ?>"<?php echo $animation;?>>    
  <div class="flickr-wrapper<?php if ($is_slider == 1) { echo ' owl-carousel'; } else { echo $gallery_negative_margin; }?>"></div> 
</div>
        
<script type="text/javascript">
  jQuery(document).ready(function($) {
    var endpoint = "https://api.flickr.com/services/rest/"
    var apiKey = "d68a0e53fd8a83221f86bdbaecc40d76";
    var userId = encodeURIComponent(<?php echo '"' . $user_id . '"'; ?>);
    var extras = "url_o";
    var photoNum = <?php echo $number_of_photos; ?>;
    var method = "flickr.people.getPublicPhotos";
    var request = endpoint+"?method="+method+"&api_key="+apiKey+"&user_id="+userId+"&extras="+extras+"&per_page="+photoNum+"&format=json&nojsoncallback=1";

    $.getJSON(request,function(data){        
      $.each(data.photos.photo, function(i,item){
        var photoURL = item.url_o;
        var photoTitle = item.title;
        var photoStructure = '<div class="flickr-img-wrapper"<?php if ($is_slider !== 1) { echo $gallery_spacing; } ?>><a href="' + photoURL + '" rel="flickr-gallery" title="' + photoTitle + '" class="flickr-img" style="background: url(' + photoURL + ') center no-repeat; background-size: cover;"><span class="hover-panel"<?php echo $hover_bg; ?>><i class="flickr-zoom fa fa-search-plus"<?php echo $hover_icon_color; ?>></i></span></a></div>';
        $(photoStructure).appendTo('.flickr-wrapper');
      });
    });

    $(".flickr-img").fancybox({
      padding: 0,
      margin: [50, 40, 20, 40],
      beforeLoad: function() {
        this.title = $(this.element).attr('title');
      }
    });

    $(window).load(function() {

    var columns = <?php echo $columns; ?>;

    <?php if ($is_slider == 1) { ?>
      if(columns == 1){
        $('.flickr-wrapper.owl-carousel').owlCarousel({
          items: 1,
          loop: true,
          margin: 0,
          nav: true,
          navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
        });
      } else if (columns == 2) {
        $('.flickr-wrapper.owl-carousel').owlCarousel({
          items: 1,
          loop: true,
          margin: 0,
          nav: true,
          navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
          responsive:{
            500:{
              items:2,
              margin: <?php echo $column_spacing; ?>,
            }
          }
        });
      } else if (columns >= 3) {
        $('.flickr-wrapper.owl-carousel').owlCarousel({
          items: 1,
          loop: true,
          margin: 0,
          nav: true,
          navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
          responsive:{
            500:{
              items:2,
              margin: <?php echo $column_spacing; ?>,
            },
            800:{
              items:3,
              margin: <?php echo $column_spacing; ?>,
            },
            1200:{
              items:columns,
              margin: <?php echo $column_spacing; ?>,
            }
          }
        });

      }

      var owlDots = $('.owl-dots').outerHeight();

      $('.owl-carousel').css('padding-bottom', owlDots);

      $(window).resize(function(event) {
        var owlDots2 = $('.owl-dots').outerHeight();

        $('.owl-carousel').css('padding-bottom', owlDots2);
      });

    <?php } else { ?>
      var maxWidth = 1/columns * 100;

      if($(window).width() >= 1000){
        $('.flickr-img-wrapper').css('width', maxWidth + '%');
      }

      $(window).resize(function(event) {
        if($(window).width() >= 1000){
          $('.flickr-img-wrapper').css('width', maxWidth + '%');
        } else if($(window).width() >= 600){
          $('.flickr-img-wrapper').css('width','50%');
        }
        else{
          $('.flickr-img-wrapper').css('width', 'auto');
        }
      });
    <?php } ?>
    });
  });
</script>