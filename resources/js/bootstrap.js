window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Page visibility API
if (typeof document.hidden !== 'undefined') {
    // Opera 12.10 / Firefox 18 support
    window.hidden = 'hidden';
    window.visibilityChange = 'visiblitychange';
} else if (typeof document.msHidden !== 'undefined') {
    window.hidden = 'msHidden';
    window.visibilityChange = 'msvisibilitychange';
} else if (typeof document.webkitHidden !== `undefined`) {
    window.hidden = 'webkitHidden';
    window.visibilityChange = 'webkitvisibilitychange';
}
