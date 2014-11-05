@extends('admin.layouts.padrao')

@section('head')
    @parent
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('DataTables-1.10.2/media/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@stop

@section('body')
    @parent
    <!-- DataTables -->
    <script src="{{ asset('DataTables-1.10.2/media/js/jquery.dataTables.js') }}"></script>
@stop

@section('content')
    	<div class="span3 well">
	        <center>
    	    	<a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="{{$professor->usuario->profile_photo(150,150)}}" name="aboutme" width="150" height="150" class="img-circle"></a>
        		<h3>{{ $professor->nome }}</h3>
	    	    <em>Click na imagem para mais informações</em>
			</center>
    	</div>
	    <!-- Modal -->
    	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-dialog">
    	        <div class="modal-content">
        	        <div class="modal-header">
            	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	                    <h4 class="modal-title" id="myModalLabel">Mais sobre {{ $professor->nome }} </h4>
    	                </div>
        	        <div class="modal-body">
            	        <center>
                	    <img src="{{$professor->usuario->profile_photo(150,150)}}" name="aboutme" width="150" height="150" border="0" class="img-circle"></a>
                    	<h3 class="media-heading">{{ $professor->nome }} <small>{{ $professor->titulo_academico }}</small> </h3>
	                    <!--
    	                <span><strong>Skills: </strong></span>
        	                <span class="label label-warning">HTML5/CSS</span>
            	            <span class="label label-info">Adobe CS 5.5</span>
                	        <span class="label label-info">Microsoft Office</span>
                    	    <span class="label label-success">Windows XP, Vista, 7</span>
	                    -->    
    	                </center>
        	            <hr>
            	        <center>
	                    <p class="text-left"><strong>Biografia: </strong><br>
    	                    {{ $professor->biografia }} </p>
        	            <br>
            	        </center>
                	</div>
	                <div class="modal-footer">
    	                <center>
    	    	            <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
            	        </center>
	                </div>
        	    </div>
        	</div>
    	</div>

	    <div class="bs-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
      			<li class="active"><a href="#disciplinas" role="tab" data-toggle="tab">Disciplinas</a></li>
    		</ul>
    		
    		<div id="myTabContent" class="tab-content">
      			<div class="tab-pane fade active in" id="disciplinas">
			    	<div class="span3">
        				<center>
					    	<table id="disciplinas-table" class="table table-hover table-striped">
        						<thead>
            						<tr>
				                		<th class="col-md-4">Nome</th>
						                <th class="col-md-2">Dia da Semana</th>                
    			        			    <th class="col-md-2">Criado em</th>
			        			        <th class="col-md-2">Opções</th>
            						</tr>
				        		</thead>
    	    					<tbody>
			        			</tbody>
    						</table>
						</center>
    				</div>
	      		</div>
    	  		<div class="tab-pane fade" id="calendario">
      			</div>
    		</div>
  		</div>
@stop	

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">

        var dia_semana_extenso = function(int_day){
            var semana = [];
            semana[0] = 'Domingo';
            semana[1] = 'Segunda-Feira';
            semana[2] = 'Terça-Feira'; 
            semana[3] = 'Quarta-Feira';
            semana[4] = 'Quinta-Feira';
            semana[5] = 'Sexta-Feira';
            semana[6] = 'Sábado';  

            return (int_day <= 6) ? semana[int_day] : 'Não informado';

        };

        var oTable;
        $(document).ready(function() {
            oTable = $('#disciplinas-table').dataTable( {
                "sDom": "<'row'<'col-md-6'><'col-md-6'>r>t<'row'<'col-md-6'><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "language": {
                    "sLengthMenu": "_MENU_ registros por página",
                    "zeroRecords": "Não encontrado - desculpe",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "search": "Localizar",
                    "paginate": {
                            "first": "Primeira",    
                            "previous": "Anterior",
                            "next": "Próxima",
                            "last": "Última"
                    }
                },        
                "bServerSide": true,
                "pagingType": "full_numbers",
                "sAjaxSource": "{{ URL::to('disciplinas/data/' . $professor->id) }}",
                "columnDefs": [ {
                    "targets": 1,
                    "mRender": function(data, type, row) {
                        return dia_semana_extenso(data);
                    }
                } ]
            });
        }); 
    </script>
@stop