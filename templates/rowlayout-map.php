<?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();
$item_id = (is_blog()) ? $page_for_posts : $postid; 
$map_marker = get_sub_field('map_marker', $item_id);
$show_locations = get_sub_field('display_table_of_locations', $item_id);
$item_add_animation = get_sub_field('add_item_animation', $item_id);
$animation_class = ($item_add_animation == 1) ? ' wow' : '';
$item_animation_effect = (get_sub_field('item_animation_effect', $item_id)) ? ' ' . get_sub_field('item_animation_effect', $item_id)  : '';
$item_animation_duration = (get_sub_field('item_animation_duration')) ? ' data-wow-duration="' . get_sub_field('item_animation_duration', $item_id) . 's"'  : '';
$item_animation_delay = (get_sub_field('item_animation_delay', $item_id)) ? ' data-wow-delay="' . get_sub_field('item_animation_delay', $item_id) . 's"'  : '';
$item_animation_offset =  (get_sub_field('item_animation_offset', $item_id)) ? ' data-wow-offset="' . get_sub_field('item_animation_offset', $item_id) . '"'  : '';
$animation = ($item_add_animation == 1) ? $item_animation_duration . $item_animation_delay . $item_animation_offset : '';
?>
<div class="col-item<?php echo $animation_class . $item_animation_effect; ?>"<?php echo $animation;?>>
	<?php if( have_rows('locations', $item_id) ): ?>
		<div>
			<div><select id="locationSelect" style="width:100%;visibility:hidden"></select></div>
		</div>
		<div class="acf-map">
			<?php while ( have_rows('locations', $item_id) ) : the_row();  ?>
				<?php $location = get_sub_field('location', $item_id); ?>
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
					<?php get_template_part('templates/rowlayout', 'location'); ?>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
	<?php if( have_rows('locations', $item_id) && $show_locations == 1 ): ?>
		<div class="locations-list">
			<?php while ( have_rows('locations', $item_id) ) : the_row(); ?>
				<?php get_template_part('templates/rowlayout', 'location'); ?>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>
<script src=" https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
	jQuery(function($) { 
		function new_map( $el ) {
	    // var
	    var $markers = $el.find('.marker'); 
	    // vars
	    var args = {
	    	zoom    : 16,
	    	center    : new google.maps.LatLng(0, 0),
	    	mapTypeId : google.maps.MapTypeId.ROADMAP,
	    	mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
	    };
	    // create map           
	    var map = new google.maps.Map( $el[0], args);
	    // add a markers reference
	    map.markers = [];
	    // add markers
	    $markers.each(function(){   
	    	add_marker( $(this), map );   
	    });
	    // center map
	    center_map( map );
	    // return
	    return map;
	  }
	  function add_marker( $marker, map ) {
	    // var
	    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	    // create marker
	    var marker = new google.maps.Marker({
	    	position: latlng,
	    	map: map,
	    	icon: <?php echo "'" . $map_marker . "'"; ?>,
	    });
	    // add to array
	    map.markers.push( marker );
	    // if marker contains HTML, add it to an infoWindow
	    if( $marker.html() )
	    {
	      // create info window
	      var infowindow = new google.maps.InfoWindow({
	      	content   : $marker.html()
	      });
	      // show info window when marker is clicked
	      google.maps.event.addListener(marker, 'click', function() {
	      	infowindow.open( map, marker );
	      });
	    }
	  }
	  function center_map( map ) {
	    // vars
	    var bounds = new google.maps.LatLngBounds();
	    // loop through all markers and create bounds
	    $.each( map.markers, function( i, marker ){
	    	var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
	    	bounds.extend( latlng );
	    });
	    // only 1 marker?
	    if( map.markers.length == 1 )
	    {
	      // set center of map
	      map.setCenter( bounds.getCenter() );
	      map.setZoom( 16 );
	    }
	    else
	    {
	      // fit to bounds
	      map.fitBounds( bounds );
	    }
	  }
	  var map = null;
	  $(document).ready(function(){
	  	$('.acf-map').each(function(){
	      // create map
	      map = new_map( $(this) );
	    });
	  });
	});
</script>