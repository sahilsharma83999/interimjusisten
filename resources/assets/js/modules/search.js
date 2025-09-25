import $ from 'jquery';
import { createApp } from 'vue';

export default function searchModule() {
    const app = createApp({
        data() {
            return {
                searchValue: ''
            };
        },
        watch: {
            searchValue(value) {
                if (value) {
                    window.location = '/suche/' + value;
                }
            }
        },
        mounted() {
            // Any additional setup if needed
        },
        methods: {
            // Add any methods if required
        }
    });

    // app.mount('#search-field');
    return app;
}
