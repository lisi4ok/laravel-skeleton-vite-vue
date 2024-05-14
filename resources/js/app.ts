import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import { QuillEditor } from '@vueup/vue-quill';
import VueDatePicker from '@vuepic/vue-datepicker';
// import { translations } from './translations';


import.meta.glob(['../assets/fonts/**']);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Link', Link)
            .component('Head', Head)
            .component('QuillEditor', QuillEditor)
            .component('VueDatePicker', VueDatePicker)
            //.mixin(translations)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
