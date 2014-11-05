<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo or 'MySchool' }}</title>
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
    body {
        padding: 60px 0;
    }
    </style>

    @yield('styles')

    @yield('head')
</head>
    <body>

        <div class="container">
            @include('templates.menu')
    
            @yield('content')

            <!--
            <footer class="clearfix">
                <div id="copyright text-right">© Copyright 2014 MySchool</div>
            </footer>
        -->
        </div>        
        
        <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('scripts')
        @yield('body')
    </body>
</html>