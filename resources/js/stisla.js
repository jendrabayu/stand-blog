require('./bootstrap')

require('./stisla/stisla')
require('./stisla/scripts')


window.Vue = require('vue').default;
window.moment = require('moment')
window.Swal = require('sweetalert2')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('category-component', require('./components/category/CategoryComponent.vue').default);
Vue.component('tag-component', require('./components/tag/TagComponent.vue').default);
Vue.component('post-component', require('./components/post/PostComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
});

