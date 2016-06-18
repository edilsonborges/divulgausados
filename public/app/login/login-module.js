angular.module('divulgausados')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/login', {
                templateUrl: 'app/login/login-view-index.html',
                controller: 'LoginCtrl'
            })
            .when('/logout', {
                template: '<div></div>',
                controller: ['AuthenticationService', function (AuthenticationService) {
                    AuthenticationService.logout();
                }]
            })
            .when('/signup', {
                templateUrl: 'app/login/login-view-signup.html',
                controller: 'SignUpCtrl'
            });
    }])
    .controller('LoginCtrl', ['$scope', 'AuthenticationService', function ($scope, AuthenticationService) {
        $scope.user = {};

        $scope.login = function () {
            AuthenticationService.login($scope.user);
        };
    }])
    .controller('SignUpCtrl', ['$scope', '$location', 'User', function ($scope, $location, User) {
        $scope.user = {};

        function goToLogin() {
            $location.url('/login');
        }

        $scope.submit = function () {
            User.post($scope.user).then(function () {
                $scope.user = {};
                goToLogin();
            });
        };
    }])
    .factory('User', ['RestfulFactory', function (RestfulFactory) {
        return RestfulFactory.service('users');
    }]);
