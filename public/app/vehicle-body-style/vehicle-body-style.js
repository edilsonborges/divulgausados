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

		show: function (id) {
			var requestUrl = '/service/body-style/' + id;
			return $http.get(requestUrl);
		},

		update: function (bodyStyle) {
			var requestUrl = '/service/body-style/' + bodyStyle.id;
			return $http({
				method: 'PUT',
				url: requestUrl,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(bodyStyle)
			});
		},

		destroy: function (id) {
			return $http.delete('/service/body-style/' + id);
		}
	};
}]);