divulgaUsadosApp.controller('VehicleMakeListCtrl', ['$scope', 'VehicleMake', function($scope, VehicleMake) {
	
	$scope.makeList = {};

	$scope.isShowingDestroyed = false;
	
	var findMakeList = function (makeList) {
		$scope.makeList = makeList;
	};

	$scope.showDestroyed = function (showDestroyed) {
		$scope.isShowingDestroyed = showDestroyed;
		VehicleMake.get(showDestroyed).success(findMakeList);
	};

	var updateTable = function (response) {
		$scope.messageSource = response.messageList;
		$scope.status = response.status;
		$scope.showDestroyed($scope.isShowingDestroyed);
	};

	$scope.restoreMake = function (id) {
		VehicleMake.restore(id).success(updateTable);
	};

	$scope.destroyMake = function (id) {
		VehicleMake.destroy(id).success(updateTable);
	};

	$scope.showDestroyed($scope.isShowingDestroyed);
}]);



divulgaUsadosApp.controller('VehicleMakeCreateCtrl', ['$scope', 'VehicleMake', function($scope, VehicleMake) {
	$scope.form = {
		title: 'Incluir um fabricante de veículos',

		submit: function (make) {
			console.log(make);
			VehicleMake.store(make).success(function (response) {
				$scope.form.messageSource = response.messageList;
				$scope.form.status = response.status;

				if (!response.isError) {
					$scope.form.model = {};
				}
			});
		},

		model: {}

	};
}]);
