// preloader
jQuery(window).on('load', function() {
  jQuery('#status').fadeOut();
  jQuery('#preloader').delay(350).fadeOut('slow');
  jQuery('body').delay(350).css({'overflow':'visible'});
})

// toggle button
jQuery(function($){
  $( '.toggle-nav button' ).click( function(e){
    $( 'body' ).toggleClass( 'show-main-menu' );
    var element = $( '.sidenav' );
    ayurvedic_medicine_trapFocus( element );
  });

  $( '.close-button' ).click( function(e){
    $( '.toggle-nav button' ).click();
    $( '.toggle-nav button' ).focus();
  });
  $( document ).on( 'keyup',function(evt) {
    if ( $( 'body' ).hasClass( 'show-main-menu' ) && evt.keyCode == 27 ) {
      $( '.toggle-nav button' ).click();
      $( '.toggle-nav button' ).focus();
    }
  });
});

function ayurvedic_medicine_trapFocus(element) {
  var focusableElementsSelector = 'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])';
  var focusableEls = element.find(focusableElementsSelector).filter(':visible');
  var firstFocusableEl = focusableEls[0];
  var lastFocusableEl = focusableEls[focusableEls.length - 1];
  var KEYCODE_TAB = 9;

  element.on('keydown', function(e) {
    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);
    if (!isTabPressed) {
      return;
    }

    if (e.shiftKey) {
      // Shift + Tab
      if (document.activeElement === firstFocusableEl) {
        lastFocusableEl.focus();
        e.preventDefault();
      }
    } else {
      // Tab
      if (document.activeElement === lastFocusableEl) {
        firstFocusableEl.focus();
        e.preventDefault();
      }
    }
  });
}

// scroll to top
jQuery(document).ready(function () {
  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 0) {
      jQuery('#button').fadeIn();
    } else {
      jQuery('#button').fadeOut();
    }
  });
  jQuery('#button').click(function () {
    jQuery("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
});

// Sticky Header
jQuery('document').ready(function($){
  $(window).scroll(function(){
    var sticky = $('.is-sticky-on'),
      scroll = $(window).scrollTop();

    if (scroll >= 100) sticky.addClass('header-sticky');
    else sticky.removeClass('header-sticky');
  });
});

// Timer
jQuery(document).ready(function(){
  var ayurvedic_medicine_mydate =jQuery('.date').val();
  jQuery(".countdown").each(function(){
    ayurvedic_medicine_countdown(jQuery(this),ayurvedic_medicine_mydate);
  });
});

function ayurvedic_medicine_countdown($ayurvedic_medicine_timer,ayurvedic_medicine_mydate){
  var ayurvedic_medicine_countDownDate = new Date(ayurvedic_medicine_mydate).getTime();
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = ayurvedic_medicine_countDownDate - now;
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    $ayurvedic_medicine_timer.html( "<div class='numbers'><span class='count'>" + days + "</span><span class='text'>Days</span>" + "</div>" + "   " +"<div class='numbers'><span class='count'>" + hours + "</span><span class='text'>Hrs</span>" + "</div>" + "   " + "<div class='numbers'><span class='count'>" + minutes + "</span><span class='text'>Mins</span>" + "</div>" + "   " + "<div class='numbers'><span class='count'>" + seconds + "</span><span class='text'>Sec</spn" + "</div>");

    if (distance < 0) {
      clearInterval(x);
      $ayurvedic_medicine_timer.html("EXPIRED");
    }
  }, 1000);
}