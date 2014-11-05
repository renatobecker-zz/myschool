@extends('admin.layouts.padrao')
 
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker3.css') }}">
@stop

@section('body')
    @parent
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() { 
            $("#dia_semana").select2(); 
    
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
            });    

            $('.timepicker').timepicker({
                minuteStep: 10,
                //template: 'modal',
                //appendWidgetTo: 'body',
                showSeconds: false,
                showMeridian: false,
                defaultTime: false,
                language: 'pt-BR'
            });    
        });       
    </script>
@stop

@section('content')
 
<h1>Editar Disciplina</h1>
 
<hr>
 
{{ Form::open(array('url' => 'admin/disciplinas/editar', 'class' => 'form-horizontal', 'role' => 'form')) }}
 
<div class="form-group {{{ $errors->has('nome') ? 'error' : '' }}}">  
    <label for="nome" class="col-lg-2 control-label">Nome</label>
    <div class="col-lg-6">
        {{ Form::text('nome', $disciplina->nome, array('class' => 'form-control', 'placeholder' => 'Nome')) }}
        {{ $errors->first('nome', '<span class="help-block">:message</span>') }}
    </div>
</div>
 
<div class="form-group {{{ $errors->has('descricao') ? 'error' : '' }}}">  
    <label for="descricao" class="col-lg-2 control-label">Descrição</label>
    <div class="col-lg-6">
        {{ Form::textarea('descricao', $disciplina->descricao, array('class' => 'form-control', 'placeholder' => 'Descrição')) }}
        {{ $errors->first('descricao', '<span class="help-block">:message</span>') }}        
    </div>
</div>

<div class="form-group {{{ $errors->has('dia_semana') ? 'error' : '' }}}">  
    <label for="dia_semana" class="col-lg-2 control-label">Dia da Semana</label>
    <div class="col-lg-6">
        {{ Form::select('dia_semana', $days , $disciplina->dia_semana, array('id' => 'dia_semana')) }}
        {{ $errors->first('dia_semana', '<span class="help-block">:message</span>') }}       
    </div>
</div>

<div class="form-group {{{ $errors->has('inicio_semestre') ? 'error' : '' }}}">  
    <label for="inicio_semestre" class="col-lg-2 control-label">Início Semestre</label>
    <div class="col-lg-6">
        <div class="input-group bootstrap-timepicker">
            {{ Form::text('inicio_semestre', $disciplina->inicio_semestre, array('class'=> 'form-control datepicker input-small', 'data-format' => 'dd/MM/yyyy')) }}
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>    
        {{ $errors->first('inicio_semestre', '<span class="help-block">:message</span>') }}
    </div>
</div>

<div class="form-group {{{ $errors->has('fim_semestre') ? 'error' : '' }}}">  
    <label for="fim_semestre" class="col-lg-2 control-label">Término Semestre</label>
    <div class="col-lg-6">
        <div class="input-group bootstrap-timepicker">
            {{ Form::text('fim_semestre', $disciplina->fim_semestre, array('class'=> 'form-control datepicker input-small')) }}
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>    
        {{ $errors->first('fim_semestre', '<span class="help-block">:message</span>') }}
    </div>
</div>

<div class="form-group {{{ $errors->has('check_in_inicio') ? 'error' : '' }}}">  
    <label for="check_in_inicio" class="col-lg-2 control-label">Check-in</label>
    <div class="col-lg-6">
        <div class="input-group bootstrap-timepicker">
            {{ Form::text('check_in_inicio', $str_check_in_inicio, array('class'=> 'form-control timepicker input-small')) }}
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div>    
        {{ $errors->first('check_in_inicio', '<span class="help-block">:message</span>') }}
    </div>
</div>

<div class="form-group {{{ $errors->has('check_in_final') ? 'error' : '' }}}">  
    <label for="check_in_final" class="col-lg-2 control-label">Check-out</label>
    <div class="col-lg-6">
        <div class="input-group bootstrap-timepicker">
            {{ Form::text('check_in_final', $str_check_in_final, array('class'=> 'form-control timepicker input-small')) }}
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div>    
        {{ $errors->first('check_in_final', '<span class="help-block">:message</span>') }}
    </div>
</div>

 
{{ Form::hidden('id', $disciplina->id) }}
 
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
        <a href="{{ url('admin/disciplinas') }}" title="Cancelar" class="btn btn-default">Cancelar</a>
    </div>
</div>
 
{{ Form::close() }}
 
@stop