
var app = angular.module('search', ['ngTable'])
.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.safeApply(function () {
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
})
.filter("asDate", function () {
    return function (input) {
        return new Date(input);
    }
})
.factory('TableFactory', function ($http) {
    var searchAPI = {};

    searchAPI.lookup = function (criteria) {
        return $http.get('/index.php/search/lookup/' + criteria);
        //.success(function (data, status, headers, config) { alert(data); return data; })
        //.error( function(data, status, headers, config) { alert('I AM BAD: ' + data + ' - STATUS: ' + status + ' - HEADERS: ' + headers); });
    }

    return searchAPI;
})
.controller('TableCtrl', function ($scope, $filter, $timeout, ngTableParams, TableFactory) {

    $scope.students = [];
    $scope.criteria = 'Enter SIF # to find a student';

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

    $scope.lookupBySIF = function () {

        TableFactory.lookup($scope.criteria).success(function (data) {
            $scope.tableParams.reload();
            $scope.students = data;
        });
    };

    $scope.tableParams = new ngTableParams({
        page: 1,
        count: 10,
        sorting: { name: 'asc' }
    }, {
        total: 0, // length of data
        getData: function ($defer, params) {

            $timeout(function () {
                var orderedData = params.sorting() ?
                    $filter('orderBy')($scope.students, params.orderBy()) :
                    $scope.students;

                $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));

                params.total(orderedData.length);
            }, 50);

        }
    });

});
//.config( function ($routeProvider) {
//    $routeProvider.
//      when("/versions/:id", { templateUrl: "search/versions-table.php", controller: 'TableCtrl' }).
//      otherwise({ redirectTo: '/search' });
//});