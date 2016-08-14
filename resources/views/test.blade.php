<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src="js/angular.min.js"></script>
        <script src="js/app/shoppingtrends.js"></script>
        <script src="js/controllers/mycontroller.js"></script>

    </head>
    <body ng-app = "shoppingtrends">
        <div ng-controller = "mycontroller">
            <li ng-repeat = "cart in carts"> @{{ cart }} </li>
        </div>
    </body>
</html>
