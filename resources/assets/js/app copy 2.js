import { createApp } from 'vue';
import './bootstrap';

// Import components
import AdminSearch from './components/AdminSearch.vue';
import Ausland from './components/Ausland.vue';
import Mandat from './components/Mandat.vue';
import Karriere from './components/Karriere.vue';
import Dokumente from './components/Dokumente.vue';
import Skills from './components/Skills.vue';
import Verantwortung from './components/Verantwortung.vue';
import Schwerpunkte from './components/Schwerpunkte.vue';
import Search from './components/Search.vue';

// Create a single app instance
const app = createApp({});

// Register components globally
app.component('admin-search', AdminSearch);
app.component('ausland-view', Ausland);
app.component('mandat-view', Mandat);
app.component('karriere-view', Karriere);
app.component('dokumente-view', Dokumente);
app.component('skills-view', Skills);
app.component('verantwortung-view', Verantwortung);
app.component('schwerpunkte-view', Schwerpunkte);
app.component('search-view', Search);

// Mount app to wrapper elements
const mounts = [
    { id: '#admin-search-app' },
    { id: '#ausland-app' },
    { id: '#mandat-app' },
    { id: '#karriere-app' },
    { id: '#dokumente-app' },
    { id: '#skills-app' },
    { id: '#verantwortung-app' },
    { id: '#schwerpunkte-app' },
    { id: '#search-app' },
];

mounts.forEach((mount) => {
    const el = document.querySelector(mount.id);
    if (el) {
        // Mount a new app instance per wrapper
        createApp({}).component('component-wrapper', app._context.components).mount(el);
    }
});
