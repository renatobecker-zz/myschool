@extends('admin.layouts.padrao')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/list-group.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('css/round-about.css') }}"> -->   
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/disciplina-list.css') }}">
    <!-- usado para liberar acesso ao controller por Ajax -->
    <meta name="_token" content="{{ csrf_token() }}"/>
@stop

@section('content')

<div class="container">

    <div class="row">
         <div class="col-md-8">
            <h1> Disciplinas
                <!--
                @if (count($disciplinas) > 0)
                    <small>({{ count($disciplinas) }}) </small>
                @else
                    <small>Nenhum disciplina disponível</small>
                @endif      
                -->
            </h1>  
        </div>

        <div class="col-md-4 search">
            {{ Form::model(null, array('id' =>"custom-search-form", 'class' => "form-search form-horizontal pull-right",   'route' => array('disciplinas.search'))) }}            
                <div class="input-append span12 center-block">
                    {{ Form::text('query', null, array('class' => "search-query mac-style",  'placeholder' => 'Procurar...' )) }}
                    <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            {{ Form::close() }}
        </div>

    </div>    

    <div class="row">
        <div class="list-group">

            <?php  $logged = Auth::check(); $logged_tag = ($logged) ? 't' : 'f'; ?>

            @foreach ($disciplinas as $disciplina)  

                <span href="#" class="list-group-item">
                    <div class="media col-md-3 text-center">
                        <figure class="pull-center center-block">
                            <img class="img-circle img-center img-principal" height="100" width="100" src="{{$disciplina->professor->usuario->profile_photo(100,100)}}" alt="placehold.it/150x150" >
                            <figcaption class="text-center"><i>{{$disciplina->professor->nome}}</i></figcaption>
                        </figure>  
                    </div>
                    <div class="col-md-6 text-left">
                        <a href="{{{ URL::to('/disciplinas/' . $disciplina->slug) }}}"><h4 class="list-group-item-heading">{{ $disciplina->nome}}</a><small> ({{ $disciplina->str_day()}}) </small></h4>                            
                        <p class="list-group-item-text"> {{ str_limit($disciplina->descricao, 200) }} </p>
                    </div>
                    <div class="col-md-3 text-right">                       
                            <span class="button-checkbox" data-disciplina_id={{ $disciplina->id }} data-logged= <?php echo ($logged_tag) ?>>
                                <button type="button" class="btn" data-color="primary">Inscrito</button>

                                @if( (Auth::check()) && ($disciplina->usuario_inscrito(Auth::user())) )
                                    <input type="checkbox" class="hidden" checked />
                                @else
                                    <input type="checkbox" class="hidden" />                                
                                @endif    
                            </span>                        
                        <p/>
                        <p/>

                        <p>Inscrições <span id="span_count_{{ $disciplina->id }}" class="badge"> {{$disciplina->usuarios->count()}} </span></p>
                        <!--
                        <div class="stars">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </div>
                        <p> Average 4.5 <small> / </small> 5 </p>
                    -->
                    </div>
                </span>        
            @endforeach    
        </div>
        {{ $disciplinas->links() }}
    </div>
</div>

@section('scripts')
    @parent
    <script src="{{ asset('js/checkbox-button.js') }}"></script>
    <script src="{{ asset('js/check-button-inscricao-disciplina.js') }}"></script>
@stop    
