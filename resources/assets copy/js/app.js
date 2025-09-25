// import { createApp } from 'vue';
// import AdminSearch from './components/AdminSearch.vue';
// import './bootstrap';

// const app = createApp({});
// app.component('admin-search', AdminSearch);
// app.mount('#admin-search-app');

var $ = global.jQuery  = require('jquery');
var cookies = global.Cookies = require('js-cookie');
var bootstrap = require('bootstrap-sass');
var datepicker = require('./modules/datepicker');
var wysiwyg = require('../../../bower_components/trumbowyg/dist/trumbowyg.js');
var wysiwygDe = require('../../../bower_components/trumbowyg/dist/langs/de.min.js');
// var wysiwyg = require('summernote');

$(document).ready(function () {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	//Stupid Cookie Law Stuff
	$('#cookie-agreement').click(function(e) {
		e.preventDefault();
		Cookies.set("accepted_cookies",1,{expires:10});
		$('#cookie-agreement').slideUp();
	});

	$('body').trigger("newDatepicker");

	if($('#auslands-projekts-view').length !== 0) {
		var ausland = require('./modules/ausland')();
	}

	if($('#mandate-view').length !== 0) {
		var mandat = require('./modules/mandat')();
	}

	if($('#karriere-view').length !== 0 ) {
		var karriere = require('./modules/karriere')();
	}

	if($('#dokumente-view').length !== 0 ) {
		var dokumente = require('./modules/dokumente')();
	}

	if($('#faehigkeiten-view').length !== 0 ){
		var faehigkeiten = require('./modules/skills')();
	}

	if($('#verantwortung-view').length !== 0 ){
		var verantwortung = require('./modules/verantwortung')();
	}

	if($('#schwerpunkte-view').length !== 0 ){
		var schwerpunkte = require('./modules/schwerpunkte')();
	}

	if($('#search-field').length !== 0 ){
		var search = require('./modules/search')();
	}

	if($('#admin-search').length !== 0 ){
		var search = require('./modules/admin-search')();
	}

	$('*[role=wysiwyg]').trumbowyg({height: 200});
});