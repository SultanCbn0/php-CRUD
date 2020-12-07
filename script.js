var myApp = angular.module('myApp', []);

myApp.controller('listControl', function ($scope, $http) {

    //////GET//////

    $http({
        method: 'GET',
        url: 'http://localhost/odev4/GET.php'
    }).then(function (response) {
        $scope.Results = response.data.records;
    });

    $scope.delete = function (value) {

        ///////DELETE///////

        $http({
            method: 'POST',
            url: 'http://localhost/odev4/DELETE.php',
            data: ({
                value: value
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(function (response) {

            $http({
                method: 'GET',
                url: 'http://localhost/odev4/GET.php'
            }).then(function (response) {
                $scope.Results = response.data.records;
            });

        }).catch(function onError(error) {
            console.log(error);
        });
    }

    ////////INSERT/////////

    $scope.veri = {};
    $scope.insert = function () {
        $http({
            method: 'POST',
            url: 'http://localhost/odev4/INSERT.php',
            data: $scope.veri,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }

        }).then(function (response) {
            $http({
                method: 'GET',
                url: 'http://localhost/odev4/GET.php'
            }).then(function (response) {
                $scope.Results = response.data.records;

            });

        }).catch(function onError(error) {
            console.log(error);
        });
    }

    /////////UPDATE///////////

    $scope.veri2 = {};
    $scope.update = function () {

        $http({
            method: 'POST',
            url: 'http://localhost/odev4/UPDATE.php',
            data: $scope.veri2,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(function (response) {

            $http({
                method: 'GET',
                url: 'http://localhost/odev4/GET.php'
            }).then(function (response) {
                $scope.Results = response.data.records;
            });

        }).catch(function onError(error) {
            console.log(error);
        });
    }
    //////////////////SEARCH///////////////////

    $scope.fetchProduct = function () {

        $http({
            method: 'POST',
            url: 'http://localhost/odev4/SEARCH.php',
            data: {
                search_query: $scope.search_query,
            },
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(function(response) {
            $scope.Results = response.data;

        });
    }
    
    ////////////ORDER////////
    
    $scope.order=function(val){
        $http({
            method:'POST',
            url:'http://localhost/odev4/ORDER.php',
            data:{
                val:val
            },
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(function(response){
           $scope.Results=response.data; 
            console.log($scope.Results);
        });
    }

    $scope.ui = {
        min: 0,
        max: 1000
    };

    $scope.menuInsert = function () {
        $("#Menu").slideToggle("fast");
    }

    $scope.menuUpdate = function (value) {
        for (var i = 0; i < $scope.Results.length; i++) {
            if ($scope.Results[i].id == value) {
                $scope.veri2 = $scope.Results[i];
            }
        }

        $("#Menu2").slideToggle("fast");
    }

    $scope.filterGoster = function () {
        $("#filter").slideToggle("fast");
    }

});

myApp.filter('rangeFilter', function () {
    return function (items, attr, min, max) {
        l = items.length;
        var range = [],
            min = parseFloat(min),
            max = parseFloat(max);
        for (var i = 0; i < l; ++i) {
            var item = items[i];
            if (item[attr] <= max && item[attr] >= min) {
                range.push(item);
            }
        }
        return range;
    };
});

myApp.directive('input', function () {
    return {
        restrict: 'E',
        require: '?ngModel',
        link: function (scope, element, attrs, ngModel) {
            if ('numeric' in attrs) {
                ngModel.$parsers.push(parseFloat);
            }
        }
    };
});
