divulgaUsadosApp.controller('vehicleCategoryController', function ($scope, $http, VehicleCategory) {
	
	$scope.form = {};
	
	VehicleCategory.get().success(function (data) {
		$scope.categoryList = data; 
	});
	
});