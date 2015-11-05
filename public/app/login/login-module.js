angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/login', {
            templateUrl: 'app/login/login-view-index.html',
            controller: 'LoginCtrl'
        });
    }])
    .controller('LoginCtrl', ['$scope', function ($scope) {
        $scope.user = {};

        $scope.login = function () {

        };
    }]);