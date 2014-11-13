'use strict';

angular.module('divulgausados').factory('PaginationService', [ function() {
    var paginate = {};

    var utilities = {
	getNextPage : function() {
	    if (this.currentPage < this.totalPages) {
		this.currentPage++;
	    }
	},
	getPreviousPage : function() {
	    if (this.currentPage > 1) {
		this.currentPage--;
	    }
	},
	getFirstPage : function() {
	    this.currentPage = 1;
	},
	getLastPage : function() {
	    this.currentPage = this.totalPages;
	},
	getCurrentPage : function() {
	    return this.currentPage;
	},
	setCurrentPage : function(page) {
	    this.currentPage = page;
	},
	isCurrentPage : function(page) {
	    return (this.currentPage == page);
	},
	isFirstPage : function() {
	    return (this.currentPage == 1);
	},
	isLastPage : function() {
	    return (this.currentPage == this.totalPages);
	}
    };

    return {
	init : function(settings) {
	    utilities.total = settings.total;
	    utilities.currentPage = settings.current_page;
	    utilities.totalPages = settings.last_page;
	    utilities.pages = [];

	    for (var current = 1; current <= utilities.totalPages; current++) {
		utilities.pages.push(current);
	    }
	    this.utilities = utilities;
	},

	getPaginator : function() {
	    return this.utilities;
	}
    };
} ]).factory('SessionFactory', ['', function(){
	return {
		get: function (key) {
			return sessionStorage.getItem(key);
		},

		set: function (key, value) {
			return sessionStorage.setItem(key, value);
		},

		unset: function (key) {
			return sessionStorage.removeItem(key);
		}
	};
}]).service('AuthenticationService', ['$http', '$location', 'SessionFactory', function($http, $location, SessionFactory) {
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
}]).run(['$rootScope', '$location', 'AuthenticationService', function($rootScope, $location, AuthenticationService) {
	var allowedLinks = [
		'/'
	];

	$rootScope.$on('$routeChangeStart', function (event, next, current) {
		if (!_(protectedLinks).contains($location.path()) && !AuthenticationService.isLoggedIn()) {
			$location.path('/');
		}
	});
}]);