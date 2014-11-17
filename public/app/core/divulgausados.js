angular.module('divulgausados', ['ngResource', 'ngRoute', 'LocalStorageModule', 'ui.bootstrap', 'restangular'])
	.config(['RestangularProvider', function(RestangularProvider) {
		RestangularProvider.setBaseUrl('//localhost/divulgausados/public/service');
		RestangularProvider.setDefaultHeaders({
			"Accept": "application/json",
			"Content-Type": "application/json"
		});
	}]);
