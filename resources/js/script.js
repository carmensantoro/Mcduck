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
let navbarBrand = document.querySelector('#navbarBrand')
let navbarCTAScroll = document.querySelector('#navbarCTAScroll')


if (window.innerWidth > 576) {
    document.addEventListener('scroll', () => {
        if (window.pageYOffset > 20) {
            navbar.classList.remove('bg-transparent')
            navbar.classList.add('bg-white', 'shadow')
            navbarBrand.classList.add('text-dark')
            navbarBrand.classList.remove('text-white')
                //navbarBrand.src = "dove si trova il logo" 
        } else {
            navbar.classList.remove('bg-white', 'shadow')
            navbar.classList.add('bg-transparent')
            navbarBrand.classList.add('text-white')
            navbarBrand.classList.remove('text-dark')
                // navbarBrand.src = "dove si trova l'altro logo", mettendo questo pezzo di codice, sia in if che else
                // ci permetterà di cambiare il logo al movimento dela navbar
        }


        if (window.pageYOffset > window.innerHeight) {
            navbarCTAScroll.classList.remove('d-none')
        } else {
            navbarCTAScroll.classList.add('d-none')
        }
    })
} else {
    navbarBrand.classList.add('bg-white')
        //navbarBrand.src = "dove si trova il logo" che cambierà il logo superata la wall default
}