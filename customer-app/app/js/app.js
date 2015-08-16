'use strict';

/* App Module */
var hurryApp = angular.module('hurryApp', [
  'ngAnimate',
  'ngRoute',
  'ngCookies',
  'registationControllers'
]);

hurryApp.config(['$routeProvider',
function($routeProvider) {
  $routeProvider.
    when('/registation/step-1', {
      templateUrl: 'templates/registration-step-1.html'
    }).
    when('/registation/step-2', {
      templateUrl: 'templates/registration-step-2.html'
    }).
    when('/registation/step-3', {
      templateUrl: 'templates/registration-step-3.html',
      controller: 'registerStep3Controller'
    }).
    when('/dashboard', {
      templateUrl: 'templates/dashboard.html',
      controller: 'dashboardController'
    }).
    when('/recent', {
      templateUrl: 'templates/recent.html',
      controller: 'recentController'
    }).
    when('/order/:storeId', {
      templateUrl: 'templates/order.html',
      controller: 'orderController'
    }).
    otherwise({
      redirectTo: '/dashboard'
    });
}]);

hurryApp.directive('validNumber', function() {
  return {
    require: '?ngModel',
    link: function(scope, element, attrs, ngModelCtrl) {
      if(!ngModelCtrl) {
        return; 
      }

      ngModelCtrl.$parsers.push(function(val) {
        if (angular.isUndefined(val)) {
            var val = '';
        }
        var clean = val.replace( /[^0-9]+/g, '');
        if (val !== clean) {
          ngModelCtrl.$setViewValue(clean);
          ngModelCtrl.$render();
        }
        return clean;
      });

      element.bind('keypress', function(event) {
        if(event.keyCode === 32) {
          event.preventDefault();
        }
      });
    }
  };
});

hurryApp.directive('owlDirective', function() {
  return function(scope, element, attrs) {
    if (scope.$last){

      $("#owl-demo").owlCarousel({
          navigation : true, // Show next and prev buttons
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem:true
      });

    }
  };
});


$(function() {
  $(window).resize(function() {
    $('#main-holder').css({'width':$(window).width(), 'height':$(window).height()});
  }).resize();
});