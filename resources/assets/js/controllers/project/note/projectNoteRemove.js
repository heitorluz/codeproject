angular.module('app.controllers')
    .controller('ProjectNoteRemoveController',['$scope', '$location', '$routeParams', 'ProjectNote', function($scope, $location, $routeParams, ProjectNote){
        $scope.projectNote = new ProjectNote.get({id: $routeParams.id, idNote: $routeParams.idNote});

        $scope.remove = function(){
            $scope.projectNote.$delete({idNote: $scope.projectNote.id}).then(function(){
                $location.path('/project/' + $routeParams.id + '/notes');
            });
        }
    }]);