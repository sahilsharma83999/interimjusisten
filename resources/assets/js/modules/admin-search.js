import $ from 'jquery';
import { createApp } from 'vue';

export default function initAdminSearch() {
    const app = createApp({
        data() {
            return {
                availableKompetenz: [],
                searchState: {
                    festanstellung: false,
                    interim: false,
                    buyIn: false,
                    auslandsProjekte: [],
                    mandate: [],
                    ausbildung: [],
                    karriere: [],
                    interessen: [],
                    personalVerantwortung: [],
                    umsatzVerantwortung: [],
                    budgetVerantwortung: [],
                    einkaufVerantwortung: [],
                    schwerpunkte: [],
                },
                results: [],
                resultsView: {
                    personal: false,
                    ausland: true,
                    mandate: true,
                    ausbildung: true,
                    karriere: true,
                    skills: true,
                    verantwortung: true,
                    kompetenz: true,
                },
                buttonLabels: []
            };
        },
        mounted() {
            $.get('/admin-search/flat-kompetenz', (data) => {
                for (let key in data) {
                    this.availableKompetenz.push({ text: data[key], value: key });
                }
            }).done(() => this.updateResults());

            // initialize button labels now that `this` is reactive
            this.buttonLabels = [
                { text: 'Auslands projekte', add: () => this.addAuslandRow(), remove: () => this.removeAuslandRow() },
                { text: 'Mandate', add: () => this.addMandatRow(), remove: () => this.removeMandatRow() },
                { text: 'Ausbildung', add: () => this.addAusbildungRow(), remove: () => this.removeAusbildungRow() },
                { text: 'Karriere', add: () => this.addKarriereRow(), remove: () => this.removeKarriereRow() },
                { text: 'Fähigkeiten', add: () => this.addInteresse(), remove: () => this.removeInteresse() },
                { text: 'Personal verantw.', add: () => this.addPersonalRow(), remove: () => this.removePersonalRow() },
                { text: 'Umsatz verantw.', add: () => this.addUmsatzRow(), remove: () => this.removeUmsatzRow() },
                { text: 'Einkaufs verantw.', add: () => this.addEinkaufRow(), remove: () => this.removeEinkaufRow() },
                { text: 'Budget verantw.', add: () => this.addBudgetRow(), remove: () => this.removeBudgetRow() },
                { text: 'Schwerpunkte', add: () => this.addSchwerpunkteRow(), remove: () => this.removeSchwerpunkteRow() },
            ];
        },
        methods: {
            updateResults: function updateResults() {
				var self = this;
				$.post('/admin-search', this.searchState, function (data) {
					// console.log('data111');
                    // alert("working");
					self.results = data;
				});
			},
            addAuslandRow() { this.searchState.auslandsProjekte.push({ experience:0, branche:0 }); },
            removeAuslandRow() { this.searchState.auslandsProjekte.pop(); },
            addMandatRow() { this.searchState.mandate.push({ experience:0, branche:0, minUmsatz:0, minMA:0, minMit:0, minBud:0 }); },
            removeMandatRow() { this.searchState.mandate.pop(); },
            addAusbildungRow() { this.searchState.ausbildung.push({ experience:0, ausbildung:0, spezialisierung:0 }); },
            removeAusbildungRow() { this.searchState.ausbildung.pop(); },
            addKarriereRow() { this.searchState.karriere.push({ experience:0, fachrichtung:0 }); },
            removeKarriereRow() { this.searchState.karriere.pop(); },
            addInteresse() { this.searchState.interessen.push({ interesse:0 }); },
            removeInteresse() { this.searchState.interessen.pop(); },
            addPersonalRow() { this.searchState.personalVerantwortung.push({ amount:0, period:0 }); },
            removePersonalRow() { this.searchState.personalVerantwortung.pop(); },
            addUmsatzRow() { this.searchState.umsatzVerantwortung.push({ amount:5, period:100 }); },
            removeUmsatzRow() { this.searchState.umsatzVerantwortung.pop(); },
            addBudgetRow() { this.searchState.budgetVerantwortung.push({ amount:10, period:200 }); },
            removeBudgetRow() { this.searchState.budgetVerantwortung.pop(); },
            addEinkaufRow() { this.searchState.einkaufVerantwortung.push({ amount:15, period:300 }); },
            removeEinkaufRow() { this.searchState.einkaufVerantwortung.pop(); },
            addSchwerpunkteRow() { this.searchState.schwerpunkte.push({ selection:'a' }); },
            removeSchwerpunkteRow() { this.searchState.schwerpunkte.pop(); },
        },
        watch: {
            searchState: {
                deep: true,
                handler() {
                    this.updateResults();
                }
            }
        }
    });

    app.mount('#admin-search');
    return app;
}
