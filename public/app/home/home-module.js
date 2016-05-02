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
		$scope.vehicleList = [];

		$scope.getRandomImage = function (vehicle) {
			if (!!vehicle.images) {
				return vehicle.images[Math.floor(Math.random() * vehicle.images.length)];
			}
			return '';
		};

		Vehicle.getList().then(function (vehicles) {
			$scope.vehicleList = vehicles;
		});
	}]);