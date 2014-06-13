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
;var divulgaUsadosApp = angular.module('DivulgaUsadosApp', ['ngRoute', 'ngResource']);

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
}]);;/*! divulgausados 23-05-2014 */
var divulgaUsadosApp=angular.module("DivulgaUsadosApp",["ngRoute","ngResource"]);divulgaUsadosApp.config(["$routeProvider",function(a){a.when("/",{templateUrl:"app/views/index.html",controller:"MainCtrl"}).when("/vehicle-body-style",{templateUrl:"app/vehicle-body-style/vehicle-body-style-index.html",controller:"VehicleBodyStyleListCtrl"}).when("/vehicle-body-style/create",{templateUrl:"app/vehicle-body-style/vehicle-body-style-create.html",controller:"VehicleBodyStyleCreateCtrl"}).when("/vehicle-body-style/edit/:id",{templateUrl:"app/vehicle-body-style/vehicle-body-style-edit.html",controller:"VehicleBodyStyleEditCtrl"}).otherwise({redirectTo:"/"})}]),divulgaUsadosApp.controller("MainCtrl",["$scope",function(){}]),divulgaUsadosApp.controller("VehicleBodyStyleCreateCtrl",["$scope","$http","$location","VehicleBodyStyle",function(a,b,c,d){a.bodyStyleFormData={},a.submitCategory=function(){d.store(a.bodyStyleFormData).success(function(){c.path("/vehicle-body-style")})}}]),divulgaUsadosApp.controller("VehicleBodyStyleEditCtrl",["$scope","$http","VehicleBodyStyle",function(){}]),divulgaUsadosApp.controller("VehicleBodyStyleListCtrl",["$scope","$http","VehicleBodyStyle",function(a,b,c){a.bodyStyleList={},c.get().success(function(b){a.bodyStyleList=b}),a.destroyBodyStyle=function(b){c.destroy(b).success(function(){c.get().success(function(b){a.bodyStyleList=b})})}}]),divulgaUsadosApp.service("VehicleBodyStyle",["$http",function(a){return{get:function(){return a.get("/service/body-style")},store:function(b){return a({method:"POST",url:"/service/body-style",headers:{"Content-Type":"application/x-www-form-urlencoded"},data:$.param(b)})},update:function(b,c){var d="/service/body-style/"+b;return a({method:"PUT",url:d,headers:{"Content-Type":"application/x-www-form-urlencoded"},data:$.param(c)})},destroy:function(b){return a.delete("/service/body-style/"+b)}}}]);;divulgaUsadosApp.controller('VehicleBodyStyleCreateCtrl', ['$scope', '$location', 'VehicleBodyStyle', function ($scope, $location, VehicleBodyStyle) {
	$scope.form = {
		title: 'Incluir uma categoria de veículo',

		submit: function (bodyStyle) {
			VehicleBodyStyle.store(bodyStyle).success(function (response) {
				$scope.form.model = {};
				$scope.form.status = response.status;
				$scope.form.message = response.message;
			});
		},

		model: {}
	};
}]);;divulgaUsadosApp.controller('VehicleBodyStyleEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleBodyStyle', function ($scope, $location, $routeParams, VehicleBodyStyle) {
	$scope.form = {
		title: 'Alterar uma categoria de veículo',

		submit: function (bodyStyle) {
			VehicleBodyStyle.update(bodyStyle).success(function (response) {
				$scope.form.status = response.status;
				$scope.form.message = response.message;
				$location.path('/vehicle-body-style');
			});
		}
	};

	VehicleBodyStyle.show($routeParams.id).success(function (response) {
		$scope.form.model = response;
	});

}]);;divulgaUsadosApp.directive('vehicleBodyStyleForm', function(){
	return {
		restrict: 'E',
		require: 'ngModel',
		scope: {
			form: "=form",
			bodyStyle: '=model',
			submit: '&submit'
		},
		templateUrl: 'app/vehicle-body-style/vehicle-body-style-form.html'
	};
});
;divulgaUsadosApp.controller('VehicleBodyStyleListCtrl', ['$scope', '$http', 'VehicleBodyStyle', function ($scope, $http, VehicleBodyStyle) {
		
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
;divulgaUsadosApp.service('VehicleBodyStyle', ['$http', function ($http) {
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