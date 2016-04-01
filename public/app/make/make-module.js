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

		$scope.destroy = function (id) {
			VehicleMake.one(id).remove().then(function () {
				$scope.search();
			});
		};
	}])
	.controller('VehicleMakeCreateCtrl', ['$scope', 'FileUploader', 'VehicleMake', function ($scope, FileUploader, VehicleMake) {
		$scope.make = {};

		$scope.uploader = new FileUploader({
			url: '/v1/upload-make-brand',
			removeAfterUpload: true,
			queueLimit: 3
		});

		$scope.uploader.filters.push({
			name: 'imageFilter',
			fn: function (item, options) {
				var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
				return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
			}
		});

		$scope.submit = function () {
			VehicleMake.post($scope.make).then(function (make_id) {
				$scope.uploader.formData = { make_id: make_id };
				$scope.uploader.uploadAll();
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
