angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/model', {
			controller: 'VehicleModelListCtrl'
		});
	}])
	.controller('VehicleModelListCtrl', ['$scope', function ($scope, VehicleModel) {
		
	}])
	.factory('VehicleModel', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('model');
	}]);
