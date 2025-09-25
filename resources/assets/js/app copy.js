import './bootstrap';
import { createApp } from 'vue';

// Example: mount Vue on a #app element
import AdminSearch from './components/AdminSearch.vue';

createApp({
    components: { AdminSearch }
}).mount('#app');
