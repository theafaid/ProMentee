window.Vue = require('vue');
import Vue from 'vue'

Vue.prototype.trans = string => _.get(window.i18n, string); // Translation variable

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;


/** Global Components **/

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.component('login-form', require('./auth/LoginForm').default);
