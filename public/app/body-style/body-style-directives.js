divulgaUsadosApp.directive('bodyStyleForm', function(){
	return {
		restrict: 'E',
		scope: {
			form: "=form",
			bodyStyle: '=model',
			submit: '&submit'
		},
		templateUrl: 'app/body-style/body-style-view-form.html'
	};
});
