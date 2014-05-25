divulgaUsadosApp.controller('VehicleBodyStyleCreateCtrl', ['$scope', '$location', 'VehicleBodyStyle', function ($scope, $location, VehicleBodyStyle) {
	$scope.form = {
		title: 'Incluir uma categoria de veículo',

		submit: function (bodyStyle) {
			VehicleBodyStyle.store(bodyStyle).success(function (response) {
				$scope.form.model = {};
				$scope.form.status = response.status
				$scope.form.message = response.message;
			});
		},

		model: {}
	};
}]);