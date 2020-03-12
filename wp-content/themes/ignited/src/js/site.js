try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

const LazyLoad = require('vanilla-lazyload');

require('bootstrap');
require('popper.js');
require('cloud9carousel');

var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});