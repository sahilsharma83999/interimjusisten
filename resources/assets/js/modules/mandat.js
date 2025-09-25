import $ from 'jquery';
import { createApp } from 'vue';

export default function mandate() {
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
                    branch: 1,
                    umsatz: 0,
                    ma: 0,
                    worker: 0,
                    budget: 0,
                    description: ""
                },
                has: false,
            };
        },
        mounted() {
            // Fetch models from server
            $.get('/json/mandat', (data) => {
                if (data.length !== 0) {
                    this.models = [];
                    data.forEach(item => {
                        item.id = this.models.length;
                        this.models.push(item);
                    });
                    this.has = true;
                }
            });
        },
        methods: {
            addRow() {
                const row = { ...this.row };
                row.id = this.models.length;
                this.models.push(row);
            },
            removeRow() {
                if (this.models.length !== 1) this.models.pop();
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

    app.mount('#mandate-view');
    return app;
}
