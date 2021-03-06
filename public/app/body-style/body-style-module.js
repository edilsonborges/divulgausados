angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
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
	.controller('VehicleBodyStyleListCtrl', ['$scope', 'PaginationService', 'VehicleBodyStyle', function ($scope, PaginationService, VehicleBodyStyle) {
		$scope.paginator = PaginationService;

		$scope.search = function () {
			$scope.paginator.load(function (pagination) {
				var queryParams = {
					page: pagination.getCurrentPage(),
					page_size: pagination.getPageSize(),
					filter_by_name: $scope.filterByName
				};
				VehicleBodyStyle.getList(queryParams).then(function (response) {
					$scope.bodyStyleList = response;
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
			VehicleBodyStyle.one(id).remove().then(function () {
				$scope.search();
			});
		};
	}])
	.controller('VehicleBodyStyleCreateCtrl', ['$scope', 'ImageUploadService', 'VehicleBodyStyle', function ($scope, ImageUploadService, VehicleBodyStyle) {
		$scope.bodyStyle = {};

		$scope.uploader = ImageUploadService.create('/v1/upload-body-style');

		$scope.fetchImage = function (bodyStyle) {
			var imagePath = bodyStyle.image_path;
			return !imagePath ? 'https://placehold.it/200x200' : ('/img/body-style/' + imagePath);
		};

		$scope.submit = function () {
			VehicleBodyStyle.post($scope.bodyStyle).then(function (bodyStyle) {
				ImageUploadService.addFormData($scope.uploader, { body_style_id: bodyStyle.id });
				$scope.uploader.uploadAll();
				$scope.bodyStyle = {};
			});
		};
	}])
	.controller('VehicleBodyStyleEditCtrl', ['$scope', '$location', '$routeParams', 'ImageUploadService', 'VehicleBodyStyle', function ($scope, $location, $routeParams, ImageUploadService, VehicleBodyStyle) {
		VehicleBodyStyle.one($routeParams.bodyStyleId).get().then(function (bodyStyle) {
			$scope.bodyStyle = bodyStyle;
		});

		$scope.uploader = ImageUploadService.create('/v1/upload-body-style');

		$scope.fetchImage = function (bodyStyle) {
			var imagePath = !bodyStyle ? null : bodyStyle.image_path;
			return !imagePath ? 'https://placehold.it/200x200' : ('/img/body-style/' + imagePath);
		};

		$scope.submit = function () {
			$scope.bodyStyle.put().then(function () {
				$location.path('/body-style');
			});
		};
	}])
	.factory('VehicleBodyStyle', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('body-style');
	}]);
