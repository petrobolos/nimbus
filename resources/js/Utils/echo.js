'use strict';

import Echo from 'laravel-echo';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/**
 * Add a Laravel Echo instance to the application.
 * @returns {void}
 */
const addEcho = () => {
    window.Pusher = require('pusher-js');

    if (! window.echo) {
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            forceTLS: true,
        });
    }
};

/**
 * Unsets Laravel Echo if it is currently active.
 * @returns {void}
 */
const removeEcho = () => {
  if (window.Echo) {
      window.Echo.disconnect();
      window.Echo = null;
  }
};

export {
    addEcho,
    removeEcho,
};
