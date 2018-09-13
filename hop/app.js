var app = angular.module("hop",['ui-notification','ngMessages','ui.router','ngCookies','ui.bootstrap']);
app.run(function($rootScope,$location){
	$rootScope.queryEntity = {
		method : "",
		controller : "",
		action : "",
		data : ""
	}
	$rootScope.authData ={
		User_Id: 0,
		Name:"",
		Email:"",
		Type:"",
		ProfilePicture:"",
		isAuth:false
	}
	$rootScope.HopapiBaseUrl = "http://192.168.100.49/hopapi/";
})
app.directive('passwordValid',function(){
	return {
		require: "ngModel",
		link: function(scope, element, attributes, ngModel) {
			ngModel.$validators.passwordlowercase = function(value){
				var passStrongRegex = new RegExp("^(?=.*[a-z])");
				if(passStrongRegex.test(value)){
					return true;
				}
				else{
					return false;
				}
			}
			ngModel.$validators.passworduppercase = function(value){
				var passStrongRegex = new RegExp("^(?=.*[A-Z])");
				if(passStrongRegex.test(value)){
					return true;
				}
				else{
					return false;
				}
			}
			ngModel.$validators.passwordspecialchar = function(value){
				var passStrongRegex = new RegExp("^(?=.*[!@#\$%\^&\*])");
				if(passStrongRegex.test(value)){
					return true;
				}
				else{
					return false;
				}
			}
			ngModel.$validators.passwordnumber = function(value){
				var passStrongRegex = new RegExp("^(?=.*[0-9])");
				if(passStrongRegex.test(value)){
					return true;
				}
				else{
					return false;
				}
			}
		}
	};
})
app.directive('passwordConfirm',function(){
	return {
		require: "ngModel",
		link: function(scope, element, attributes, ngModel) {
			ngModel.$validators.passwordmatch= function(value) {
				if(value != null){
					if(value == attributes.passVal){
						return true;
					}
					else{
						return false;
					}
				}
			};
		}
	};
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
app.controller('ParentRegCtrl', function ($scope,$http,CoreHop,Notification,$window,$timeout) {
	$scope.registerParent = function(){
		var fd = new FormData();
		fd.append('parentImage',$scope.userProfile);
		fd.append('postData', JSON.stringify($scope.parent));
		CoreHop.registerParent({
			controller: "Parentc",
			action : "parentRegistration",
			data : fd
		}).then(function(response){
			if(response.data.status == 1){
				Notification.success({message: response.data.Result, delay: 5000});
				$timeout(function() {
				window.location.href = "http://192.168.100.49/hop";
				}, 2000);
			}
			else{
				Notification.error({message: response.data.Result, delay: 5000});
			}
		})
	}
});
app.controller('DriverRegCtrl', function($scope,$http,CoreHop,Notification,$window,$timeout){
	console.log("hi driver")
	$scope.registerDriver = function(){
		console.log($scope.driver)
		var fd= new FormData();
		fd.append('driverImage',$scope.userProfile);
		fd.append('postData', JSON.stringify($scope.driver));
		CoreHop.registerDriver({
			controller :"Driver",
			action:"driverRegistration",
			data :fd
		}).then(function(response){
			console.log(response)
			if (response.data.status == 1) {
				Notification.success({message:response.data.Result, delay: 5000});
				$timeout(function() {
				window.location.href = "http://192.168.100.49/hop";
				}, 2000);
				
			}
			else{
				Notification.error({message:response.data.Result, delay:5000});
				$myModal3.dismiss('cancel');
			}
		})
	}
});
app.controller('loginCtrl', function($scope,$http,CoreHop,Notification,$rootScope,$window,$cookieStore){
	var filter = {
		User_Id:0,
		Email:"",
		Password:"",
		isSingle:true
	}
	$scope.login = function(){
		filter.Email = $scope.credentials.userEmail;
		filter.Password = $scope.credentials.userPassword;
		$rootScope.queryEntity.method = "Post";
		$rootScope.queryEntity.controller = "User";
		$rootScope.queryEntity.action = "loginUser";
		$rootScope.queryEntity.data = filter;
		CoreHop.dbQuery($rootScope.queryEntity).then(function(response){
			if(response.data.status == 1){
                $rootScope.authData.User_Id = response.data.Result.User_Id;
                $rootScope.authData.Name = response.data.Result.First_Name +" "+ response.data.Result.Last_Name;
                $rootScope.authData.Email = response.data.Result.Email;
                $rootScope.authData.Type = response.data.Result.Type;
                $rootScope.authData.isAuth = true;
                if ($rootScope.authData.Type == "Parent") {
                    if (response.data.Result.ProfilePicture != "") {
                        $rootScope.authData.ProfilePicture = $rootScope.HopapiBaseUrl + 'assets/images/parents/' + response.data.Result.ProfilePicture;
                    }
                    else {
                        $rootScope.authData.ProfilePicture = $rootScope.HopapiBaseUrl + 'assets/images/dummyProfile.png';
                    }
                    $cookieStore.put('authCookie', $rootScope.authData,window.location.href = "http://192.168.100.49/hopapp/");
                }
                else if ($rootScope.authData.Type == "Driver") {
                    if (response.data.Result.ProfilePicture != "") {
                        $rootScope.authData.ProfilePicture = $rootScope.HopapiBaseUrl + 'assets/images/drivers/' + response.data.Result.ProfilePicture;
                    }
                    else {
                        $rootScope.authData.ProfilePicture = $rootScope.HopapiBaseUrl + 'assets/images/dummyProfile.png';
                    }
                    $cookieStore.put('authCookie', $rootScope.authData);
                }
                else if ($rootScope.authData.Type == Admin) {
                    if (response.data.Result.ProfilePicture != "") {
                        $rootScope.authData.ProfilePicture = $rootScope.HopapiBaseUrl + 'assets/images/admin/' + response.data.Result.ProfilePicture;
                    }
                    else {
                        $rootScope.authData.ProfilePicture = $rootScope.HopapiBaseUrl + 'assets/images/dummyProfile.png';
                    }
                    $cookieStore.put('authCookie', $rootScope.authData);
                }
               window.location.href = "http://192.168.100.49/hopapp/";
			}
			else{
				console.log(response.data.Result)
				Notification.error({message: response.data.Result, delay: 5000});
			}
		})
	}
})