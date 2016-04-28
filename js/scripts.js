jQuery(document).ready(function($) {

  var wH = $(window).height(); 
  var fH = $('#footer').height();
  var cH = wH - fH;

  $('#container').css('min-height', cH);
  $("html").niceScroll({
    mousescrollstep: 60,
    horizrailenabled: false
  });
  $(window).resize(function(event) {
    var wH2 = $(window).height(); 
    var fH2 = $('#footer').height();
    var cH2 = wH2 - fH2;
    $('#container').css('min-height', cH2);

  });
  $('.menu-mobile-container').hide();
  $('.menu-button-area').click(function(){
    if($(window).width() >= 900){
      if($(this).hasClass('active')){
        $(this).removeClass('active');
        $('.menu-button').removeClass('active');
        $('.menu-container').removeClass('active');
        $('#side-menu').removeClass('active');
        $('.menu-button-txt').html('Menu');
      }
      else{
        $(this).addClass('active');
        $('.menu-button').addClass('active');
        $('#side-menu').addClass('active');
        $('.menu-container').addClass('active');
        $('.menu-button-txt').html('Close');
      }
    }
    else{
      if($('.menu-mobile-container').css('display') === 'none'){
        $(this).addClass('active');
        $('.menu-button').addClass('active');
        $('.menu-mobile-container').slideDown();
        $('.menu-button-txt').html('Close');
      }
      else if($('.menu-mobile-container').css('display') === 'block'){
        $(this).removeClass('active');
        $('.menu-button').removeClass('active');
        $('.menu-mobile-container').slideUp();
        $('.menu-button-txt').html('Menu');
      } 
      else{
        if($(this).hasClass('active')){
          $(this).removeClass('active');
          $('.menu-button').removeClass('active');
          $('.menu-container').removeClass('active');
          $('#side-menu').removeClass('active');
          $('.menu-button-txt').html('Menu');
        }
        else{
          $(this).addClass('active');
          $('.menu-button').addClass('active');
          $('#side-menu').addClass('active');
          $('.menu-container').addClass('active');
          $('.menu-button-txt').html('Close');
        }
      }
    }
  });  
  $('.special-btn').each(function(){
    if($(this).hasClass('fill-space')){
      var maxHeight = $(this).height();
      $(this).children('.panel').height(maxHeight-4);
      $(this).css('max-height', maxHeight);
    }
    else{
      var elementHeights = $(this).children('.panel').map(function() {
        return $(this).outerHeight(true);
      }).get();
      var maxHeight2 = Math.max.apply(null, elementHeights);
      $(this).children('.panel').height(maxHeight2);
      $(this).height(maxHeight2);
      var elementWidths = $(this).find('.panel-inner').map(function() {
        return $(this).width();
      }).get();
      var maxWidth = Math.max.apply(null, elementWidths);
      $(this).find('.panel-inner').width(maxWidth);
    }
  }); 
  var wow = new WOW({
    mobile: false, 
  });
  wow.init();
  $(window).scroll(function() {
    if ($(window).scrollTop() >= 400) {
      $('#scrollTop').addClass('show');
    }
    else if ($(window).scrollTop() <= 300) {
      $('#scrollTop').removeClass('show');
    }
  });
  $('#scrollTop').click(function(){
    $(window).scrollTo($('#top'), 500, {onAfter:function() { $('#scrollTop').removeClass('show'); } });  
  });
  $('.position-form').hide(); 
  $('.show-apply-form').click(function(){
    if($('.position-form').css('display') === 'none'){
      $('.position-form').slideDown();
    }
    else{
      $('.position-form').slideUp();
    }
  });
  $('.sub-menu').hide();
  $('li.menu-item-has-children').append('<span class="sub-menu-icon genericon genericon-expand"></span>');
  $('.menu-mobile-container li.menu-item-has-children').click(function(){
    if($(this).children('.sub-menu').css('display') === 'none'){
      $('.sub-menu').slideUp();
      $('.sub-menu-icon').removeClass('genericon-collapse').addClass('genericon-expand');
      $(this).children('.sub-menu').slideDown();
      $(this).children('.sub-menu-icon').removeClass('genericon-expand').addClass('genericon-collapse');
    } else{
      $(this).children('.sub-menu').slideUp();
      $(this).children('.sub-menu-icon').removeClass('genericon-collapse').addClass('genericon-expand');
    }
  });
  $('.header-inner .menu-container > .menu > li.menu-item-has-children').hoverIntent(
    function(){
      $(this).children('.sub-menu').slideDown();
      $(this).children('.sub-menu-icon').removeClass('genericon-expand').addClass('genericon-collapse');
    },
    function(){
      $(this).children('.sub-menu').slideUp();
      $(this).children('.sub-menu-icon').removeClass('genericon-collapse').addClass('genericon-expand');
    }
  )
  $('.sticky-header.headhesive .menu-container > .menu > li.menu-item-has-children').hoverIntent(
    function(){
      $(this).children('.sub-menu').slideDown();
      $(this).children('.sub-menu-icon').removeClass('genericon-expand').addClass('genericon-collapse');
    },
    function(){
      $(this).children('.sub-menu').slideUp();
      $(this).children('.sub-menu-icon').removeClass('genericon-collapse').addClass('genericon-expand');
    }
  )
});