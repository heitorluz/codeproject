angular.module('app.controllers')
    .controller('ClientController',['$scope', '$routeParams', 'Client', function($scope, $routeParams, Client){
        $scope.client = new Client.get({id: $routeParams.id});
    }]);