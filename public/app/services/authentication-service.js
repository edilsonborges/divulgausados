divulgaUsadosApp.service('AuthenticationService', ['$http', '$location', 'SessionFactory', function($http, $location, SessionFactory) {
	var cacheSession = function () {
		SessionFactory.set('authenticated', true);
	};

	var uncacheSession = function () {
		SessionFactory.unset('authenticated');
	};

	this.login = function (credentials) {
		$http.post('/service/authentication/login', credentials).success(cacheSession);
	};

	this.isLoggedIn = function () {
		return SessionFactory.get('authenticated');
	};

	this.logout = function () {
		$http.post('/service/authentication/logout', credentials).success(uncacheSession);
	};
}]);

divulgaUsadosApp.run(['$rootScope', '$location', 'AuthenticationService', function($rootScope, $location, AuthenticationService) {
	var allowedLinks = [
		'/'
	];

	$rootScope.$on('$routeChangeStart', function (event, next, current) {
		if (!_(protectedLinks).contains($location.path()) && !AuthenticationService.isLoggedIn()) {
			$location.path('/');
		}
	});
}]);
