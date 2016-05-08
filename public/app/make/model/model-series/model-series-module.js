angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/make/:makeId/model/:modelId/model-series', {
				templateUrl: 'app/make/model/model-series/model-series-view-list.html',
				controller: 'VehicleModelSeriesListCtrl'
			})
			.when('/make/:makeId/model/:modelId/model-series/create', {
				templateUrl: 'app/make/model/model-series/model-series-view-form.html',
				controller: 'VehicleModelSeriesCreateCtrl'
			})
			.when('/make/:makeId/model/:modelId/model-series/:modelSeriesId', {
				templateUrl: 'app/make/model/model-series/model-series-view-form.html',
				controller: 'VehicleModelSeriesEditCtrl'
			});
	}])
	.controller('VehicleModelSeriesListCtrl', ['$scope', '$routeParams', 'VehicleModel', 'VehicleModelSeries', 'PaginationService', function ($scope, $routeParams, VehicleModel, VehicleModelSeries, PaginationService) {
		$scope.paginator = PaginationService;

		VehicleModel.one($routeParams.modelId).get().then(function (model) {
			$scope.model = model;
		});

		$scope.search = function () {
			$scope.paginator.load(function (pagination) {
				var queryParams = {
					page: pagination.getCurrentPage(),
					page_size: pagination.getPageSize(),
					filter_by_model_id: $routeParams.modelId,
					filter_by_name: $scope.filterByName
				};
				VehicleModelSeries.getList(queryParams).then(function (response) {
					$scope.modelSeriesList = response;
					$scope.paginator.setup(response.meta);
				});
			});
		};
		$scope.search();

		$scope.onRowSelect = function (selected) {
			$scope.selected = selected;
		};

		$scope.isRowSelected = function (item) {
			return $scope.selected == item;
		};

		$scope.destroy = function (id) {
			VehicleModelSeries.one(id).remove().then(function () {
				$scope.search();
			});
		};
	}])
	.controller('VehicleModelSeriesCreateCtrl', ['$scope', '$routeParams', 'VehicleModel', 'VehicleModelSeries', function ($scope, $routeParams, VehicleModel, VehicleModelSeries) {
		$scope.init = function () {
			$scope.modelSeries = {};

			VehicleModel.one($routeParams.modelId).get().then(function (model) {
				$scope.modelSeries.model = model;
			});
		};
		$scope.init();

		$scope.submit = function () {
			VehicleModelSeries.post($scope.modelSeries).then(function () {
				$scope.init();
			});
		};
	}])
	.controller('VehicleModelSeriesEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleModel', 'VehicleModelSeries', function ($scope, $location, $routeParams, VehicleModel, VehicleModelSeries) {
		VehicleModelSeries.one($routeParams.modelSeriesId).get().then(function (modelSeries) {
			$scope.modelSeries = modelSeries;
		});

		VehicleModel.one($routeParams.modelId).get().then(function (model) {
			$scope.modelSeries.model = model;
		});

		$scope.submit = function () {
			$scope.modelSeries.put().then(function () {
				$location.path('/make/' + $scope.modelSeries.model.vehiclemake_id + '/model/' + $scope.modelSeries.model.id + '/model-series');
			});
		};
	}])
	.factory('VehicleModelSeries', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('model-series');
	}]);
