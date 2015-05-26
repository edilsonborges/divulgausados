angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/', {
			templateUrl: 'app/home/home-view-index.html',
			controller: 'HomeCtrl'
		})
		.when('/dashboard', {
			templateUrl: 'app/home/home-view-dashboard.html',
			controller: 'HomeCtrl'
		})
		.otherwise({
			redirectTo: '/'
		});
	}])
	.controller('HomeCtrl', ['$scope', 'Vehicle', function ($scope, Vehicle) {
		$scope.vehicles = [];
		Vehicle.getList().then(function (vehicles) {
			$scope.vehicles = vehicles;
		});
	}]);