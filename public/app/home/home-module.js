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
	.controller('HomeCtrl', ['$scope', 'AuthenticationService', 'Vehicle', function ($scope, AuthenticationService, Vehicle) {
		$scope.user = AuthenticationService.user();

		$scope.activeIndex = 0;
		$scope.vehicleList = [];

		$scope.getImage = function (vehicle) {
			if (!!vehicle.images[0]) {
				return vehicle.images[0];
			}
			return '';
		};

		Vehicle.getList().then(function (vehicles) {
			$scope.vehicleList = vehicles;
		});
	}]);