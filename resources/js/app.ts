import './bootstrap';
import '../css/app.css';

import {createApp, DefineComponent, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import {registerIcons, registerSweetalert2} from "@/plugins";
import locationBack from "@/plugins/locationBack";

const appName = import.meta.env.VITE_APP_NAME || 'apps4macs';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)});

        registerIcons(app);
        registerSweetalert2(app);

        app
            .use(plugin)
            .use(ZiggyVue)
            .use(locationBack)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
