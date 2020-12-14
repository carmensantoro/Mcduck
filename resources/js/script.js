// Slick
$(document).ready(function () {
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

// Per i favoriti
window.favor = function ($id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (!this.responseText) {
        document.getElementById(`${$id}`).classList.toggle("far");
        document.getElementById(`${$id}`).classList.toggle("fas");
      } else {
        alert(this.responseText);
      }
    }
  };
  xmlhttp.open("GET", `/user/favorites/${$id}`, true);
  xmlhttp.send();
}


//Navbar
let navbar = document.querySelector('#navbar')

if (window.innerWidth > 576) {
    document.addEventListener('scroll', () => {
        if (window.pageYOffset > 20) {
            navbar.classList.add('shadow')
        } else {
            navbar.classList.remove('shadow')
        }
      })}