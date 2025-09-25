import $ from 'jquery';
import { createApp } from 'vue';

export default function skillsModule() {
    const app = createApp({
        data() {
            return {
                models: [],
                row: {
                    id: 0,
                    skill: 0,
                },
                has: false,
            };
        },
        mounted() {
            const self = this;
            // Receive models
            $.get('/json/skills', function (data) {
                if (data.length !== 0) {
                    self.models = [];
                    for (let key in data) {
                        data[key].id = self.models.length;
                        self.models.push(data[key]);
                    }
                    self.has = true;
                } else {
                    self.enable();
                }
            });
        },
        methods: {
            addRow() {
                if (this.models.length < 4) {
                    const row = $.extend({}, this.row);
                    row.id = this.models.length;
                    this.models.push(row);
                }
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
            },
        },
    });

    app.mount('#faehigkeiten-view');
    return app;
}
