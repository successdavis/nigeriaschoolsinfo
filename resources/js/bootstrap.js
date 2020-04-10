

window._ = require('lodash');

window.Vue = require('vue');

let authorizations = require('./authorizations');

window.Vue.prototype.authorize = function (...params) {
    if (! window.App.signedIn) return false;

    if (typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }

    return params[0](window.App.user);
};


Vue.prototype.signedIn = window.App.signedIn;

import VModal from 'vue-js-modal'
import Form from './utilities/Form';

window.Form = Form;

Vue.use(VModal)

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};