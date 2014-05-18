divulgaUsadosApp.controller('VehicleBodyStyleCreateCtrl', ['$scope', '$http', '$location', 'VehicleBodyStyle', function ($scope, $http, $location, VehicleBodyStyle) {

	$scope.bodyStyleFormData = {};

	$scope.submitCategory = function () {
		VehicleBodyStyle.store($scope.bodyStyleFormData).success(function (response) {
			$location.path('/vehicle-body-style');
		});
	};
}]);