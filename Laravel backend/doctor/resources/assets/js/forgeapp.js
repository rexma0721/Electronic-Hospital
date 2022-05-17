/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./forge-bootstrap');
import Forge from './forge';

window.Vue = require('vue');
window.Event = new class {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null) {
        this.vue.$emit(event, data);
    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }
}
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

Vue.component('alert', require('./components/Alert.vue'));
Vue.component('AuthValidate', require('./components/AuthValidation.vue'));
Vue.component('ImgFileinput', require('./components/ImgFileinput.vue'));

Vue.component('roles', require('./components/admin/Roles.vue'));
Vue.component('permissions', require('./components/admin/Permissions.vue'));
Vue.component('assign-permission', require('./components/admin/AssignPermission.vue'));
Vue.component('administrator', require('./components/admin/Administrator.vue'));
Vue.component('users', require('./components/admin/User.vue'));
const app = new Vue({
    el: '#app',
    mounted() {
        let forge = new Forge('vertical', 'default');
        forge.init();
    }
});
