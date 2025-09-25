import { createApp } from 'vue';
import AdminSearch from './components/AdminSearch.vue';
import './bootstrap'; // <-- Make sure this is imported for Axios/CSRF

const app = createApp({});
app.component('admin-search', AdminSearch);
app.mount('#admin-search-app');