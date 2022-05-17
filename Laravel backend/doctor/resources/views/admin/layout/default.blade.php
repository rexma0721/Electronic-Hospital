<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <link rel="icon" href="{{ url('images/favicon/favicon-32x32.png') }}" sizes="32x32">
        <link rel="apple-touch-icon-precomposed" href="{{ url('images/favicon/favicon-32x32.png') }}">
        <!-- META DATA-->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="title" content="Forge Admin is modern, responsive Material Admin Template.">
        <meta name="description" content="Forge Admin Material Admin Template is modern, responsive and based on Material Design by Google.It's Material Design Admin Template powered by MaterialCSS.">
        <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, materialcss, admin pages, material CMS, Forge Admin template, resoponsive material admin">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="{{ url('images/favicon/favicon-32x32.png') }}">
        <meta name="theme-color" content="#2a56c6">



        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Forge Admin') }}</title>
        <!-- FONTS-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/dynamic.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/scrollbar/perfect-scrollbar.min.css') }}">
        <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
        <!-- add by me -->
        <link rel="stylesheet" href="{{ asset('plugins/datatable/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatable/select.dataTables.min.css') }}">   
        <!-- add by me end --> 
        @yield('css')
    </head>
    <body>
        @yield('appPre')
        <div id="app">
            <div id="preloader">
              <div class="preloader-center">
                <div class="dots-loader dot-circle"></div>
              </div>
            </div>
            <header>
                @include('admin.includes.header')
                @include('admin.includes.verticalnav')
                @include('admin.includes.horizontal')
                @include('admin.includes.notification')
            </header>
            <main>
                <div class="main-header">
                    <div class="sec-page">
                        <div class="page-title">
                        <h2>{{$name}}</h2>
                        </div>
                    </div>
                    <div class="sec-breadcrumb">
                        <nav class="breadcrumbs-nav left">
                            <div class="nav-wrapper">
                                <div class="col s12" style="    text-align: left;">
                                    <a class="breadcrumb" href="{{ url('admin/') }}">Home</a>
                                    <a class="breadcrumb" href="#">{{$name}}</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                @yield('content')
                @include('admin.includes.footer')
            </main>
        </div>
        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
        <!-- add by me -->
        <script type="text/javascript" src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/datatable/dataTables.select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/select2/select2.js') }}"></script>
        <!-- add by me end -->

        {{-- APP AND INIT --}}
        <script src="{{ asset('js/forgeapp.js') }}"></script>
        <script src="{{ asset('js/init.js') }}"></script>

        @yield('js')
        
    </body>
</html>
