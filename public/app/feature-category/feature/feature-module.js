angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/feature-category/:featureCategoryId/feature', {
            templateUrl: 'app/feature-category/feature/feature-view-list.html',
            controller: 'VehicleFeatureListCtrl'
        })
        .when('/feature-category/:featureCategoryId/feature/create', {
            templateUrl: 'app/feature-category/feature/feature-view-form.html',
            controller: 'VehicleFeatureCreateCtrl'
        })
        .when('/feature-category/:featureCategoryId/feature/:featureId', {
            templateUrl: 'app/feature-category/feature/feature-view-form.html',
            controller: 'VehicleFeatureEditCtrl'
        });
    }])

    .controller('VehicleFeatureListCtrl', ['$scope', '$routeParams', 'VehicleFeatureCategory', 'VehicleFeature', 'PaginationService', function ($scope, $routeParams, VehicleFeatureCategory, VehicleFeature, PaginationService) {
        $scope.paginator = PaginationService;

        VehicleFeatureCategory.one($routeParams.featureCategoryId).get().then(function (featureCategory) {
            $scope.featureCategory = featureCategory;
        });

        $scope.search = function () {
            $scope.paginator.load(function (pagination) {
                var queryParams = {
                    page: pagination.getCurrentPage(),
                    page_size: pagination.getPageSize(),
                    filter_by_name: $scope.filterByName
                };
                VehicleFeature.getList(queryParams).then(function (response) {
                    $scope.featureList = response;
                    $scope.paginator.setup(response.meta);
                });
            });
        };
        $scope.search();

        $scope.onRowSelect = function (selected) {
            $scope.selected = selected;
        };

        $scope.isRowSelected = function (item) {
            return $scope.selected == item;
        };

        $scope.destroy = function (id) {
            VehicleFeature.one(id).remove().then(function () {
                $scope.search();
            });
        };
    }])

    .controller('VehicleFeatureCreateCtrl', ['$scope', '$routeParams','VehicleFeatureCategory', 'VehicleFeature', function ($scope, $routeParams, VehicleFeatureCategory, VehicleFeature) {
        $scope.feature = {};

        VehicleFeatureCategory.one($routeParams.featureCategoryId).get().then(function (featureCategory) {
            $scope.featureCategory = featureCategory;
        });

        $scope.submit = function () {
            $scope.feature.featureCategory = $scope.featureCategory;
            VehicleFeature.post($scope.feature).then(function () {
                $scope.feature = {};
            });
        };
    }])

    .controller('VehicleFeatureEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleFeatureCategory', 'VehicleFeature', function ($scope, $location, $routeParams, VehicleFeatureCategory, VehicleFeature) {
        VehicleFeatureCategory.one($routeParams.featureCategoryId).get().then(function (featureCategory) {
            $scope.featureCategory = featureCategory;
        });

        VehicleFeature.one($routeParams.featureId).get().then(function (feature) {
            $scope.feature = feature;
        });

        $scope.submit = function () {
            $scope.feature.put().then(function () {
                $location.path('/feature-category/' + $routeParams.featureCategoryId + '/feature');
            });
        };
    }])

    .factory('VehicleFeature', ['RestfulFactory', function (RestfulFactory) {
        return RestfulFactory.service('feature');
    }]);
