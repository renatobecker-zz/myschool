@extends('admin.layouts.padrao')
	
{{-- Content --}}
@section('content')

	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			
			<h3>Registrar Usuário</h3>

			<hr>

			@if($errors->any())
				<div class="alert alert-danger">
  	    			<ul>
    	    			{{ implode('', $errors->all('<li>:message</li>'))}}
	    			</ul>	
				</div>    			
			@endif
		
			{{ Form::open(array('url' => 'registrar', 'class' => 'form-horizontal', 'role' => 'form')) }}

			<div class="form-group">
    			<label for="nome" class="col-lg-2 control-label">Nome</label>
	    		<div class="col-lg-10">
		    	    {{ Form::text('nome', Input::old("nome") , array('class' => 'form-control', 'placeholder' => 'Nome')) }}
			    </div>
			</div>

			<div class="form-group">
    			<label for="email" class="col-lg-2 control-label">E-mail</label>
			    <div class="col-lg-10">
    			    {{ Form::email('email', Input::old("email"), array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
		    	</div>
			</div>

			<div class="form-group">
    			<label for="senha" class="col-lg-2 control-label">Senha</label>
			    <div class="col-lg-10">
    			    {{ Form::password('senha', array('class' => 'form-control', 'placeholder' => 'Senha')) }}
		    	</div>
			</div>

			<div class="form-group">
    			<div class="col-lg-offset-2 col-lg-10">
	    	    	{{ Form::submit('Registrar', array('class' => 'btn btn-success')) }}
		    	    <a href="{{ url('entrar') }}" title="Cancelar" class="btn btn-default">Cancelar</a>
	    		</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>		

@stop
