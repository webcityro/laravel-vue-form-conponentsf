window._ = require('lodash');
window.Vue = require('vue');

try {
	(window.popper = require('popper.js')), (window.$ = require('jquery'));
} catch (error) {}

let token = document.head.querySelector('meta[name="csrf-token"]');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (token) {
	window.csrf_token = window.axios.defaults.headers.common['X-CSRF-TOKEN'] =
		token.content;
}

import EventBus from './core/EventBus';
import ErrorHandler from './core/ErrorHandler';

window.scEvent = new EventBus();
window.ErrorHandler = ErrorHandler;
