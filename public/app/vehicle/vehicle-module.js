angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/vehicle/create', {
			templateUrl: 'app/vehicle/vehicle-view-form.html',
			controller: 'TheVehicleCreateCtrl'
		})
		.when('/vehicle/edit/:vehicleId', {
			templateUrl: 'app/vehicle/vehicle-view-form.html',
			controller: 'TheVehicleEditCtrl'
		})
        .when('/vehicle', {
            templateUrl: 'app/vehicle/vehicle-view-list.html',
            controller: 'TheVehicleListCtrl'
        })
		.when('/vehicle/:vehicleId/spec', {
			templateUrl: 'app/vehicle/vehicle-view-spec.html',
			controller: 'TheVehicleSpecCtrl'
		});
	}])
    .controller('TheVehicleListCtrl', ['$scope', 'Vehicle', function ($scope, Vehicle) {
        $scope.vehicleList = [];

        Vehicle.getList().then(function (response) {
            $scope.vehicleList = response;
        });
    }])
	.controller('TheVehicleMechanicsCtrl', ['$scope', 'VehicleBodyStyle', 'VehicleMake', 'VehicleModel', 'VehicleModelSeries', 'FileUploader', function ($scope, VehicleBodyStyle, VehicleMake, VehicleModel, VehicleModelSeries, FileUploader) {


		VehicleBodyStyle.getList().then(function (response) {
			$scope.bodyStyleList = response;
		});

		VehicleMake.getList().then(function (response) {
			$scope.makeList = response;
		});

		$scope.findModels = function (selectedMakeId) {
			VehicleModel.getList({
				filter_by_make_id: selectedMakeId
			}).then(function (response) {
				$scope.modelList = response;
			});
		};

		$scope.findModelSeries = function (selectedModelId) {
			VehicleModelSeries.getList({
				filter_by_model_id: selectedModelId
			}).then(function (response) {
				$scope.modelSeriesList = response;
			});
		};
	}])
	.controller('TheVehicleCreateCtrl', ['$scope', 'VehicleUploadService', 'Vehicle', function ($scope, VehicleUploadService, Vehicle) {
		$scope.vehicle = {};

		$scope.uploader = VehicleUploadService.create();

		$scope.submit = function () {
			Vehicle.post($scope.vehicle).then(function (vehicle_id) {
				VehicleUploadService.addFormData($scope.uploader, { vehicle_id: vehicle_id });
				$scope.uploader.uploadAll();
				$scope.vehicle = {};
			});
		};
	}])
	.controller('TheVehicleEditCtrl', ['$scope', '$routeParams', '$location', 'VehicleUploadService', 'Vehicle', function ($scope, $routeParams, $location, VehicleUploadService, Vehicle) {
		Vehicle.one($routeParams.vehicleId).get().then(function (vehicle) {
			$scope.vehicle = vehicle;
		});

		$scope.uploader = VehicleUploadService.create();

		$scope.submit = function () {
			$scope.vehicle.put().then(function () {
				VehicleUploadService.addFormData($scope.uploader, { vehicle_id: $routeParams.vehicleId });
				// TODO $scope.uploader.uploadAll();
				$location.path('/vehicle');
			});
		};
	}])
	.service('VehicleUploadService', ['FileUploader', function (FileUploader) {
		this.create = function () {
			var uploader = new FileUploader({
				url: '/v1/upload-vehicle',
				removeAfterUpload: true,
				queueLimit: 1
			});
			this.addFilter(uploader);
			return uploader;
		};

		this.addFilter = function (uploader) {
			uploader.filters.push({
				name: 'imageFilter',
				fn: function (item) {
					var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
					return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
				}
			});
		};

		this.addFormData = function (uploader, formData) {
			uploader.onBeforeUploadItem = function (item) {
				item.formData.push(formData);
			};
		};
	}])
	.controller('TheVehicleSpecCtrl', ['$scope', '$routeParams', '$location', 'Vehicle', function ($scope, $routeParams, $location, Vehicle) {

	}])
	.factory('Vehicle', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('vehicle');
	}]);
