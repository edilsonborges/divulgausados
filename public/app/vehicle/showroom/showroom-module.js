angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/vehicle/showroom/:vehicleId', {
            templateUrl: 'app/vehicle/showroom/showroom-view-index.html',
            controller: 'VehicleShowroomCtrl'
        });
    }])
    .controller('VehicleShowroomCtrl', ['$scope', '$routeParams', '$location', 'Vehicle', 'VehicleFeatureValue', function ($scope, $routeParams, $location, Vehicle, VehicleFeatureValue) {
        $scope.categories = [];
        $scope.features = [];

        Vehicle.one($routeParams.vehicleId).get().then(function (vehicle) {
            $scope.vehicle = vehicle;
        });

        VehicleFeatureValue.getList({'filter_by_vehicle_id': $routeParams.vehicleId}).then(function (result) {
            groupByFeatureCategory(result);
        });

        function groupByFeatureCategory(featureValues) {
            var categories = [];
            var features = [];
            featureValues.forEach(function (featureValue) {
                if (!categories[featureValue.feature.feature_category.id]) {
                    categories[featureValue.feature.feature_category.id] = featureValue.feature.feature_category;
                }
                if (!features[featureValue.feature.feature_category.id]) {
                    features[featureValue.feature.feature_category.id] = [];
                }
                features[featureValue.feature.feature_category.id].push(featureValue)
            });
            $scope.categories = categories;
            $scope.features = features;
        }
        
        $scope.getFeatureByCategory = function (categoryId) {
            return $scope.features[categoryId]; 
        };

        $scope.fetchVehicleImage = function (vehicle) {
            if (!!vehicle && !!vehicle.images[0]) {
                return vehicle.images[0];
            }
            return 'https://placehold.it/1920x1080';
        };

        $scope.fetchBodyStyleImage = function (bodyStyle) {
            if (!!bodyStyle && !!bodyStyle.image_path) {
                return '/img/body-style/' + bodyStyle.image_path;
            }
            return 'https://placehold.it/200x200';
        };

        $scope.fetchMakeImage = function (make) {
            if (!!make && !!make.brand_image_path) {
                return '/img/make/' + make.brand_image_path;
            }
            return 'https://placehold.it/200x200';
        };
    }]);
