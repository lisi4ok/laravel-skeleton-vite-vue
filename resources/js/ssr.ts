import { createSSRApp, h, DefineComponent } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import { QuillEditor } from '@vueup/vue-quill';
import VueDatePicker from '@vuepic/vue-datepicker';
//import { translations } from './translations';

import.meta.glob(['../assets/fonts/**']);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.url),
                })
                .component('Link', Link)
                .component('Head', Head)
                .component('QuillEditor', QuillEditor)
                .component('VueDatePicker', VueDatePicker)
                //.mixin(translations)
                ;
        },
        progress: {
            color: '#4B5563',
        },
    })
);
