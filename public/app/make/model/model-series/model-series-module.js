angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/model/:modelId/model-series', {
			controller: 'VehicleModelListCtrl'
		});
	}])
	.controller('VehicleModelListCtrl', ['$scope', '$routeParams' function ($scope, $routeParams, VehicleModelSeries) {
		
	}])
	.factory('VehicleModelSeries', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('model-series');
	}]);
