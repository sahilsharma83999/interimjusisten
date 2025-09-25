import $ from 'jquery';
import { Vue } from 'vue';

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#karriere-view',
		ready: function () {
			var self = this;

			//Recieve models
			$.get('/json/karriere',function (data) {
				for(var d in data) {
					if(data[d].type === "ausbildung") {
						self.ausbildungen.push(data[d]);
					} else {
						self.karrieren.push(data[d]);
					}
				}
				if(self.ausbildungen.length !== 0) {
					self.hasAusbildung = true;
				}
				if(self.karrieren.length !== 0) {
					self.hasKarriere = true;
				}
			});
		},
		data: {
			ausbildungen: [],
			karrieren: [],
			row: {
				'id': 0,
				'fmonth': 1,
				'fyear': 1970,
				'tmonth': 1,
				'tyear': 1970,
				'fachrichtung': 0,
				'spezialisierung':0,
				'description':""
			},
			hasAusbildung: false,
			hasKarriere: false,
		},
		methods:{
			addAusbildungRow : function () {
				var row = $.extend({},this.row);
				row.id = this.ausbildungen.length;
				this.ausbildungen.push(row);
			},
			addKarriereRow : function () {
				var row = $.extend({},this.row);
				row.id = this.karrieren.length;
				this.karrieren.push(row);
			},

			removeAusbildungRow: function () {
				if(this.ausbildungen.length !== 0)
					this.ausbildungen.pop();
			},
			removeKarriereRow: function () {
				if(this.karrieren.length !== 0)
					this.karrieren.pop();
			},

			purgeAusbildungAll: function () {
				this.hasAusbildung = false;
				this.karrieren = [];
			},
			purgeKarriereAll: function () {
				this.hasKarriere = false;
				this.ausbildungen = [];
			},

			enableAusbildung: function () {
				this.hasAusbildung = true;
				this.addAusbildungRow();
			},
			enableKarriere: function () {
				this.hasKarriere = true;
				this.addKarriereRow();
			}
		}
	});

return vm;
};