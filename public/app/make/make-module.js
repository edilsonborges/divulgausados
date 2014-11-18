angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/make', {
			templateUrl: 'app/make/make-view-list.html',
			controller: 'VehicleMakeListCtrl'
		})
		.when('/make/create', {
			templateUrl: 'app/make/make-view-form.html',
			controller: 'VehicleMakeCreateCtrl'
		})
		.when('/make/:makeId', {
			templateUrl: 'app/make/make-view-form.html',
			controller: 'VehicleMakeEditCtrl'
		});
	}])
	.controller('VehicleMakeListCtrl', ['$scope', 'VehicleMake', 'PaginationService', function ($scope, VehicleMake, PaginationService) {
		$scope.paginator = PaginationService;

		$scope.search = function () {
			$scope.paginator.load(function (pagination) {
				var queryParams = {
					page: pagination.getCurrentPage(),
					filterByName: $scope.filterByName
				};
				VehicleMake.getList(queryParams).then(function (response) {
					$scope.bodyStyleList = response;
					$scope.paginator.setup(response.meta);
				});
			});
		};
		$scope.search();

		$scope.destroy = function (id) {
			VehicleMake.one(id).remove().then(function () {
				$scope.init();
			});
		};
	}])
	.controller('VehicleMakeCreateCtrl', ['$scope', 'VehicleMake', function ($scope, VehicleMake) {
		$scope.make = {};

		$scope.submit = function () {
			VehicleMake.post($scope.make).then(function () {
				$scope.make = {};
			});
		};
	}])
	.controller('VehicleMakeEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleMake', function ($scope, $location, $routeParams, VehicleMake) {
		VehicleMake.one($routeParams.makeId).get().then(function (make) {
			$scope.make = make;
		});

		$scope.submit = function () {
			$scope.make.put().then(function () {
				$location.path('/make');
			});
		};
	}])
	.factory('VehicleMake', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('make');
	}]);
