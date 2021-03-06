
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');
require('sweetalert/dist/sweetalert.min.js');
require('./vendor/metisMenu.min');
//require('./vendor/raphael.min');
//require('./vendor/morris.min');
//require('./vendor/morris-data');
require('./helpers');
require('./utils');
require('./sections/dashboard');

/**
 * Rutas de la Api
 */
/*window.apiRoutes = {
    clients: {
        index: '/api/clients'
    }
};*/

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable partials. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

//Estableciendo Vue en production mode
Vue.config.devtools = false
Vue.config.debug = false
Vue.config.silent = true

/**
 * Plugins para Vue js
 */
import VeeValidate, {Validator} from 'vee-validate';

import es from 'vee-validate/dist/locale/es';
//import moment from 'moment/moment';
window.Moment = require('moment');

Moment.locale('es');

Validator.installDateTimeValidators(Moment);
Validator.addLocale(es);
Vue.use(VeeValidate, {
    locale: 'es',
});

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
