divulgaUsadosApp.factory('VehicleCategory', function ($http) {
	return {
		get: function () {
			return $http.get('/service/category');
		}
	};
});