(function(){
  'use strict';
  var todopersonal={};
  var module = angular.module('app', ['onsen']);

  module.controller('AppController', function($scope, $data) {
    $scope.doSomething = function() {
      setTimeout(function() {
        alert(''+device.uuid);
      }, 100);
    };
  });

  module.controller('DetailController', function($scope, $data) 
  {
    $scope.item = $data.selectedItem;
  });

  module.controller('MasterController', function($scope, $data, $http) {
    $scope.items = todopersonal;  
    $http.get('http://www.empowerlabs.com/intellibanks/data/Sandbox/MarcosQuiterioRamos/Lectura.php').
  success(function(data, status, headers, config) {
  	data.reverse();
    $data.items=data;
    todopersonal=data;
    $scope.items = $data.items;  
    $scope.showDetail = function(item) {
      var selectedItem = item;
      $data.selectedItem = selectedItem;
      $scope.ons.navigator.pushPage('detail.html', {title : selectedItem.title});
    };
  }).
  error(function(data, status, headers, config) {
  	
  });
  });

  module.factory('$data', function() {
      var data = {};
      
      data.items = todopersonal;
      
      return data;
  });
})();
