divulgaUsadosApp.service('VehicleBodyStyle', ['$http', function ($http) {
	return {
		get: function () {
			return $http.get('/service/body-style');
		},

		store: function (bodyStyle) {
			return $http({
				method: 'POST',
				url: '/service/body-style',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(bodyStyle)
			});
		},

		update: function (id, bodyStyle) {
			var updateUrl = '/service/body-style/' + id;
			return $http({
				method: 'PUT',
				url: updateUrl,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(bodyStyle)
			});
		},

		destroy: function (id) {
			return $http.delete('/service/body-style/' + id);
		}
	};
}]);