divulgaUsadosApp.service('VehicleMake', ['$http', function ($http) {
	var request = '/service/make';

	this.get = function (showDestroyed) {
		return $http.get(request, { 
			params: { 'showDestroyed': showDestroyed } 
		});
	};

	this.show = function (id) {
		return $http.get(request + '/' + id);
	};

	this.store = function (make) {
		return $http.post(request, make);
	};

	this.update = function (make) {
		return $http.put(request + '/' + id, make);
	};

	this.restore = function (id) {
		return $http.get(request + '/' + id + '/edit');
	};

	this.destroy = function (id) {
		return $http.delete(request + '/' + id);
	};

}]);
