divulgaUsadosApp.directive('vehicleBodyStyleForm', function(){
	return {
		restrict: 'E',
		require: 'ngModel',
		scope: {
			form: "=form",
			bodyStyle: '=model',
			submit: '&submit'
		},
		templateUrl: 'app/vehicle-body-style/vehicle-body-style-form.html'
	};
});
