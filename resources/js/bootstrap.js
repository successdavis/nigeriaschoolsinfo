window._ = require('lodash');

let authorizations = require('./authorizations');

Vue.prototype.authorize = function (...params) {
    if (! window.App.signedIn) return false;

    if (typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }

    return params[0](window.App.user);
};


Vue.prototype.signedIn 	= window.App.signedIn;
Vue.prototype.user 		= window.App.user;

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import VModal from 'vue-js-modal'
import Form from './utilities/Form';


import { Table, Loading, Switch} from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Table)
Vue.use(Loading)
Vue.use(Switch)


window.Form = Form;
window.Event = new Vue();


Vue.use(VModal, {dialog: true})

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};