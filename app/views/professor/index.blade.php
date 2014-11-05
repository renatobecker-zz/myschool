@extends('admin.layouts.padrao')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/round-about.css') }}">
@stop

@section('content')

    <div class="container">

    <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Docentes
                    <small>Conheça nossos professores</small>
                </h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, explicabo dolores ipsam aliquam inventore corrupti eveniet quisquam quod totam laudantium repudiandae obcaecati ea consectetur debitis velit facere nisi expedita vel?</p>
            </div>
        </div>


        <!-- Team Members Row -->

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Equipe</h3>
            </div>

            @foreach ($professores as $professor)

                <div class="col-lg-4 col-sm-6 text-center">
                    <img class="img-circle img-responsive img-center img-principal" src="{{$professor->usuario->profile_photo(200,200)}}" alt="">
                    <h3><a href="{{{ URL::to('/professores/' . $professor->slug) }}}">{{ Str::title($professor->nome) }}</a></h3>
                        <small>{{ $professor->titulo_academico }}</small>
                    </h3>
                    <p>{{ $professor->biografia }}</p>
                </div>
            @endforeach 
        </div>
    </div>    
