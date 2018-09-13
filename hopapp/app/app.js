var app = angular.module('hopApp', ["ui.router",'ngCookies']);
app.run(function($rootScope,$location){
    $rootScope.queryEntity = {
        method: "",
        controller: "",
        action: "",
        data: ""
    }
    $rootScope.authData = {
        UserId: 0,
        Name: "",
        Email: "",
        Type: "",
        isAuth: false,
        ProfilePicture: ""
    }
})
app.directive('fileRead', [function () {
    return {
        scope: {
            fileRead: '='
        },
        link: function (scope, elem, attrs) {
            elem.bind('change', function (event) {
                scope.$apply(function () {
                    scope.fileRead = event.target.files[0];
                    $(".img-preview").attr("src",URL.createObjectURL(event.target.files[0]));
                });
            });
        }
    }
}]);
app.config(function($stateProvider, $urlRouterProvider,$locationProvider){
    $locationProvider.hashPrefix('');
    $urlRouterProvider.otherwise("/");
    $/*stateProvider
        .state('dashboard', {
            url: "/",
            templateUrl: "app/views/admin/dashboard.html",
            controller : 'dashboardCtrl'
        })
        .state('map',{
            url:"/map",
            templateUrl:"app/views/admin/map.html",
            controller:"mapCtrl"
        })
        .state('user', {
            url: "/user",
            templateUrl: "app/views/admin/user.html",
            controller : 'adminCtrl'
        })
        .state('driver', {
            url: "/driver",
            templateUrl: "app/views/admin/driver.html",
            controller : 'adminCtrl'
        })
		.state('assignrides',{
            url:"/assign-rides",
            templateUrl:"app/views/admin/assign-rides.html",
            controller:"adminCtrl"
        })
        .state('rides',{
            url:"/rides",
            templateUrl:"app/views/admin/rides.html",
            controller:"adminCtrl"
        })
        .state('reports',{
            url:"/reports",
            templateUrl:"app/views/admin/reports.html",
            controller:'adminCtrl'
        })
        .state('setting',{
            url:'/setting',
            templateUrl:"app/views/admin/setting.html",
            controller:"adminCtrl"
        })
        .state('reportstudent', {
            url:"/report-student",
            templateUrl:"app/views/driver/report-student.html",
            controller:'driverCtrl'
        })
        .state('vehiclechecklist',{
            url:"/vehicle-check",
            templateUrl:"app/views/driver/vehicle-check.html",
            controller:'driverCtrl'
        })
		.state('driverprofile',{
            url:"/update-profile",
            templateUrl:"app/views/driver/driver-profile.html",
            controller:'driverCtrl'
        })
		.state('myrides',{
            url:"/myrides",
            templateUrl:"app/views/driver/my-rides.html",
            controller:"driverCtrl"
        })
		.state('parentprofile',{
            url:"/parent-profile",
            templateUrl:"app/views/parent/parent-profile.html",
            controller:'parentCtrl'
        })
        .state('studentregistration',{
            url:"/register-student",
            templateUrl:"app/views/parent/student-registration.html",
            controller:'parentCtrl'
        })
		.state('child',{
            url:"/child-list",
            templateUrl:"app/views/parent/child.html",
            controller:'parentCtrl'
        })
		.state('Logout', {
        })*/
            $stateProvider
        .state('dashboard', {
            url: "/",
            templateUrl: "app/views/admin/dashboard.html",
            controller: 'dashboardCtrl'
        })
        .state('user', {
            url: "/user",
            templateUrl: "app/views/user.html",
            controller: 'adminCtrl'
        })
        .state('driver', {
            url: "/driver",
            templateUrl: "app/views/driver.html",
            controller: 'adminCtrl'
        })
});
app.controller('dashboardCtrl', function ($scope, $rootScope, CoreHop, $cookieStore, $window) {
     console.log($rootScope.authData)
	if ($cookieStore.get('authCookie') == null) {
        console.log("cookie mein data store nhi ho rha")
        //window.location.href = "http://192.168.100.49/hop/";
    }
    else {
        $rootScope.authData = $cookieStore.get('authCookie');
        console.log($rootScope.authData)
    }
    $scope.Logout = function () {
        if ($cookieStore.get('authCookie') != null) {
            $cookieStore.remove('authCookie');
            window.location.href = "http://192.168.100.49/hop/";
            $rootScope.authData = {
                User_Id: 0,
                Name: "",
                Email: "",
                Type: "",
                isAuth: false,
                ProfilePicture: ""
            }
        }
    }
});
app.controller('adminCtrl',function($scope){
    console.log("dashboard");
});
/*app.controller('parentCtrl', function($scope){
    console.log("parent");
})*/
app.controller('driverCtrl',function($scope){
    console.log("driver");
});
app.controller('mapCtrl',function($scope){
    console.log("map");
})

