divulgaUsadosApp.controller('VehicleBodyStyleEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleBodyStyle', function ($scope, $location, $routeParams, VehicleBodyStyle) {
	$scope.form = {
		title: 'Alterar uma categoria de veículo',

		submit: function (bodyStyle) {
			VehicleBodyStyle.update(bodyStyle).success(function (response) {
				$scope.form.status = response.status;
				$scope.form.message = response.message;
				$location.path('/vehicle-body-style');
			});
		}
	};

	VehicleBodyStyle.show($routeParams.id).success(function (response) {
		$scope.form.model = response;
	});

}]);