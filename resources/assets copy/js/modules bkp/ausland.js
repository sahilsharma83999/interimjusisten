import $ from 'jquery';
import { createApp } from 'vue';

export default function initAusland() {
    const app = createApp({
        data() {
            return {
                models: [],
                row: {
                    id: 0,
                    fmonth: 1,
                    fyear: 1970,
                    tmonth: 1,
                    tyear: 1970,
                    branche: 0,
                    description: ""
                },
                has: false,
            };
        },
        mounted() {
            // Fetch initial models from backend
            $.get('/json/ausland', (data) => {
                if (data.length !== 0) {
                    this.models = [];
                    for (let key in data) {
                        data[key].id = this.models.length;
                        this.models.push(data[key]);
                    }
                    this.has = true;
                }
            });
        },
        methods: {
            addRow() {
                const row = $.extend({}, this.row);
                row.id = this.models.length;
                this.models.push(row);
            },
            removeRow() {
                if (this.models.length > 1) {
                    this.models.pop();
                }
            },
            purgeAll() {
                this.has = false;
                this.models = [];
            },
            enable() {
                this.has = true;
                this.addRow();
            }
        }
    });

    app.mount('#auslands-projekts-view');
    return app;
}
