import './bootstrap';

import Vue from "vue";
import Notifications from 'vue-notification'

Vue.component('settings-image-input-component', require('./components/dashboard/SettingsImageInputComponent.vue').default);
// images : upload - list
Vue.component('dropzone-component', require('./components/dashboard/DropzoneComponent.vue').default);
Vue.component('media-list-component', require('./components/dashboard/MediaListComponent.vue').default);
Vue.component('image-input-component', require('./components/dashboard/ImageInputComponent.vue').default);
Vue.component('banner-component', require('./components/dashboard/BannerComponent.vue').default);

Vue.use(Notifications);

Vue.filter('shortDescription', function (value) {
  if (value) {
      return value.slice(0,100) + '....'
  }
})


const app = new Vue({
    el: '#app',
});
