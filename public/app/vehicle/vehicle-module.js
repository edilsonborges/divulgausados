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
        });
	}])
    .controller('TheVehicleListCtrl', ['$scope', 'Vehicle', function ($scope, Vehicle) {
        $scope.vehicleList = [];

        Vehicle.getList().then(function (response) {
            $scope.vehicleList = response;
        });
    }])
	.controller('TheVehicleMechanicsCtrl', ['$scope', 'VehicleBodyStyle', 'VehicleMake', 'VehicleModel', 'VehicleModelSeries', 'FileUploader', function ($scope, VehicleBodyStyle, VehicleMake, VehicleModel, VehicleModelSeries, FileUploader) {
		$scope.uploader = new FileUploader({
			url: '/v1/upload-vehicle',
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

		VehicleBodyStyle.getList().then(function (response) {
			$scope.bodyStyleList = response;
		});

		VehicleMake.getList().then(function (response) {
			$scope.makeList = response;
		});

		VehicleModel.getList().then(function (response) {
			$scope.modelList = response;
		});

		$scope.findModelSeries = function (selectedModelId) {
			VehicleModelSeries.getList({
				filter_by_model_id: selectedModelId
			}).then(function (response) {
				$scope.modelSeriesList = response;
			});
		};
	}])
	.controller('TheVehicleCreateCtrl', ['$scope', 'Vehicle', function ($scope, Vehicle) {
		$scope.vehicle = {};

		$scope.submit = function () {
			Vehicle.post($scope.vehicle).then(function (vehicle_id) {
				$scope.uploader.formData = { vehicle_id: vehicle_id };
				$scope.uploader.uploadAll();
				$scope.vehicle = {};
			});
		};
	}])
	.controller('TheVehicleEditCtrl', ['$scope', '$routeParams', '$location', 'Vehicle', function ($scope, $routeParams, $location, Vehicle) {
		Vehicle.one($routeParams.vehicleId).get().then(function (vehicle) {
			$scope.vehicle = vehicle;
		});

		$scope.submit = function () {
			$scope.vehicle.put().then(function () {
				$scope.uploader.formData = { vehicle_id: $routeParams.vehicleId };
				$scope.uploader.uploadAll();
				$location.path('/vehicle');
			});
		};
	}])
	.factory('Vehicle', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('vehicle');
	}]);
