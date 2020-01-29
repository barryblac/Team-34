/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// Make all functions inside 'vinylShop.js' that start with 'export' accessible inside the HTML pages
window.team34 = require('./main');
window.Noty = require('noty');
// Run the hello() function
team34.hello();

