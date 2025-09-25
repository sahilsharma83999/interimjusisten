var $ = require('jquery');
var Pikaday = require('pikaday');

var exports = module.export = {};

$('body').on('newDatepicker', function () {
	// console.log('tried to make new datepicker');
	$('*[role=datepicker]').each(function () {
		if($(this).data('pikaday') === undefined)
			$(this).data('pikaday',new Pikaday({
				field: $(this)[0],
				format: 'DD.MM.YYYY',
				onSelect: function() {
				    console.log(this.getMoment().format('Do MMMM YYYY'));
				}
			}));
	});
});