import $ from 'jquery';
import { Vue } from 'vue';

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#dokumente-view',
		ready: function () {},
		data: {
			qualifikation: [{}],
			auszeichnung: [{}],
			sonstiges: [{}],
			row: {},
			has: false,
		},
		methods:{

			addQualifikationRow : function () {
				var row = $.extend({},this.row);
				row.id = this.qualifikation.length;
				this.qualifikation.push(row);
			},
			removeQualifikationRow: function () {
				if(this.qualifikation.length !== 1)
					this.qualifikation.pop();
			},

			addAuszeichnungRow : function () {
				var row = $.extend({},this.row);
				row.id = this.auszeichnung.length;
				this.auszeichnung.push(row);
			},
			removeAuszeichnungRow: function () {
				if(this.auszeichnung.length !== 1)
					this.auszeichnung.pop();
			},

			addSonstigesRow : function () {
				var row = $.extend({},this.row);
				row.id = this.sonstiges.length;
				this.sonstiges.push(row);
			},
			removeSonstigesRow: function () {
				if(this.sonstiges.length !== 1)
					this.sonstiges.pop();
			}
		}
	});

	return vm;
};