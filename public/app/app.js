var divulgaUsadosApp = angular.module('DivulgaUsadosApp', ['ngRoute', 'ngResource']);

divulgaUsadosApp.config(['$routeProvider', function($routeProvider) {

	$routeProvider.
		when('/', {
			templateUrl: 'app/views/index.html',
			controller: 'MainCtrl'
		}).

		when('/vehicle-body-style', {
			templateUrl: 'app/vehicle-body-style/vehicle-body-style-index.html',
			controller: 'VehicleBodyStyleListCtrl'
		}).

		when('/vehicle-body-style/create', {
			templateUrl: 'app/vehicle-body-style/vehicle-body-style-create.html',
			controller: 'VehicleBodyStyleCreateCtrl'
		}).

		when('/vehicle-body-style/edit/:id', {
			templateUrl: 'app/vehicle-body-style/vehicle-body-style-edit.html',
			controller: 'VehicleBodyStyleEditCtrl'
		}).
		
		otherwise({
			redirectTo: '/'
		});
	}
]);
