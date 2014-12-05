angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/make/:makeId/model', {
				templateUrl: 'app/make/model/model-view-list.html',
				controller: 'VehicleModelListCtrl'
			})
			.when('/make/:makeId/model/create', {
				templateUrl: 'app/make/model/model-view-form.html',
				controller: 'VehicleModelCreateCtrl'
			})
			.when('/make/:makeId/model/:modelId', {
				templateUrl: 'app/make/model/model-view-form.html',
				controller: 'VehicleModelEditCtrl'
			});
	}])
	.controller('VehicleModelListCtrl', ['$scope', '$routeParams', 'PaginationService', 'VehicleModel', 'VehicleMake', function ($scope, $routeParams, PaginationService, VehicleModel, VehicleMake) {
		$scope.paginator = PaginationService;

		VehicleMake.one($routeParams.makeId).get().then(function (make) {
			$scope.make = make;
		});

		$scope.search = function () {
			$scope.paginator.load(function (pagination) {
				var queryParams = {
					page: pagination.getCurrentPage(),
					page_size: pagination.getPageSize(),
					filter_by_make_id: $routeParams.makeId,
					filter_by_name: $scope.filterByName
				};
				VehicleModel.getList(queryParams).then(function (response) {
					$scope.modelList = response;
					$scope.paginator.setup(response.meta);
				});
			});
		};
		$scope.search();

		$scope.destroy = function (id) {
			VehicleModel.one(id).remove().then(function () {
				$scope.search();
			});
		};
	}])
	.controller('VehicleModelCreateCtrl', ['$scope', '$routeParams', 'VehicleModel', 'VehicleMake', function ($scope, $routeParams, VehicleModel, VehicleMake) {
		$scope.init = function () {
			$scope.model = {};

			VehicleMake.one($routeParams.makeId).get().then(function (make) {
				$scope.model.make = make;
			});
		};
		$scope.init();

		$scope.submit = function () {
			VehicleModel.post($scope.model).then(function () {
				$scope.init();
			});
		};
	}])
	.controller('VehicleModelEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleModel', 'VehicleMake', function ($scope, $location, $routeParams, VehicleModel, VehicleMake) {
		VehicleModel.one($routeParams.modelId).get().then(function (model) {
			$scope.model = model;
		});

		VehicleMake.one($routeParams.makeId).get().then(function (make) {
			$scope.model.make = make;
		});

		$scope.submit = function () {
			$scope.model.put().then(function () {
				$location.path('/make/' + $scope.model.make.id + '/model');
			});
		};
	}])
	.factory('VehicleModel', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('model');
	}]);
