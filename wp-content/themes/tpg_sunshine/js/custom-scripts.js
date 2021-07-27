/**
 * Smooth Scrolling
**/

jQuery(document).ready(function ($) {
   // Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .not('.panel a')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 120
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
});

// hamburger toggle function
var hamburgerToggle = function(t) {
    let hamburger = t.classList;
    let masthead = document.querySelector('.navigation-section').classList;
    if (hamburger.contains('is-active')) {
        hamburger.remove('is-active');
        masthead.remove('expand');
    } else {
        hamburger.add('is-active');  
        masthead.add('expand');
    }
}

var scrollCheck = function() {
    if (window.scrollY !== 0) {
        document.querySelector('.navigation-section').classList.add('scrolled');
    } else {
        document.querySelector('.navigation-section').classList.remove('scrolled');
    }
}

window.addEventListener('scroll', scrollCheck);

var validatesAsRequired = document.querySelectorAll('.wpcf7-validates-as-required');

if (validatesAsRequired.length !== 0) {
    for (i = 0; i < validatesAsRequired.length; i++) {
        validatesAsRequired[i].required = true;
    }
}

var cf7Forms = document.querySelectorAll('.wpcf7-form');

if (cf7Forms.length !== 0) {
    for (i = 0; i < cf7Forms.length; i++) {
        cf7Forms[i].removeAttribute('novalidate');
        cf7Forms[i].setAttribute('validate', true);
    }
}

window.onload = function() {
    scrollCheck(); 
}

jQuery(document).ready(function(){
    $('button.hamburger').on('click', function(){
        $('body').toggleClass('lock');
    });
});