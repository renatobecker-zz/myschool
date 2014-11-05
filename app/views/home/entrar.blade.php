@extends('admin.layouts.padrao')
 
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/entrar.css') }}">
@stop

@section('content')

<div class="container">
    
    <div class="omb_login">
    	<h3 class="omb_authTitle">Login ou <a href="/registrar">Registrar</a></h3>
		<div class="row omb_row-sm-offset-3 omb_socialButtons">
    	    <div class="col-xs-4 col-sm-2">
    	    	<a href="{{ url('/facebook') }}" class="btn btn-lg btn-block omb_btn-facebook">
			        <i class="fa fa-facebook visible-xs"></i>
			        <span class="hidden-xs">Facebook</span>
		        </a>
	        </div>
        	<div class="col-xs-4 col-sm-2">
    	    	<a href="{{ url('/linkedin') }}" class="btn btn-lg btn-block omb_btn-linkedin">
			        <i class="fa fa-linkedin visible-xs"></i>
			        <span class="hidden-xs">Linkedin</span>
		        </a>
	        </div>	
        	<div class="col-xs-4 col-sm-2">
    	    	<a href="{{ url('/google') }}" class="btn btn-lg btn-block omb_btn-google">
			        <i class="fa fa-google-plus visible-xs"></i>
			        <span class="hidden-xs">Google+</span>
		        </a>
	        </div>	
		</div>

		<div class="row omb_row-sm-offset-3 omb_loginOr">
			<div class="col-xs-12 col-sm-6">
				<hr class="omb_hrOr">
				<span class="omb_spanOr">ou</span>
			</div>
		</div>

		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6 well" id="input_container">	
				{{ Form::open(array(
            		'url' => 'entrar',
            		'class'  => 'omb_loginForm'
        		)) }}

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						{{ Form::email('email', '', array('class' => 'form-control', 'autofocus', 'placeholder' => 'E-mail')) }}
					</div>
					<span class="help-block"></span>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                		{{ Form::password('senha', array('class' => 'form-control', 'placeholder' => 'Senha')) }}						
					</div>

       			    @if (Session::has('flash_error'))
						<span class="help-block"></span>       			    
		                <div class="alert alert-danger">E-mail ou senha inválidos.</div>
        		    @endif

					<span class="help-block"></span>
            		{{ Form::submit('Entrar', array('class' => 'btn btn-lg btn-primary btn-block')) }}

				{{ Form::close() }}
			</div>
    	</div>
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-3">

	            <label class="checkbox">
    	            {{ Form::checkbox('remember', 'remember', true) }} Lembre-se de mim
        	    </label>
			</div>
			<!--
			<div class="col-xs-12 col-sm-3">
				<p class="omb_forgotPwd">
					<a href="#">Recuperar Senha?</a>
				</p>
			</div>
			-->
		</div>	    	
	</div>
</div>