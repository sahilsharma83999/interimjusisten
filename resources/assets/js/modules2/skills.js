var $ = require('jquery');
global.jQuery = $;
var Vue = require('vue');

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#faehigkeiten-view',
		ready: function () {
			var self = this;
			//Recieve models
			$.get('/json/skills',function (data) {
				self.models = data;
				if(data.length !== 0) {
					self.models = [];
					for(var key in data) {
						data[key].id = self.models.length;
						self.models.push(data[key]);
					}
					self.has = true;
				} else {
					self.enable();
				}
			});
		},
		data: {
			models: [],
			row: {
				'id': 0,
				'skill': 0,
			},
			has: false,
		},
		methods:{
			addRow : function () {
				if(this.models.length < 4) {
					var row = $.extend({},this.row);
					row.id = this.models.length;
					this.models.push(row);
				}
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