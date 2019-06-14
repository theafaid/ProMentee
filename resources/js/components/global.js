const _ = require('lodash');

window.Vue = require('vue');
import Vue from 'vue'



Vue.prototype.trans = (string, args) => {
    let value = _.get(window.i18n, string);

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};

Vue.prototype.pluck = (array, key) => {
    return array.map(o => o[key]);
}

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: 'is-valid',
        invalid: 'is-invalid'
    },
    validity: true
});

/** Global Components **/

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.component('login-form', require('./auth/LoginForm').default);
Vue.component('registration-form', require('./auth/RegistrationForm').default);
Vue.component('set-fields', require('./user/fields/SetFields').default);
Vue.component('create-post', require('./posts/create').default);
Vue.component('post', require('./pages/Post').default);
