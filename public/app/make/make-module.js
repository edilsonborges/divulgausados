angular.module('divulgausados')
	.config(
		['$routeProvider', function($routeProvider) {
			$routeProvider.when('/make', {
				templateUrl: 'app/make/make-view-list.html',
				controller: 'VehicleMakeListCtrl'
			}).

			when('/make/create', {
				templateUrl: 'app/make/make-view-create.html',
				controller: 'VehicleMakeCreateCtrl'
			});
		}])
	.controller('VehicleMakeListCtrl', ['$scope', 'VehicleMake', function($scope, VehicleMake) {

		$scope.makeList = {};

		$scope.isShowingDestroyed = false;

		var findMakeList = function(makeList) {
			$scope.makeList = makeList;
		};

		$scope.showDestroyed = function(showDestroyed) {
			$scope.isShowingDestroyed = showDestroyed;
			VehicleMake.get(showDestroyed).success(findMakeList);
		};

		var updateTable = function(response) {
			$scope.messageSource = response.messageList;
			$scope.status = response.status;
			$scope.showDestroyed($scope.isShowingDestroyed);
		};

		$scope.restoreMake = function(id) {
			VehicleMake.restore(id).success(updateTable);
		};

		$scope.destroyMake = function(id) {
			VehicleMake.destroy(id).success(updateTable);
		};

		$scope.showDestroyed($scope.isShowingDestroyed);
	}])
	.controller('VehicleMakeCreateCtrl', ['$scope', 'VehicleMake', function($scope, VehicleMake) {
		$scope.form = {
			title: 'Incluir um fabricante de veículos',

			submit: function(make) {
				console.log(make);
				VehicleMake.store(make).success(function(response) {
					$scope.form.messageSource = response.messageList;
					$scope.form.status = response.status;

					if (!response.isError) {
						$scope.form.model = {};
					}
				});
			},

			model: {}

		};
	}])
	.service('VehicleMake', ['$http', function($http) {
		var request = '/service/make';

		this.get = function(showDestroyed) {
			return $http.get(request, {
				params: {
					'showDestroyed': showDestroyed
				}
			});
		};

		this.show = function(id) {
			return $http.get(request + '/' + id);
		};

		this.store = function(make) {
			return $http.post(request, make);
		};

		this.update = function(make) {
			return $http.put(request + '/' + id, make);
		};

		this.restore = function(id) {
			return $http.get(request + '/' + id + '/edit');
		};

		this.destroy = function(id) {
			return $http.delete(request + '/' + id);
		};

	}])
	.directive('makeForm', function() {
		return {
			restrict: 'E',
			scope: {
				form: "=form",
				make: '=model',
				submit: '&submit'
			},
			templateUrl: 'app/make/make-view-form.html'
		};
	});