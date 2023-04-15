'use strict';
// mobile menu js
$(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
  const element = $(this).parent("li");
  if (element.hasClass("open")) {
    element.removeClass("open");
    element.find("li").removeClass("open");
  }
  else {
    element.addClass("open");
    element.siblings("li").removeClass("open");
    element.siblings("li").find("li").removeClass("open");
  }
});

const widgetBtn = $('.sidebar-widget .title-btn');
const widgetBody = $('.sidebar-widget__body');

widgetBtn.each(function(){
  $(this).on('click', function(){
    $(this).parent().siblings(widgetBody).slideToggle();
  });
});

const selectMenuItem = $('.select-menu-list > li');
selectMenuItem.each(function(){
  $(this).on('click', function(){
    var el = $(this);
    if (el.hasClass('active')) {
      el.toggleClass('active').siblings().show();
    }else{
      el.toggleClass('active').siblings().hide();
    }
  });
});


//preloader js code
$(".preloader").delay(300).animate({
	"opacity" : "0"
	}, 300, function() {
	$(".preloader").css("display","none");
});

// Show or hide the sticky footer button
$(window).on("scroll", function() {
  if ($(this).scrollTop() > 200) {
      $(".scroll-to-top").fadeIn(200);
  } else {
      $(".scroll-to-top").fadeOut(200);
  }
});

// Animate the scroll to top
$(".scroll-to-top").on("click", function(event) {
  event.preventDefault();
  $("html, body").animate({scrollTop: 0}, 300);
});

// lightcase plugin init
$('a[data-rel^=lightcase]').lightcase();

// main wrapper calculator
var bodySelector = document.querySelector('body');
var header = document.querySelector('.header');
var footer = document.querySelector('.footer');
(function(){
  if(bodySelector.contains(header) && bodySelector.contains(footer)){
    var headerHeight = document.querySelector('.header').clientHeight;
    var footerHeight = document.querySelector('.footer').clientHeight;

    // if header isn't fixed to top
    var totalHeight = parseInt( headerHeight, 10 ) + parseInt( footerHeight, 10 ) + 'px'; 
    
    // if header is fixed to top
    // var totalHeight = parseInt( footerHeight, 10 ) + 'px'; 
    var minHeight = '100vh';
    document.querySelector('.main-wrapper').style.minHeight = `calc(${minHeight} - ${totalHeight})`;
  }
})();

// Animate the scroll to top
$(".scroll-top").on("click", function(event) {
	event.preventDefault();
	$("html, body").animate({scrollTop: 0}, 300);
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip({
    boundary: 'window'
  })
});

// custom input animation js
$('.custom--form-group .form--control').on('input', function(){
  let passfield = $(this).val();
  if (passfield.length < 1){
      $(this).removeClass('hascontent');
  }else{
      $(this).addClass('hascontent');
  }
});

const bookmarkBtn = $('.bookmark-btn');
bookmarkBtn.on('click', function(){
  $(this).toggleClass('active');
});



/* ==============================
					slider area
================================= */

// featured-product-slider
$('.featured-product-slider').slick({
  // autoplay: true,
  autoplaySpeed: 2000,
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  arrows: true,
  prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
  nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1500,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 1400,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
      }
    }
  ]
});

// testimonial-slider
$('.testimonial-slider').slick({
  // autoplay: true,
  autoplaySpeed: 2000,
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  arrows: false,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1400,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 1,
      }
    }
  ]
});

// brand-slider js 
$('.brand-slider').slick({
  autoplay: true,
  autoplaySpeed: 2000,
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 6,
  arrows: false,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 5,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
      }
    }
  ]
});