import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
import HomePage from './components/HomePage.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createApp(HomePage).mount('#app');

// This will set light / dark mode on page load...
initializeTheme();
