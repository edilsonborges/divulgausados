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
					page_size: pagination.getPageSize(),
					filter_by_name: $scope.filterByName
				};
				VehicleMake.getList(queryParams).then(function (response) {
					$scope.makeList = response;
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
			VehicleMake.one(id).remove().then(function () {
				$scope.search();
			});
		};
	}])
	.controller('VehicleMakeCreateCtrl', ['$scope', 'ImageUploadService', 'VehicleMake', function ($scope, ImageUploadService, VehicleMake) {
		$scope.make = {};

        $scope.uploader = ImageUploadService.create('/v1/upload-make-brand');

		$scope.fetchImage = function (make) {
			console.log(make);
			var imagePath = make.brand_image_path;
			return !imagePath ? 'https://placehold.it/200x200' : ('/img/make/' + imagePath);
		};

		$scope.submit = function () {
			VehicleMake.post($scope.make).then(function (make) {
				ImageUploadService.addFormData($scope.uploader, { make_id: make.id });
				$scope.uploader.uploadAll();
				$scope.make = {};
			});
		};
	}])
	.controller('VehicleMakeEditCtrl', ['$scope', '$location', '$routeParams', 'ImageUploadService', 'VehicleMake', function ($scope, $location, $routeParams, ImageUploadService, VehicleMake) {
		VehicleMake.one($routeParams.makeId).get().then(function (make) {
			$scope.make = make;
		});

        $scope.uploader = ImageUploadService.create('/v1/upload-make-brand');

		$scope.fetchImage = function (make) {
			console.log(make);
			var imagePath = make.brand_image_path;
			return !imagePath ? 'https://placehold.it/200x200' : ('/img/make/' + imagePath);
		};

		$scope.submit = function () {
			$scope.make.put().then(function () {
				$location.path('/make');
			});
		};
	}])
	.factory('VehicleMake', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('make');
	}]);
