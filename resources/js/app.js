require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { InertiaProgress } from '@inertiajs/progress';
import { addEcho, removeEcho } from './Utils/echo';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Nimbus';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('Link', Link)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

window.openImChannels = [];
Inertia.on('navigate', (event) => {
    if (event.detail.page.component.toLowerCase().includes('webgame')) {
        addEcho();
    } else {
        for (let i = 0; i < window.openImChannels.length; i++) {
            window.Echo.leave(window.openImChannels[i]);
        }

        removeEcho();
    }
});

InertiaProgress.init({ color: '#4B5563' });
