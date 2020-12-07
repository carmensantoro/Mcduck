// slick
$(document).ready(function(){
    $('.product-img-detail').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.product-img-nav'
      });
      $('.product-img-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.product-img-detail',
        dots: true,
        centerMode: true,
        focusOnSelect: true
      });
    });
