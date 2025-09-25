var $ = require('jquery');
global.jQuery = $;
var Vue = require('vue');

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#search-field',
		ready: function () {
		},
		data: {

		},
		methods:{
		}
	});

	vm.$watch('searchValue',function(value) {
		window.location = '/suche/'+value;
	});

	return vm;
};