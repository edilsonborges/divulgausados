angular.module('divulgausados')
	.directive('hasAllRoles', ['AuthService', function (AuthService) {
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
	}])
	.directive('hasAnyRole',['AuthService', function (AuthService) {
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
	}])
	.directive('authenticated', ['AuthService', function (AuthService) {
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
	}])
	.directive('messageBox', [function () {
		return {
			restrict: 'E',
			templateUrl: 'app/core/message-box.html',
			controller: function ($scope) {
				$scope.isCollapsed = true;
			}
		};
	}])
	.directive('showErrors', [function () {
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
	}])
	/**
    * The ng-thumb directive
    * @author: nerv
    * @version: 0.1.2, 2014-01-09
    */
    .directive('ngThumb', ['$window', function($window) {
        var helper = {
            support: !!($window.FileReader && $window.CanvasRenderingContext2D),
            isFile: function(item) {
                return angular.isObject(item) && item instanceof $window.File;
            },
            isImage: function(file) {
                var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        };

        return {
            restrict: 'A',
            template: '<canvas/>',
            link: function(scope, element, attributes) {
                if (!helper.support) return;

                var params = scope.$eval(attributes.ngThumb);

                if (!helper.isFile(params.file)) return;
                if (!helper.isImage(params.file)) return;

                var canvas = element.find('canvas');
                var reader = new FileReader();

                reader.onload = onLoadFile;
                reader.readAsDataURL(params.file);

                function onLoadFile(event) {
                    var img = new Image();
                    img.onload = onLoadImage;
                    img.src = event.target.result;
                }

                function onLoadImage() {
                    var width = params.width || this.width / this.height * params.height;
                    var height = params.height || this.height / this.width * params.width;
                    canvas.attr({ width: width, height: height });
                    canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
                }
            }
        };
    }])
    .directive('fileUpload', [function(){
    	return {
    		restrict: 'E',
    		templateUrl: 'app/core/file-upload.html',
    		link: function($scope, element, attributes, controller) {
    			
    		}
    	};
    }]);