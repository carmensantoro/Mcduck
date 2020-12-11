require('./bootstrap');
require('./script');

//Slick
require('./../../node_modules/slick-carousel/slick/slick.min');

//Dropzone
window.Dropzone = require('dropzone');
Dropzone.autoDiscover = false;

require('./adImages.js')