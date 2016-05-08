angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/feature-category', {
            templateUrl: 'app/feature-category/make-view-list.html',
            controller: 'VehicleFeatureCategoryListCtrl'
        })
            .when('/feature-category/create', {
                templateUrl: 'app/feature-category/make-view-form.html',
                controller: 'VehicleFeatureCategoryCreateCtrl'
            })
            .when('/feature-category/:makeId', {
                templateUrl: 'app/feature-category/make-view-form.html',
                controller: 'VehicleFeatureCategoryEditCtrl'
            });
    }])
    .factory('VehicleFeatureCategory', ['RestfulFactory', function (RestfulFactory) {
        return RestfulFactory.service('feature-category');
    }]);
