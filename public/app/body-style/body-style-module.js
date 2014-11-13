'use strict';

angular.module('divulgausados').controller('VehicleBodyStyleListCtrl', ['$scope', 'VehicleBodyStyle', function ($scope, VehicleBodyStyle) {
	$scope.bodyStyleList = {};
	$scope.page = 1;

	var findBodyStyleList = function (page) {
		VehicleBodyStyle.get(page).success(function (bodyStyleList) {
			$scope.bodyStyleList = bodyStyleList;
			$scope.page = bodyStyleList.current_page;
		});
	};

	findBodyStyleList($scope.page);

	$scope.destroyBodyStyle = function (id) {
		VehicleBodyStyle.destroy(id).success(function (response) {
			$scope.messageSource = response.messageList;
			$scope.status = response.status;

			findBodyStyleList($scope.page);
		});
	};

	$scope.$on('changePage', function (event, data) {
		findBodyStyleList(data);
	});
}]).controller('VehicleBodyStyleCreateCtrl', ['$scope', 'VehicleBodyStyle', function ($scope, VehicleBodyStyle) {
	$scope.form = {
		title: 'Incluir uma categoria de veículo',

		submit: function (bodyStyle) {
			VehicleBodyStyle.store(bodyStyle).success(function (response) {
				$scope.form.messageSource = response.messageList;
				$scope.form.status = response.status;

				if (!response.isError) {
					$scope.form.model = {};
				}
			});
		},

		model: {}
	};
}]).controller('VehicleBodyStyleEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleBodyStyle', function ($scope, $location, $routeParams, VehicleBodyStyle) {
	$scope.form = {
		title: 'Alterar uma categoria de veículo',

		submit: function (bodyStyle) {
			VehicleBodyStyle.update(bodyStyle).success(function (response) {
				$scope.form.messageSource = response.messageList;
				$scope.form.status = response.status;

				if (!response.isError) {
					$location.path('/vehicle-body-style');
				}
			});
		}
	};

	VehicleBodyStyle.show($routeParams.id).success(function (response) {
		$scope.form.model = response;
	});

}]).factory('VehicleBodyStyle', ['$http', function ($http) {
	return {
		get: function (page) {
			return $http.get('/service/body-style', {
				params: { 'page': page }
			});
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
}]).directive('bodyStyleForm', function(){
	return {
		restrict: 'E',
		scope: {
			form: "=form",
			bodyStyle: '=model',
			submit: '&submit'
		},
		templateUrl: 'app/body-style/body-style-view-form.html'
	};
});
