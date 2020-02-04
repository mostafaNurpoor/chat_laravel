window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: false,
    authEndpoint: 'http://localhost/laravel/chat/public/broadcasting/auth',
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    auth:{
        headers: {
            Authorization: document.getElementById("token").value,
        },
    },
    // encrypted: false,
    // wsHost: window.location.hostname,
    // wsPort: 6001,
});

// var receiverId = document.getElementById('receiver_id').value;
// window.Echo.private(`chatChannel.` + receiverId)
//     .listen('.new.message', (e) => {
//         console.log(e);
//     });
//console.log(document.getElementById('token').value);
