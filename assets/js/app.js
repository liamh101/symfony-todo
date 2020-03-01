/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../sass/app.scss';
import App from './vue/App';
import Vue from 'vue';
import {BootstrapVue, IconsPlugin} from "bootstrap-vue";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

const app = new Vue({
    el: '#app',
    template: '<App/>',
    components: { App }
});