var $ = require('jquery');
global.jQuery = $;
var Vue = require('vue');

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#auslands-projekts-view',
		ready: function () {
			var self = this;
			//Recieve models
			$.get('/json/ausland',function (data) {
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
				'branche':0,
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