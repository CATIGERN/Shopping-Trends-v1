app.controller("CartController", function($scope, $http){
    $scope.items = [''];
	$http.get("/items")
	.then(function(response) {
        //First function handles success
        $scope.items = response.data;
    }, function(response) {
        //Second function handles error
        $scope.items = [response.statusText, ''];
    });
        
});