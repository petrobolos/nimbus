import axios from 'axios';
import * as _ from 'lodash';
import jQuery from 'jquery';
import * as Popper from 'popper.js';
import 'bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token: HTMLMetaElement | null = document.head!.querySelector(
  'meta[name="csrf-token"]',
);

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error(
    'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token',
  );
}

(<any>window).Pusher = Pusher;

(<any>window).Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  wsHost: process.env.MIX_PUSHER_HOST,
  wsPort: process.env.MIX_PUSHER_PORT,
  forceTLS: (process.env.APP_ENV = 'local' ? 'false' : 'true'),
});
