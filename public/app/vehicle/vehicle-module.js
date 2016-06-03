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

		$scope.onRowSelect = function (selected) {
			$scope.selected = selected;
		};

		$scope.isRowSelected = function (item) {
			return $scope.selected == item;
		};
    }])
	.controller('TheVehicleMechanicsCtrl', ['$scope', 'VehicleBodyStyle', 'VehicleMake', 'VehicleModel', 'VehicleModelSeries', 'FileUploader', function ($scope, VehicleBodyStyle, VehicleMake, VehicleModel, VehicleModelSeries, FileUploader) {
		VehicleBodyStyle.getList().then(function (response) {
			$scope.bodyStyleList = response;
		});

		VehicleMake.getList().then(function (response) {
			$scope.makeList = response;
			$scope.modelList = null;
		});

		$scope.findModels = function (selectedMakeId) {
			VehicleModel.getList({
				filter_by_make_id: selectedMakeId
			}).then(function (response) {
				$scope.modelList = response;
				$scope.modelSeriesList = null;
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
	.controller('TheVehicleCreateCtrl', ['$scope', 'ImageUploadService', 'Vehicle', function ($scope, ImageUploadService, Vehicle) {
		$scope.vehicle = {};

		$scope.uploader = ImageUploadService.create('/v1/upload-vehicle');

		$scope.submit = function () {
			Vehicle.post($scope.vehicle).then(function (vehicle_id) {
				ImageUploadService.addFormData($scope.uploader, { vehicle_id: vehicle_id });
				$scope.uploader.uploadAll();
				$scope.vehicle = {};
			});
		};
	}])
	.controller('TheVehicleEditCtrl', ['$scope', '$routeParams', '$location', 'ImageUploadService', 'Vehicle', function ($scope, $routeParams, $location, ImageUploadService, Vehicle) {
		Vehicle.one($routeParams.vehicleId).get().then(function (vehicle) {
			$scope.vehicle = vehicle;
		});

		$scope.uploader = ImageUploadService.create('/v1/upload-vehicle');

		$scope.submit = function () {
			$scope.vehicle.put().then(function () {
				ImageUploadService.addFormData($scope.uploader, { vehicle_id: $routeParams.vehicleId });
				$scope.uploader.uploadAll();
				$location.path('/vehicle');
			});
		};
	}])
	.controller('TheVehicleSpecCtrl', ['$scope', '$routeParams', '$location', 'MessageService', 'Vehicle', 'VehicleFeatureCategory', 'VehicleFeature', 'VehicleFeatureValue', function ($scope, $routeParams, $location, MessageService, Vehicle, VehicleFeatureCategory, VehicleFeature, VehicleFeatureValue) {
		$scope.vehicle = {};
		$scope.featureCategoryList = [];
		$scope.featureList = [];
		$scope.existentFeatureList = [];

		Vehicle.one($routeParams.vehicleId).get().then(function (vehicle) {
			$scope.vehicle = vehicle;
		});

		VehicleFeatureValue.getList({'filter_by_vehicle_id': $routeParams.vehicleId}).then(function (result) {
			$scope.existentFeatureList = result;
		});

		VehicleFeatureCategory.getList().then(function (result) {
			$scope.featureCategoryList = result;
		});

		$scope.loadFeatureList = function (categoryId) {
			VehicleFeature.getList({ filter_by_category_id: categoryId }).then(function (result) {
				$scope.featureList = result;
			});
		};

		$scope.vehicleFeatureList = [];
		$scope.vm = {};

		$scope.clearFeature = function () {
			$scope.vm = {};
		};

		function isDuplicated() {
			return $scope.existentFeatureList.some(function (feature) {
                return feature.vehiclefeature_id === $scope.vm.selectedFeature.id;
            });
		}

		function createInstance() {
			var label = $scope.vm.selectedCategory.name + ' ' + $scope.vm.selectedFeature.name;
			return {
				label: label,
				vehicle_id: $scope.vehicle.id,
				vehiclefeature_id: $scope.vm.selectedFeature.id,
				value: $scope.vm.selectedValue
			}
		}

		$scope.createFeature = function () {
			if (!isDuplicated()) {
				$scope.vehicleFeatureList.push(createInstance());
				$scope.clearFeature();
			} else {
                MessageService.addWarning('A especificação selecionada já foi incluída no veículo!');
            }
		};

		$scope.addFeature = function () {
			$scope.createFeature();
		};

		$scope.removeFeature = function ($index) {
			$scope.vehicleFeatureList.splice($index, 1);
		};

		$scope.onSubmit = function () {
			var sendToServer = { featureList: $scope.vehicleFeatureList };
			VehicleFeatureValue.post(sendToServer).then(function () {
				$scope.vehicleFeatureList = [];
				$scope.clearFeature();
			});
		};
	}])
	.factory('Vehicle', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('vehicle');
	}])
	.factory('VehicleFeatureValue', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('feature-value');
	}]);
