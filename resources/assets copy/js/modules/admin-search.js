var $ = require('jquery');
global.jQuery = $;
var Vue = require('vue');

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#admin-search',
		ready:function () {
			var self = this;
			$.get('/admin-search/flat-kompetenz',function (data) {
				for(var key in data) {
					self.availableKompetenz.push({text:data[key],value:key});
				}
				console.log(data);
			}).done(function () {
				self.updateResults();
			});
		},
		data: {
			availableKompetenz : [],
			searchState: {
				festanstellung:false,
				interim:false,
				buyIn:false,
				auslandsProjekte : [],
				mandate : [],
				ausbildung: [],
				karriere: [],
				interessen : [],
				personalVerantwortung: [],
				umsatzVerantwortung: [],
				budgetVerantwortung: [],
				einkaufVerantwortung: [],
				schwerpunkte: [],
			},
			schwerpunkte: [],
			results: [],
			resultsView: {
				personal: true,
				ausland: true,
				mandate: true,
				ausbildung: true,
				karriere: true,
				skills: true,
				verantwortung: true,
				kompetenz: true,
			},
		},
		methods: {
			updateResults: function () {
				var self = this;
				$.post('/admin-search',this.searchState,function(data) {
					console.log(data);
					self.results = data;
				});
			},
			addAuslandRow: function () {
				this.searchState.auslandsProjekte.push({'experience':0,'branche':0});
			},
			removeAuslandRow: function () {
				this.searchState.auslandsProjekte.pop();
			},
			addMandatRow: function () {
				this.searchState.mandate.push({
					'experience':0,
					'branche':0,
					'minUmsatz':0,
					'minMA':0,
					'minMit':0,
					'minBud':0
				});
			},
			removeMandatRow: function () {
				this.searchState.mandate.pop();
			},
			addAusbildungRow: function () {
				this.searchState.ausbildung.push({'experience':0,'ausbildung':0,'spezialisierung':0});
			},
			removeAusbildungRow: function () {
				this.searchState.ausbildung.pop();
			},
			addKarriereRow: function () {
				this.searchState.karriere.push({'experience':0,'fachrichtung':0});
			},
			removeKarriereRow: function () {
				this.searchState.karriere.pop();
			},
			addInteresse: function () {
				this.searchState.interessen.push({'interesse':0});
			},
			removeInteresse: function () {
				this.searchState.interessen.pop();
			},

			addPersonalRow: function () {
				this.searchState.personalVerantwortung.push({'amount':0,'period':0});
			},
			removePersonalRow: function () {
				this.searchState.personalVerantwortung.pop();
			},
			addUmsatzRow: function () {
				this.searchState.umsatzVerantwortung.push({'amount':5,'period':100});
			},
			removeUmsatzRow: function () {
				this.searchState.umsatzVerantwortung.pop();
			},
			addBudgetRow: function () {
				this.searchState.budgetVerantwortung.push({'amount':10,'period':200});
			},
			removeBudgetRow: function () {
				this.searchState.budgetVerantwortung.pop();
			},
			addEinkaufRow: function () {
				this.searchState.einkaufVerantwortung.push({'amount':15,'period':300});
			},
			removeEinkaufRow: function () {
				this.searchState.einkaufVerantwortung.pop();
			},
			addSchwerpunkteRow: function () {
				this.searchState.schwerpunkte.push({selection:'a'});
			},
			removeSchwerpunkteRow: function () {
				this.searchState.schwerpunkte.pop();
			},
		}
	});

	vm.$watch('searchState',function () {
		console.log('searchState changed');
		this.updateResults();
	},{deep:true});

	return vm;

};