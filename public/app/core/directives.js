angular.module('divulgausados')
	.directive('hasAllRoles', function (AuthService) {
		return {
			restrict: 'A',
			link: function (scope, element, attrs) {
				var roles = attrs.hasAllRoles.split(/\s*,\s*/);
				scope.$watch(function () {
					if (AuthService.hasAllRoles(roles)) {
						element.removeClass('hidden');
					} else {
						element.addClass('hidden');
					}
				});
			}
		};
	})
	.directive('hasAnyRole', function (AuthService) {
		return {
			restrict: 'A',
			link: function (scope, element, attrs) {
				var roles = attrs.hasAnyRole.split(/\s*,\s*/);
				scope.$watch(function () {
					if (AuthService.hasAnyRole(roles)) {
						element.removeClass('hidden');
					} else {
						element.addClass('hidden');
					}
				});
			}
		};
	})
	.directive('authenticated', function (AuthService) {
		return {
			restrict: 'A',
			link: function (scope, element, attrs) {
				var needAuthentication = 'true' === attrs.authenticated;
				var noAuthentication = 'false' === attrs.authenticated;
				scope.$watch(function () {
					if ((needAuthentication && !AuthService.isAuthenticated()) || (noAuthentication && AuthService.isAuthenticated())) {
						element.addClass('hidden');
					} else {
						element.removeClass('hidden');
					}
				});
			}
		};
	})
	.directive('messageBox', function () {
		return {
			restrict: 'E',
			templateUrl: 'app/core/message-box.html',
			controller: function ($scope) {
				$scope.isCollapsed = true;
			}
		};
	})
	.directive('showErrors', function () {
		return {
			restrict: 'A',
			require: '^form',
			link: function (scope, element, attrs, controller) {
				var inputElement = element[0].querySelector("[name]");
				var inputNgElement = angular.element(inputElement);
				var inputName = inputNgElement.attr('name');
				inputNgEl.bind('keyup', function () {
					element.toggleClass('has-success', controller[inputName].$valid);
					element.toggleClass('has-error', controller[inputName].$invalid);
				});
			}
		};
	});