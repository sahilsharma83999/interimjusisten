import $ from 'jquery';
import Cookies from 'js-cookie';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import ausland from './modules/ausland.js';
import mandat from './modules/mandat.js';
import karriere from './modules/karriere.js';
import dokumente from './modules/dokumente.js';
import skills from './modules/skills.js';
import verantwortung from './modules/verantwortung.js';
import schwerpunkte from './modules/schwerpunkte.js';
import search from './modules/search.js';

window.$ = window.jQuery = $;

import '../../../bower_components/trumbowyg/dist/trumbowyg.js';
import '../../../bower_components/trumbowyg/dist/langs/de.min.js';


// Wait for DOM content to load
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Trumbowyg

    // $('*[role=wysiwyg]').trumbowyg({height: 200});

    // Set up AJAX CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize modules only if the corresponding element exists
    if (document.querySelector('#auslands-projekts-view')) ausland();
    if (document.querySelector('#mandate-view')) mandat();
    if (document.querySelector('#karriere-view')) karriere();
    if (document.querySelector('#dokumente-view')) dokumente();
    if (document.querySelector('#faehigkeiten-view')) skills();
    if (document.querySelector('#verantwortung-view')) verantwortung();
    if (document.querySelector('#schwerpunkte-view')) schwerpunkte();
    if (document.querySelector('#search-field')) search();
    if (document.querySelector('#admin-search')) search();
});
