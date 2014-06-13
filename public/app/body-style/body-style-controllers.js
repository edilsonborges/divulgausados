divulgaUsadosApp.controller('VehicleBodyStyleListCtrl', ['$scope', 'VehicleBodyStyle', function ($scope, VehicleBodyStyle) {
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
}]);

divulgaUsadosApp.controller('VehicleBodyStyleCreateCtrl', ['$scope', 'VehicleBodyStyle', function ($scope, VehicleBodyStyle) {
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
}]);

divulgaUsadosApp.controller('VehicleBodyStyleEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleBodyStyle', function ($scope, $location, $routeParams, VehicleBodyStyle) {
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

}]);
