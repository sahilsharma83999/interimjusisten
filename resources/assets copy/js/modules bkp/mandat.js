import $ from 'jquery';
import { Vue } from 'vue';

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#mandate-view',
		ready: function () {
			var self = this;
			//Recieve models
			$.get('/json/mandat',function (data) {
				self.models = data;
				if(data.length !== 0) {
					self.models = [];
					for(var key in data) {
						data[key].id = self.models.length;
						self.models.push(data[key]);
					}
					self.has = true;
				}
			});
		},
		data: {
			models: [],
			row: {
				'id': 0,
				'fmonth': 1,
				'fyear': 1970,
				'tmonth': 1,
				'tyear':1970,
				'branch':1,
				'umsatz': 0,
				'ma': 0,
				'worker': 0,
				'budget': 0,
				'description':""
			},
			has: false,
		},
		methods:{
			addRow : function () {
				var row = $.extend({},this.row);
				row.id = this.models.length;
				this.models.push(row);
			},
			removeRow: function () {
				if(this.models.length !== 1)
					this.models.pop();
			},
			purgeAll: function () {
				this.has = false;
				this.models = [];
			},
			enable: function () {
				this.has = true;
				this.addRow();
			}
		}
	});

	return vm;
};