app.controller('parentCtrl', function ($scope, $rootScope, CoreHop, $window) {
	console.log('childlist')
	$scope.UserId = 27;
	console.log($scope.UserId)
	$scope.getChild = function (UserId) {
		console.log(UserId)
		var filter = {
            UserId: UserId,
            Email: "",
            Password: "",
            isSingle: true
        }
        $rootScope.queryEntity.method = "POST";
        $rootScope.queryEntity.action = "Student";
        $rootScope.queryEntity.controller = "Parentc";
		$rootScope.queryEntity.data = filter;
        CoreHop.dbQuery($rootScope.queryEntity).then(function (response) {
            console.log(response)
			$scope.Child = response.data;
        })
    }
	$scope.getChild();
    
});