import $ from 'jquery';
import { createApp } from 'vue';

export default function karriereModule() {
    const app = createApp({
        data() {
            return {
                ausbildungen: [],
                karrieren: [],
                row: {
                    id: 0,
                    fmonth: 1,
                    fyear: 1970,
                    tmonth: 1,
                    tyear: 1970,
                    fachrichtung: 0,
                    spezialisierung: 0,
                    description: ""
                },
                hasAusbildung: false,
                hasKarriere: false,
            };
        },
        mounted() {
            const self = this;
            $.get('/json/karriere', function (data) {
                data.forEach(d => {
                    if (d.type === "ausbildung") {
                        self.ausbildungen.push(d);
                    } else {
                        self.karrieren.push(d);
                    }
                });
                if (self.ausbildungen.length) self.hasAusbildung = true;
                if (self.karrieren.length) self.hasKarriere = true;
            });
        },
        methods: {
            addAusbildungRow() {
                const row = { ...this.row, id: this.ausbildungen.length };
                this.ausbildungen.push(row);
            },
            addKarriereRow() {
                const row = { ...this.row, id: this.karrieren.length };
                this.karrieren.push(row);
            },
            removeAusbildungRow() {
                if (this.ausbildungen.length) this.ausbildungen.pop();
            },
            removeKarriereRow() {
                if (this.karrieren.length) this.karrieren.pop();
            },
            purgeAusbildungAll() {
                this.hasAusbildung = false;
                this.ausbildungen = [];
            },
            purgeKarriereAll() {
                this.hasKarriere = false;
                this.karrieren = [];
            },
            enableAusbildung() {
                this.hasAusbildung = true;
                this.addAusbildungRow();
            },
            enableKarriere() {
                this.hasKarriere = true;
                this.addKarriereRow();
            }
        }
    });

    app.mount('#karriere-view');
    return app;
}
