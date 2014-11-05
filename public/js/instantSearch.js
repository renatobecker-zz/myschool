// Definindo um novo módulo para nossa aplicação
var app = angular.module ("instantSearch", []);

// Crie um filtro de pesquisa instantânea

app.filter ('searchFor', function () {

	// Todos os filtros devem retornar uma função. O primeiro 
	// parâmetro é um dado que será filtrado, e o segundo é um 
	// argumento que vai ser passado com dois pontos
	// searchFor: searchString

	return function (arr, searchString) {

		if (!searchString) {
			return arr;
		}

		var result = [];

		searchString = searchString.toLowerCase();

		// Usando o útil método forEach para iterar através do array
		angular.forEach (arr, function (item) {

			if (item.titulo.toLowerCase().indexOf(searchString) !== -1) {
				result.push(item);
			}
		});

		return result;
	};

});
