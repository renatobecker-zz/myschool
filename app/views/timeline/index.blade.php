<!-- http://www.bootdey.com/snippets/view/Timeline-with-200 -->
@extends('admin.layouts.padrao')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instantSearch.css') }}">

@stop

@section('content')
<!-- Declaração da app angular e controller -->
<div class="container" ng-app="aulaApp" ng-controller="mainController">

	<div class="bar-search">
			<!-- Crie uma ligação entre o modelo searchString e o campo de texto -->
			<input type="text" ng-model="searchString" placeholder="Digite seu termo de pesquisa">
	</div>
	<section id="news" class="white-bg padding-top-bottom">
    	<div class="container">
			<div class="timeline">

				<p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
			
				<angular-refresh url="/api/aulas"
      				ng-model="aulas" interval="5000" method="json"></angular-refresh>

				<div class="row">
      				<div ng-repeat="aula in aulas | searchFor:searchString">	
					<!--<div class="aula" ng-hide="loading" ng-repeat="aula in aulas">-->

						<div ng-class-odd="'col-sm-6 news-item'" ng-class-even="'col-sm-6 news-item right'" >
							<div class="news-content">
								<div class="date">
									<p><% aula.data | date:'dd'%></p>
									<small><% aula.data | date:'MMM'%></small>
								</div>

								<span><%aula.disciplina.nome%></span>
								<h2 class="news-title"><% aula.titulo %></h2>							
								<div class="news-media">
									<a class="colorbox cboxElement" ng-href="/professores/<% aula.professor.slug%>">
										<img class="img-responsive" ng-src="<% aula.professor.usuario.photo %>" alt="">
                    	            </a>
								</div>
								<p><%aula.descricao%></p>								
								<a class="read-more" ng-href="/disciplinas/aulas/<%aula.slug%>">Leia mais</a>
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>
	</section>
</div>	

@section('scripts')
    @parent

	<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- load angular -->
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

	<script src="js/angular/angular.min.js"></script>
	<script src="js/angular/i18n/angular-locale_pt-br.js"></script>

	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
		<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
		<script src="js/services/aulaService.js"></script> <!-- load our service -->
		<script src="js/angular-refresh.js"></script> 
		<script src="js/instantSearch.js"></script> 		
		<script src="js/app.js"></script> <!-- load our application -->    
@stop    


