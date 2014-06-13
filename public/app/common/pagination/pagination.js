divulgaUsadosApp.factory('PaginationService', [function () {
	var paginate = {};

	var utilities = {
		getNextPage: function () {
			if (this.currentPage < this.totalPages) {
				this.currentPage++;
			}
		},

		getPreviousPage: function () {
			if (this.currentPage > 1) {
				this.currentPage--;
			}
		},

		getFirstPage: function () {
			this.currentPage = 1;
		},

		getLastPage: function () {
			this.currentPage = this.totalPages;
		},

		getCurrentPage: function () {
			return this.currentPage;
		},

		setCurrentPage: function (page) {
			this.currentPage = page;
		},

		isCurrentPage: function (page) {
			return (this.currentPage == page);
		},

		isFirstPage: function () {
			return (this.currentPage == 1);
		},

		isLastPage: function () {
			return (this.currentPage == this.totalPages);
		}
	};

	return {
		init: function (settings) {
			utilities.total = settings.total;
			utilities.currentPage = settings.current_page;
			utilities.totalPages = settings.last_page;
			utilities.pages = [];

			for (var current = 1; current <= utilities.totalPages; current++) {
				utilities.pages.push(current);
			}
			this.utilities = utilities;
		},

		getPaginator: function () {
			return this.utilities;
		}
	};
}]);

divulgaUsadosApp.directive('pagination', ['PaginationService', function (PaginationService) {
	return {
		retrict: 'AE',
		scope: {
			paginate: '=pagination'
		},
		link: function (scope, element, attribute) {
			var doPaginate = function (settings, oldSettings) {
				PaginationService.init(settings);
				scope.pg = PaginationService.getPaginator();
			};

			var doPageChange = function (newPage, oldPage) {
				if (newPage != oldPage) {
					scope.$emit('changePage', newPage);
				}
			};

			scope.$watch('paginate', doPaginate);
			scope.$watch('pg.currentPage', doPageChange);
		},
		templateUrl: 'app/common/pagination/pagination.html'
	};
}]);