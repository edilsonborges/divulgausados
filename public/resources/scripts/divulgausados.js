var divulgaUsadosApp = angular.module('divulgaUsadosApp', []);
;angular.module('divulgaUsadosApp').controller('vehicleCategoryController', function ($scope, $http, VehicleCategory) {
	
	$scope.form = {};
	
	VehicleCategory.get().success(function (data) {
		$scope.categoryList = data; 
	});
	
});;angular.module('divulgaUsadosApp').factory('VehicleCategory', function ($http) {
	return {
		get: function () {
			return $http.get('/service/category');
		}
	};
});