<!--<nav class="navbar navbar-default" role="navigation"> -->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">        
          <span class="sr-only">Navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">MySchool</a>
      </div>
 
      <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
              
              <li{{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{ url('') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>

              @if(Auth::check())
                <li{{ (Request::is('timeline*') ? ' class="active"' : '') }}><a href="{{{ URL::to('timeline') }}}"><span class="glyphicon glyphicon-dashboard"></span> Timeline</a></li>                
              @endif

              <li{{ (Request::is('professores*') ? ' class="active"' : '') }}><a href="{{{ URL::to('professores') }}}"><span class="glyphicon glyphicon-th"></span> Professores</a></li>                
              <li{{ (Request::is('disciplinas*') ? ' class="active"' : '') }}><a href="{{{ URL::to('disciplinas') }}}"><span class="glyphicon glyphicon-list-alt"></span> Disciplinas</a></li>

              <!-- @if(Auth::check())
                <li{{ (Request::is('disciplinas*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/disciplinas') }}}"><span class="glyphicon glyphicon-list-alt"></span> Disciplinas</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="{{ url('usuarios') }}">Lista</a></li>
                      <li><a href="{{ url('usuarios/inserir') }}">Inserir</a></li>
                  </ul>
                </li>

              @else -->

              <!-- @endif -->
          </ul>
            <ul class="nav navbar-nav pull-right">
              @if(Auth::check())                                  
                <?php $user = Auth::user(); ?>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <!--<span class="glyphicon glyphicon-user"></span>-->
                    <img class="img-circle img-responsive img-center" src="{{$user->profile_photo(25,25)}}" width="25" height="25" alt="">                
                  </a>

                  <ul class="dropdown-menu">
                    <li><a href="{{{ URL::to('user/settings') }}}"><span class="glyphicon glyphicon-wrench"></span> Configurações</a></li>
                    <li class="divider"></li>
                    <li><a href="{{{ URL::to('/sair') }}}"><span class="glyphicon glyphicon-share"></span> Sair</a></li>
                  </ul>
                </li>
            @else
                <li {{ (Request::is('registrar') ? ' class="active"' : '') }}><a href="{{{ URL::to('/registrar') }}}">Registrar</a></li>            
                <li {{ (Request::is('entrar') ? ' class="active"' : '') }}><a href="{{{ URL::to('/entrar') }}}">Login</a></li>
            @endif  
            </ul>            
  
      </div>
    </div>
</nav>
