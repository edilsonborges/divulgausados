divulgaUsadosApp.directive('makeForm', function(){
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
