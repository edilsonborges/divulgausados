divulgaUsadosApp.directive('messageBox', function () {
	return {
		restrict: 'E',
		scope: {
			messageSource: '=message',
			status: '='
		},
		templateUrl: 'app/common/message-box/message-box.html'
	};
});