angular.module('divulgausados')
	.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/body-style', {
			templateUrl: 'app/body-style/body-style-view-list.html',
			controller: 'VehicleBodyStyleListCtrl'
		}).

		when('/body-style/create', {
			templateUrl: 'app/body-style/body-style-view-form.html',
			controller: 'VehicleBodyStyleCreateCtrl'
		}).

		when('/body-style/:bodyStyleId', {
			templateUrl: 'app/body-style/body-style-view-form.html',
			controller: 'VehicleBodyStyleEditCtrl'
		});
	}])
	.controller('VehicleBodyStyleListCtrl', ['$scope', 'PaginationService', 'VehicleBodyStyle', function($scope, PaginationService, VehicleBodyStyle) {
		$scope.paginator = PaginationService;

		$scope.init = function() {
			$scope.paginator.load(function(pagination) {
				var queryParams = {
					page: pagination.getCurrentPage(),
					filterByName: $scope.filterByName
				};
				VehicleBodyStyle.getList(queryParams).then(function(response) {
					$scope.bodyStyleList = response;
					$scope.paginator.setup(response.meta);
				});
			});
		};
		$scope.init();

		$scope.search = function() {
			$scope.init();
		};

		$scope.destroy = function(id) {
			VehicleBodyStyle.one(id).remove().then(function() {
				$scope.init();
			});
		};
	}])
	.controller('VehicleBodyStyleCreateCtrl', ['$scope', 'VehicleBodyStyle', function($scope, VehicleBodyStyle) {
		$scope.bodyStyle = {};

		$scope.submit = function() {
			VehicleBodyStyle.post($scope.bodyStyle).then(function() {
				$scope.bodyStyle = {};
			});
		};
	}])
	.controller('VehicleBodyStyleEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleBodyStyle', function($scope, $location, $routeParams, VehicleBodyStyle) {
		VehicleBodyStyle.one($routeParams.bodyStyleId).get().then(function(bodyStyle) {
			$scope.bodyStyle = bodyStyle;
		});

		$scope.submit = function() {
			$scope.bodyStyle.put().then(function() {
				$location.path('/body-style');
			});
		};
	}])
	.factory('VehicleBodyStyle', ['RestfulFactory', function(RestfulFactory) {
		return RestfulFactory.service('body-style');
	}]);
