angular.module('divulgausados')
	.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/', {
			templateUrl: 'app/home/home-view-index.html',
			controller: 'HomeCtrl'
		}).
		otherwise({
			redirectTo: '/'
		});
	}])
	.controller('HomeCtrl', ['$scope', function($scope) {

	}]);