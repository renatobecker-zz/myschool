@extends('admin.layouts.padrao')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
@stop

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="hero-unit center">
          		<h1>Página não encontrada <small><font face="Tahoma" color="red">Erro 404</font></small></h1>
          		<br />
          		<p>A página solicitada não pode ser encontrada, entre em contato com o Adminstrador ou tente novamente.</p>
          		<a href="{{ url('') }}" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Ir para Home</a>
        	</div>
        	<br />
    	</div>
  	</div>
</div>
