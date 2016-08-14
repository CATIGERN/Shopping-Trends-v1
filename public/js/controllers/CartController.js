app.controller("CartController", function($scope, $http){
	$http.get("/carts")
	.then(function(response) {
        //First function handles success
        $scope.carts = response.data;
    }, function(response) {
        //Second function handles error
        $scope.carts = [response.statusText, ''];
    });

    $http.get("/users")
	.then(function(response) {
        $scope.users = response.data;
    }, function(response) {
        $scope.users = [response.statusText, ''];
    });

        
});