window.Vue = require('vue');
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/LoginForm.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('login-form', require('./auth/LoginForm').default);
