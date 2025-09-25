import $ from 'jquery';
import { createApp } from 'vue';

export default function verantwortungModule() {
    const app = createApp({
        data() {
            return {
                personal: [],
                umsatz: [],
                budget: [],
                einkauf: [],
                row: {
                    id: 0,
                    type: 0,
                    amount: 0,
                    period: 0,
                },
                has: false,
            };
        },
        mounted() {
            const self = this;
            // Receive models
            $.get('/json/verantwortung', function (data) {
                if (data.length !== 0) {
                    for (let key in data) {
                        switch (data[key].type) {
                            case 'personal':
                                data[key].id = self.personal.length;
                                self.personal.push(data[key]);
                                break;
                            case 'umsatz':
                                data[key].id = self.umsatz.length;
                                self.umsatz.push(data[key]);
                                break;
                            case 'budget':
                                data[key].id = self.budget.length;
                                self.budget.push(data[key]);
                                break;
                            case 'einkauf':
                                data[key].id = self.einkauf.length;
                                self.einkauf.push(data[key]);
                                break;
                        }
                    }
                    self.has = true;
                }
            });
        },
        methods: {
            addRowPersonal() {
                const row = $.extend({}, this.row);
                row.id = this.personal.length;
                this.personal.push(row);
            },
            removeRowPersonal() {
                if (this.personal.length !== 1) this.personal.pop();
            },
            addRowUmsatz() {
                const row = $.extend({}, this.row);
                row.id = this.umsatz.length;
                row.amount = 5;
                row.period = 100;
                this.umsatz.push(row);
            },
            removeRowUmsatz() {
                if (this.umsatz.length !== 1) this.umsatz.pop();
            },
            addRowBudget() {
                const row = $.extend({}, this.row);
                row.id = this.budget.length;
                row.amount = 10;
                row.period = 200;
                this.budget.push(row);
            },
            removeRowBudget() {
                if (this.budget.length !== 1) this.budget.pop();
            },
            addRowEinkauf() {
                const row = $.extend({}, this.row);
                row.id = this.einkauf.length;
                row.amount = 15;
                row.period = 300;
                this.einkauf.push(row);
            },
            removeRowEinkauf() {
                if (this.einkauf.length !== 1) this.einkauf.pop();
            },
        },
    });

    app.mount('#verantwortung-view');
    return app;
}
