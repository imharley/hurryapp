'use strict';

/* Controllers */

var registationControllers = angular.module('registationControllers', []);

/* Step 1 Registation */
registationControllers.controller('registerStep1Controller', ['$scope', '$http', '$location', '$cookieStore', function($scope, $http, $location, $cookieStore) {
	$scope.submit = function() {
		$http({
			method: 'POST',
			url: '/api/customer/login/',
			data: $.param({'phone':$scope.phone}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		}).success(function (data, status) {
			$scope.response = data;

			$cookieStore.put('phone', $scope.phone);

			if ( $scope.response.is_new == 1) {
				$location.path('/registation/step-2');
			} else {
				$location.path('/registation/step-3');
			}
		});
	};
}]);

/* Step 2 Registation */
registationControllers.controller('registerStep2Controller', ['$scope', '$http', '$location', '$cookieStore', function($scope, $http, $location, $cookieStore) {
	if ( $cookieStore.get('phone') == null) {
		$location.path('/registation/step-1');
	}

	$scope.submit = function() {
		if( $scope.name && $scope.email ) {
			$cookieStore.put('email', $scope.email);	
			$cookieStore.put('name', $scope.name);
			$location.path('/registation/step-3');
		}
	};
}]);


/* Step 3 Registation */
registationControllers.controller('registerStep3Controller', ['$scope', '$http', '$location', '$cookieStore', function($scope, $http, $location, $cookieStore) {
	if ( $cookieStore.get('phone') == null) {
		$location.path('/registation/step-1');
	}

	$scope.errormsg = '';
	$scope.errormsgshow = false;

	$scope.submit = function() {
		$http({
			method: 'POST',
			url: '/api/customer/login/',
			data: $.param({'phone':$cookieStore.get('phone'),'password':$scope.password, 'name':$cookieStore.get('name'),'email':$cookieStore.get('email')}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		}).success(function (data, status) {
			$scope.response = data;

			if ( $scope.response.success == 1) {
				$cookieStore.put('_token', $scope.response.token);
				$location.path('/dashboard');
			} else {
				$scope.errormsgshow = true;
				$scope.errormsg = 'Invalid Authentication Code';
				$location.path('/registation/step-3');
			}
		});
	};
}]);

/* Dashboard */
registationControllers.controller('dashboardController', ['$scope', '$http', '$location', '$cookieStore', function($scope, $http, $location, $cookieStore) {

	if ( $cookieStore.get('_token') == null) {
		$location.path('/registation/step-1');
	}

}]);