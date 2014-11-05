	// public/js/app.js
var AulaApp = angular.module('aulaApp', ['mainCtrl', 'aulaService'], function($interpolateProvider) {

 	$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
