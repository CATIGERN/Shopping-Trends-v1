app.config(function ($routeProvider){
	$routeProvider
	.when('/carts/:cartid', {
		controller: "FetchCartController"
	})
	.otherwise({
		templateUrl : '/test.blade.php'
	});
});

app.controller("FetchCartController", function($scope, $http, $routeParams, $location){
	console.log("I am here");
	console.log($location.absUrl());
	$scope.items = [$routeParams.cartid, '2'];
	

});