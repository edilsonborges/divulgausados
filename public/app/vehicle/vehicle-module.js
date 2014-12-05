angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/vehicle/create', {
			templateUrl: 'app/make/make-view-list.html',
			controller: 'TheVehicleCreateCtrl'
		});
	}])
	.controller('TheVehicleCreateCtrl', ['$scope', 'Vehicle', 'VehicleBodyStyle', 'VehicleMake', 'VehicleModelSeries', function ($scope, Vehicle, VehicleBodyStyle, VehicleMake, VehicleModelSeries) {

	}])
	.factory('Vehicle', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('vehicle');
	}]);
