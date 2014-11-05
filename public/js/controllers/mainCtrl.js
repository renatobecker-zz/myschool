/*
// public/js/controllers/mainCtrl.js
angular.module('mainCtrl', ['datarefresh'])

	// injecta o serviço de Aula em nosso controller
	.controller('mainController', function($scope, $http, Aula) {
		// object to hold all the data for the new comment form
		$scope.aulaData = {};

		// carrega a variavel que exibe loading icon
		$scope.loading = true;

		//$scope.myDiplayMonth = '';
		//obtém todas as aulas e disponibiliza no objeto $scope.aulas 
		// usa a função que nós criamos no nosso serviço		
		Aula.get()
			.success(function(data) {
				$scope.aulas = data;
				$scope.loading = false;
			});
	});
*/

angular.module('mainCtrl',['datarefresh', 'instantSearch'])
.controller('mainController', [function () {
}]);