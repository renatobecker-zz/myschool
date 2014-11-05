@extends('admin.layouts.padrao')

@section('head')
    @parent
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('DataTables-1.10.2/media/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/business-frontpage.css') }}">
    <!-- usado para liberar acesso ao controller por Ajax -->
    <meta name="_token" content="{{ csrf_token() }}"/>    
@stop

@section('body')
    @parent
    <!-- DataTables -->
    <script src="{{ asset('DataTables-1.10.2/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/disciplina.js') }}"></script>
    <script src="{{ asset('js/checkbox-button.js') }}"></script>
    <script src="{{ asset('js/check-button-inscricao-disciplina.js') }}"></script>
@stop

@section('content')
    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header id="head-master" class="business-header" data-background="{{$disciplina->background_photo()}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline">{{ $disciplina->nome }}</h1>
                </div>
            </div>
        </div>
    </header>


<!-- Page Content -->
    <div class="container">

        <hr>

        <div class="row">

            <div class="col-sm-3">
                    <div class="span3 well">
                        <center>
                            <img src="{{$disciplina->professor->usuario->profile_photo(100,100)}}" name="aboutme" width="140" height="140" class="img-circle"></a>
                            <h3> <a href="{{{ URL::to('/professores/' . $disciplina->professor->slug) }}}"> {{ $disciplina->professor->nome }}</a></h3>
                            <!--<abbr title="Email"></abbr> <a href="mailto:#"> {{$disciplina->professor->usuario->email}} </a>-->                        
                        </center>
                    </div>
            </div>  

            <div class="col-sm-9">
                <h2>Ementa</h2>
                <p>{{ $disciplina->descricao }}</p>
                <p>
                    <?php  $logged = Auth::check(); $logged_tag = ($logged) ? 't' : 'f'; ?>
                    <span class="button-checkbox" data-disciplina_id={{ $disciplina->id }} data-logged= <?php echo ($logged_tag) ?>>
                        <button type="button" class="btn" data-color="primary">Inscrito</button>

                         @if( (Auth::check()) && ($disciplina->usuario_inscrito(Auth::user())) )
                            <input type="checkbox" class="hidden" checked />
                        @else
                            <input type="checkbox" class="hidden" />                                
                        @endif    
                    </span>                        

                </p>
            </div>

        </div>    
        <!--
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/300x300" alt="">
                <h2>Marketing Box #1</h2>
                <p>These marketing boxes are a great place to put some information. These can contain summaries of what the company does, promotional information, or anything else that is relevant to the company. These will usually be below-the-fold.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/300x300" alt="">
                <h2>Marketing Box #2</h2>
                <p>The images are set to be circular and responsive. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/300x300" alt="">
                <h2>Marketing Box #3</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
            </div>
        </div>
        -->
        <!-- /.row -->
    </div>
    <!-- /.container -->
@stop	