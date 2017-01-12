angular.module('myApp',['ui.router','ngResource','myApp.controllers','myApp.services']);

angular.module('myApp.services',['ngResource']).factory('User', function($resource){
    return $resource('/rest/public/users/:id', {id:'@id'}, {
      'update': {
        method: 'PUT'
      }
    });
}).service('popupService',function($window){
    this.showPopup = function(message){
        return $window.confirm(message);
    }
});

angular.module('myApp.controllers',[]).controller('UserListController',function($scope,$state,popupService,$window,User){
    $scope.users = User.query();
    $scope.deleteUser = function(user){
        if(popupService.showPopup('Really delete this?')){
            user.$delete(function(){
              console.log('Deleted!');
            });
        }
        $state.go('users');
    }
}).controller('UserViewController',function($scope,$stateParams,User){
    $scope.user = User.get({id:$stateParams.id});
}).controller('UserCreateController',function($scope,$state,$stateParams,User){
    $scope.user = new User();
    $scope.addUser = function(){
        $scope.user.$save(function(){
            $state.go('users');
        });
    }
}).controller('UserEditController',function($scope,$state,$stateParams,User){
    $scope.updateUser = function(){
        $scope.user.$update(function(){
            console.log("Updated!!");
        });
        $state.go('users');
    };
    $scope.loadUser = function(){
        $scope.user = User.get({id:$stateParams.id});
    };
    $scope.loadUser();
});

angular.module('myApp').config(function($stateProvider, $httpProvider) {
    $stateProvider.state('users',{
        url:'/users',
        templateUrl:'/rest/public/partials/users.html',
        controller:'UserListController'
    }).state('viewUser',{
       url:'/users/:id/view',
       templateUrl:'/rest/public/partials/user-view.html',
       controller:'UserViewController'
    }).state('newUser',{
        url:'/users/new',
        templateUrl:'/rest/public/partials/user-add.html',
        controller:'UserCreateController'
    }).state('editUser',{
        url:'/users/:id/edit',
        templateUrl:'/rest/public/partials/user-edit.html',
        controller:'UserEditController'
    });
}).run(function($state){
   $state.go('users');
});
