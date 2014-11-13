'use strict';

angular.module('divulgausados').directive('pagination',
	[ 'PaginationService', function(PaginationService) {
	    return {
		retrict : 'AE',
		scope : {
		    paginate : '=pagination'
		},
		link : function(scope, element, attribute) {
		    var doPaginate = function(settings, oldSettings) {
			PaginationService.init(settings);
			scope.pg = PaginationService.getPaginator();
		    };

		    var doPageChange = function(newPage, oldPage) {
			if (newPage != oldPage) {
			    scope.$emit('changePage', newPage);
			}
		    };

		    scope.$watch('paginate', doPaginate);
		    scope.$watch('pg.currentPage', doPageChange);
		},
		templateUrl : 'app/common/pagination/pagination.html'
	    };
	} ])
 	.directive('messageBox', function() {
	    return {
		restrict : 'E',
		scope : {
		    messageSource : '=message',
		    status : '='
		},
		templateUrl : 'app/common/message-box/message-box.html'
	    };
	});;