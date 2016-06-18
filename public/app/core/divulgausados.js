angular.module('divulgausados', ['ngResource', 'ngRoute', 'LocalStorageModule', 'ui.bootstrap', 'restangular', 'angularFileUpload', 'colorpicker.module', 'ui.utils.masks'])
	.config(['RestangularProvider', function (RestangularProvider) {
		RestangularProvider.setBaseUrl('http://127.0.0.1:8000/v1');
		RestangularProvider.setDefaultHeaders({
			"Accept": "application/json",
			"Content-Type": "application/json"
		});
	}]);