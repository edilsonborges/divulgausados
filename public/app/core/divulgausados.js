angular.module('divulgausados', ['ngResource', 'ngRoute', 'LocalStorageModule', 'ui.bootstrap', 'restangular', 'angularFileUpload'])
	.config(['RestangularProvider', function (RestangularProvider) {
		RestangularProvider.setBaseUrl('//localhost:8000/v1');
		RestangularProvider.setDefaultHeaders({
			"Accept": "application/json",
			"Content-Type": "application/json"
		});
	}]);