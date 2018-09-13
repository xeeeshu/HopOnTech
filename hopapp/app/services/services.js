
/*Localhost Version*/
var baseUrl = "http://192.168.100.49/hopapi/";
var header_Url_encoded = {
	headers : {
		'Content-Type': 'application/json;charset=utf-8;'
	}
}
app.service('CoreHop',function($http){
	return{
		dbQuery : function(entity){
			var req = {
				method: entity.method,
				url: baseUrl+entity.controller+'/'+entity.action+'/',
				headers: header_Url_encoded,
				data: entity.data
			}
			return $http(req).then(function(response){
				return response;
			});
		},
		dbQueryFdData : function(entity){
			return $http.post(baseUrl+entity.controller+'/'+entity.action+'/',entity.data, {
				transformRequest: angular.identity,
				headers: {
					'Content-Type': undefined
				}
			}).then(function(response){
				return response;
			})
		},
		registerParent: function(entity){
			return $http.post(baseUrl+entity.controller+'/'+entity.action+'/',entity.data, {
				transformRequest: angular.identity,
				headers: {
					'Content-Type': undefined
				}
			}).then(function(response){
				return response;
			})
		},
		registerDriver : function(entity){
			return $http.post(baseUrl+entity.controller+'/'+entity.action+'/',entity.data, {
				transformRequest: angular.identity,
				headers: {
					'Content-Type': undefined
				}
			}).then(function(response){
				return response;
			})
		}
	}
})