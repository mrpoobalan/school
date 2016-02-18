
var formApp = angular.module('form', [])
.directive( 'ngLink', function ( $window ) {
    return function (scope, element, attrs) {
        element.bind('click', function () {
            scope.safeApply(function () {
                $window.location.href = attrs.ngLink;
            });

            return false;
        });
    };
})
.controller("FormCtrl", function ($scope, $location, $http) {
    $scope.formData = {};

    $scope.safeApply = function (fn) {
        var phase = this.$root.$$phase;
        if (phase == '$apply' || phase == '$digest') {
            if (fn && (typeof (fn) === 'function')) {
                fn();
            }
        } else {
            this.$apply(fn);
        }
    };

    $scope.processForm = function () {
        $http({
            method: 'POST',
            url: 'save',
            data: $.param($scope.formData),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function (data) {
            console.log(data);

            for (var prop in $scope.formaData) {
                alert($scope.formaData[prop]);
                $scope.formaData[prop] = '';
            }
            //if (!data.success) {
            //    // if not successful, bind errors to error variables
            //    $scope.errorName = data.errors.name;
            //    $scope.errorSuperhero = data.errors.superheroAlias;
            //} else {
            //    // if successful, bind success message to message
            //    $scope.message = data.message;
            //}
        })
        .error(function (data) {
            console.log(data);
        });
    };

//})
//.config(function ($routeProvider) {
//    //$locationProvider.html5Mode(true);
//    $routeProvider
//        .when('/', {
//            templateUrl: 'partials/wiz-main.html',
//            controller: 'FormCtrl'
//        })
//        .when('/wiz002', {
//            templateUrl: 'wiz-002.php',
//            controller: 'FormCtrl'
//        })
//        .when('/wiz003', {
//            templateUrl: 'wiz-003.php',
//            controller: 'FormCtrl'
//        })
//        .when('/wiz004/:aid', {
//            templateUrl: 'wiz-004.php',
//            controller: 'FormCtrl'
//        })
//        .otherwise({ redirectTo: '/' });
});