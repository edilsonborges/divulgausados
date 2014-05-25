divulgaUsadosApp.controller('VehicleBodyStyleListCtrl', ['$scope', '$http', 'VehicleBodyStyle', function ($scope, $http, VehicleBodyStyle) {
		
	$scope.bodyStyleList = {};

	VehicleBodyStyle.get().success(function (bodyStyleList) {
		$scope.bodyStyleList = bodyStyleList;
	});

	$scope.destroyBodyStyle = function (id) {
		VehicleBodyStyle.destroy(id).success(function (response) {
			$scope.message = response.message;
			$scope.status = response.status;

			VehicleBodyStyle.get().success(function (bodyStyleList) {
				$scope.bodyStyleList = bodyStyleList;
			});
		});
	};
	
}]);
