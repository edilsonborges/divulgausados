var divulgaUsadosApp = angular.module('DivulgaUsadosApp', ['ngRoute', 'ngResource']);

divulgaUsadosApp.config(['$routeProvider', function($routeProvider) {

	$routeProvider.
		when('/', {
			templateUrl: 'app/views/index.html',
			controller: 'MainCtrl'
		}).

		when('/vehicle-body-style', {
			templateUrl: 'app/vehicle-body-style/vehicle-body-style-index.html',
			controller: 'VehicleBodyStyleListCtrl'
		}).

		when('/vehicle-body-style/create', {
			templateUrl: 'app/vehicle-body-style/vehicle-body-style-create.html',
			controller: 'VehicleBodyStyleCreateCtrl'
		}).

		when('/vehicle-body-style/edit/:id', {
			templateUrl: 'app/vehicle-body-style/vehicle-body-style-edit.html',
			controller: 'VehicleBodyStyleEditCtrl'
		}).
		
		otherwise({
			redirectTo: '/'
		});
	}
]);

divulgaUsadosApp.controller('MainCtrl', ['$scope', function ($scope) {

}]);
;divulgaUsadosApp.controller('VehicleBodyStyleCreateCtrl', ['$scope', '$http', '$location', 'VehicleBodyStyle', function ($scope, $http, $location, VehicleBodyStyle) {

	$scope.bodyStyleFormData = {};

	$scope.submitCategory = function () {
		VehicleBodyStyle.store($scope.bodyStyleFormData).success(function (response) {
			$location.path('/vehicle-body-style');
		});
	};
}]);;divulgaUsadosApp.controller('VehicleBodyStyleEditCtrl', ['$scope', '$http', 'VehicleBodyStyle', function ($scope, $http, VehicleBodyStyle) {
		
}]);;divulgaUsadosApp.controller('VehicleBodyStyleListCtrl', ['$scope', '$http', 'VehicleBodyStyle', function ($scope, $http, VehicleBodyStyle) {
		
	$scope.bodyStyleList = {};

	VehicleBodyStyle.get().success(function (bodyStyleList) {
		$scope.bodyStyleList = bodyStyleList;
	});

	$scope.destroyBodyStyle = function (id) {
		VehicleBodyStyle.destroy(id).success(function (response) {
			VehicleBodyStyle.get().success(function (bodyStyleList) {
				$scope.bodyStyleList = bodyStyleList;
			});
		});
	};
	
}]);;divulgaUsadosApp.service('VehicleBodyStyle', ['$http', function ($http) {
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