
@include('delete_confirm')

@extends('admin.layouts.padrao')
 
{{-- Web site Title --}}
@section('titulo')
{{{ $titulo }}} :: @parent
@stop

@section('head')
    @parent
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('DataTables-1.10.2/media/css/jquery.dataTables.css') }}">
@stop

@section('body')
    @parent
    <!-- DataTables -->
    <script src="{{ asset('DataTables-1.10.2/media/js/jquery.dataTables.js') }}"></script>
@stop

@section('content')

    <div class="page-header">
        <h3>
            {{{ $titulo }}}

            <div class="pull-right">
                <a href="{{{ URL::to('/admin/disciplinas/inserir') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
            </div>
        </h3>
    </div>


    <table id="disciplinas-table" class="table table-hover table-striped">
        <thead>
            <tr>
                <th class="col-md-4">Título</th>
                <th class="col-md-2">Dia da Semana</th>                
                <th class="col-md-2">Criado em</th>
                <th class="col-md-2">Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

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
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
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
                    //"infoFiltered": "(filtered from _MAX_ total records)"                    
                //"bProcessing": true,
                "bServerSide": true,
                "pagingType": "full_numbers",
                "sAjaxSource": "{{ URL::to('admin/disciplinas/data') }}",
                "columnDefs": [ {
                    "targets": 1,
                    "mRender": function(data, type, row) {
                        return dia_semana_extenso(data);
                    }
                } ]
                /*
                "fnDrawCallback": function ( oSettings ) {
                    $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
                }*/
            });
        }); 
    </script>
@stop