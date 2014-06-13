var divulgaUsadosApp = angular.module('DivulgaUsadosApp', ['ngRoute', 'ngResource']);

divulgaUsadosApp.config(['$routeProvider', function($routeProvider) {

	$routeProvider.
		when('/', {
			templateUrl: 'app/home/home-view-index.html',
			controller: 'HomeCtrl'
		}).

		when('/vehicle-body-style', {
			templateUrl: 'app/body-style/body-style-view-list.html',
			controller: 'VehicleBodyStyleListCtrl'
		}).

		when('/vehicle-body-style/create', {
			templateUrl: 'app/body-style/body-style-view-create.html',
			controller: 'VehicleBodyStyleCreateCtrl'
		}).

		when('/vehicle-body-style/edit/:id', {
			templateUrl: 'app/body-style/body-style-view-edit.html',
			controller: 'VehicleBodyStyleEditCtrl'
		}).

		when('/vehicle-make', {
			templateUrl: 'app/make/make-view-list.html',
			controller: 'VehicleMakeListCtrl'
		}).

		when('/vehicle-make/create', {
			templateUrl: 'app/make/make-view-create.html',
			controller: 'VehicleMakeCreateCtrl'
		}).
		
		otherwise({
			redirectTo: '/'
		});
	}
]);

divulgaUsadosApp.filter('standardDateFormat', ['$filter', function standardDateFormat($filter) {
	return function(date){
		var temporary = new Date(date);
		return $filter('date')(temporary, "dd/MM/yyyy HH:mm");
	};
}]);
