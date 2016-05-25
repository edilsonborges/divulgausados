angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/feature-category', {
            templateUrl: 'app/feature-category/feature-category-view-list.html',
            controller: 'VehicleFeatureCategoryListCtrl'
        })
        .when('/feature-category/create', {
            templateUrl: 'app/feature-category/feature-category-view-form.html',
            controller: 'VehicleFeatureCategoryCreateCtrl'
        })
        .when('/feature-category/:featureCategoryId', {
            templateUrl: 'app/feature-category/feature-category-view-form.html',
            controller: 'VehicleFeatureCategoryEditCtrl'
        });
    }])
    
    .controller('VehicleFeatureCategoryListCtrl', ['$scope', 'VehicleFeatureCategory', 'PaginationService', function ($scope, VehicleFeatureCategory, PaginationService) {
        $scope.paginator = PaginationService;

        $scope.search = function () {
            $scope.paginator.load(function (pagination) {
                var queryParams = {
                    page: pagination.getCurrentPage(),
                    page_size: pagination.getPageSize(),
                    filter_by_name: $scope.filterByName
                };
                VehicleFeatureCategory.getList(queryParams).then(function (response) {
                    $scope.featureCategoryList = response;
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
            VehicleFeatureCategory.one(id).remove().then(function () {
                $scope.search();
            });
        };
    }])

    .controller('VehicleFeatureCategoryCreateCtrl', ['$scope', 'VehicleFeatureCategory', function ($scope, VehicleFeatureCategory) {
        $scope.featureCategory = {};

        $scope.submit = function () {
            VehicleFeatureCategory.post($scope.featureCategory).then(function () {
                $scope.featureCategory = {};
            });
        };
    }])

    .controller('VehicleFeatureCategoryEditCtrl', ['$scope', '$location', '$routeParams', 'VehicleFeatureCategory', function ($scope, $location, $routeParams, VehicleFeatureCategory) {
        VehicleFeatureCategory.one($routeParams.featureCategoryId).get().then(function (featureCategory) {
            $scope.featureCategory = featureCategory;
        });

        $scope.submit = function () {
            $scope.featureCategory.put().then(function () {
                $location.path('/feature-category');
            });
        };
    }])

    .factory('VehicleFeatureCategory', ['RestfulFactory', function (RestfulFactory) {
        return RestfulFactory.service('feature-category');
    }]);
