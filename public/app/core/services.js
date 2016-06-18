angular.module('divulgausados')
	.service('MessageService', function ($rootScope, $timeout) {
		var that = this;
		$rootScope.alerts = [];
		var Alert = function (type, message) {
			this.type = type;
			this.message = message;
		};
		var addAlert = function (alert) {
			$rootScope.alerts.push(alert);
			$timeout(function () {
				$rootScope.alerts.splice($rootScope.alerts.indexOf(alert), 1);
			}, 5000);
		};
		this.addError = function (error) {
			addAlert(new Alert('danger', error));
		};
		this.addErrors = function (errors) {
			angular.forEach(errors, function (error) {
				that.addError(error);
			});
		};
		this.addWarning = function (warning) {
			addAlert(new Alert('warning', warning));
		};
		this.addWarnings = function (warnings) {
			angular.forEach(warnings, function (warning) {
				that.addWarning(warning);
			});
		};
		this.addSuccess = function (success) {
			addAlert(new Alert('success', success));
		};
		this.addSuccesses = function (successes) {
			angular.forEach(successes, function (success) {
				that.addSuccess(success);
			});
		};
	})
	.service('AuthenticationService', ['$http', '$location', '$rootScope', '$route', 'localStorageService', 'MessageService', function ($http, $location, $rootScope, $route, localStorageService, MessageService) {
		var AuthenticationService = this;
		this.login = function (credentials) {
			$http.post('/v1/authentication/login', credentials)
				.then(function (response) {
					if (response.data) {
						AuthenticationService.user(response.data.user);
						MessageService.addSuccesses(response.data.successMessages);
						$location.url('/dashboard');
					}
				}, function (response) {
					if (response.data && response.data.warningMessages) {
						MessageService.addWarnings(response.data.warningMessages);
					}
				});
		};
		this.logout = function () {
			$http.post('/v1/authentication/logout').then(function () {
				AuthenticationService.user(null);
				$location.url('/');
			});
		};
		this.user = function (userInfo) {
			if (userInfo === undefined) {
				return localStorageService.get('authenticated-user');
			} else {
				localStorageService.set('authenticated-user', userInfo);
			}
		};
		this.isAuthenticated = function () {
			return !!(document.cookie && document.cookie.indexOf('PHPSESSIONID') >= 0) || !!this.user();
		};
		this.hasAllRoles = function (neededRoles) {
			if (!neededRoles || neededRoles.length === 0) {
				return true;
			}
			if (!that.isAuthenticated()) {
				return false;
			}
			for (var i = 0; i < neededRoles.length; ++i) {
				if (that.user().roles.indexOf(neededRoles[i]) < 0) {
					return false;
				}
			}
			return true;
		};
		this.hasAnyRole = function (neededRoles) {
			if (!neededRoles || neededRoles.length === 0) {
				return true;
			}
			if (!that.isAuthenticated()) {
				return false;
			}
			for (var i = 0; i < neededRoles.length; ++i) {
				if (that.user().roles.indexOf(neededRoles[i]) >= 0) {
					return true;
				}
			}
			return false;
		};
	}])
	.service('PaginationService', [function () {
		this.params = {
			current_page: 1,
			page_size: 10,
			total_items: 0
		};

		this.load = function (callback) {
			return callback(this);
		};

		this.setup = function (params) {
			this.params = params;
		};

		this.getCurrentPage = function () {
			return this.params.current_page;
		};

		this.getPageSize = function () {
			return this.params.page_size;
		};

		this.getTotalItems = function () {
			return this.params.total_items;
		};

		this.show = function () {
			return this.params.total_items > this.params.page_size;
		};
	}])
	.factory('RestfulFactory', ['Restangular', 'MessageService', function (Restangular, MessageService) {
		var triggerMessages = function (data) {
			MessageService.addErrors(data.errorMessages);
			MessageService.addWarnings(data.warningMessages);
			MessageService.addSuccesses(data.successMessages);
		};

		Restangular.setErrorInterceptor(function (response) {
			triggerMessages(response.data);
		});

		return Restangular.withConfig(function (RestangularConfigurer) {
			RestangularConfigurer.addResponseInterceptor(function (data, operation) {
				var extractedData;
				if (operation === "getList" && data.content.data) {
					extractedData = data.content.data;
					extractedData.meta = {
						'current_page': data.content.current_page,
						'page_size': data.content.per_page,
						'total_items': data.content.total
					};
				} else {
					extractedData = data.content;
				}
				triggerMessages(data);
				return extractedData;
			});
		});
	}])
	.service('ImageUploadService', ['FileUploader', function (FileUploader) {
		this.create = function (url) {
			var uploader = new FileUploader({
				url: url,
				removeAfterUpload: true,
				queueLimit: 1
			});
			this.addFilter(uploader);
			return uploader;
		};

		this.addFilter = function (uploader) {
			uploader.filters.push({
				name: 'imageFilter',
				fn: function (item) {
					var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
					return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
				}
			});
		};

		this.addFormData = function (uploader, formData) {
			uploader.onBeforeUploadItem = function (item) {
				item.formData.push(formData);
			};
		};
	}]);
