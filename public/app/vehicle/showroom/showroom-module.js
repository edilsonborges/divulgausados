angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/vehicle/showroom/:vehicleId', {
            templateUrl: 'app/vehicle/showroom/showroom-view-index.html',
            controller: 'VehicleShowroomCtrl'
        });
    }])
    .controller('VehicleShowroomCtrl', ['$scope', '$routeParams', '$location', 'Vehicle', function ($scope, $routeParams, $location, Vehicle) {
        Vehicle.one($routeParams.vehicleId).get().then(function (vehicle) {
            $scope.vehicle = vehicle;
        });

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