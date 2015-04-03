angular.module('divulgausados')
	.config(['$routeProvider', function ($routeProvider) {
		$routeProvider.when('/vehicle/create', {
			templateUrl: 'app/vehicle/vehicle-view-form.html',
			controller: 'TheVehicleCreateCtrl'
		});
	}])
	.controller('TheVehicleCreateCtrl', ['$scope', 'Vehicle', 'VehicleBodyStyle', 'VehicleMake', 'VehicleModel', 'VehicleModelSeries', 'FileUploader', function ($scope, Vehicle, VehicleBodyStyle, VehicleMake, VehicleModel, VehicleModelSeries, FileUploader) {
		$scope.vehicle = {};

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

		$scope.findModelSeries = function () {
			VehicleModelSeries.getList({
				filter_by_model_id: $scope.selectedModel.id
			}).then(function (response) {
				$scope.modelSeriesList = response;
			});
		};

		$scope.submit = function () {
			Vehicle.post($scope.vehicle).then(function (vehicle_id) {
				$scope.uploader.formData = { vehicle_id: vehicle_id };
				$scope.uploader.uploadAll();
				$scope.vehicle = {};
			});
		};
	}])
	.factory('Vehicle', ['RestfulFactory', function (RestfulFactory) {
		return RestfulFactory.service('vehicle');
	}]);