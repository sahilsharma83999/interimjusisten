import $ from 'jquery';
import { createApp } from 'vue';

export default function dokumenteModule() {
    const app = createApp({
        data() {
            return {
                qualifikation: [{}],
                auszeichnung: [{}],
                sonstiges: [{}],
                row: {},
                has: false,
            };
        },
        mounted() {
            // You can add any code that should run on mount
        },
        methods: {
            addQualifikationRow() {
                const row = $.extend({}, this.row);
                row.id = this.qualifikation.length;
                this.qualifikation.push(row);
            },
            removeQualifikationRow() {
                if (this.qualifikation.length !== 1) this.qualifikation.pop();
            },
            addAuszeichnungRow() {
                const row = $.extend({}, this.row);
                row.id = this.auszeichnung.length;
                this.auszeichnung.push(row);
            },
            removeAuszeichnungRow() {
                if (this.auszeichnung.length !== 1) this.auszeichnung.pop();
            },
            addSonstigesRow() {
                const row = $.extend({}, this.row);
                row.id = this.sonstiges.length;
                this.sonstiges.push(row);
            },
            removeSonstigesRow() {
                if (this.sonstiges.length !== 1) this.sonstiges.pop();
            }
        }
    });

    app.mount('#dokumente-view');
    return app;
}
