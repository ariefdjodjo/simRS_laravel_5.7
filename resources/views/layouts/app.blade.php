<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ URL::asset('js/app.js') }}" defer></script>

   <!-- Font Awesome -->
   <link href="{{URL::asset('admin/bootstrap/css/font-awesome.min.css')}}"  rel="stylesheet"  type="text/css" >

  
   <link href="{{URL::asset('admin/dist/css/AdminLTE.min.css')}}" rel="stylesheet"  type="text/css" >


   <!-- selectize -->
   <script type="text/javascript" src="{{ URL::asset('selectize/jquery-1.10.2.min.js')}}"></script>
   <script type="text/javascript" src="{{ URL::asset('selectize/main.js')}}"></script>
   <script type="text/javascript" src="{{ URL::asset('selectize/selectize.js')}}"></script>
   <script type="text/javascript" src="{{ URL::asset('selectize/validjs.js')}}"></script>
   <link href="{{URL::asset('selectize/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SIMPEA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" href="#pencarian">{{ __('Pencarian') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


     <div class="modal fade" id="pencarian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pencarian</h4>
                </div>
                
                <div class="modal-body">
                    <div class="box-body">
                        <form class="form-horizontal" method="POST" action="{{ url('pencarian/proses/') }}">
                            @csrf
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                                <div class="col-sm-5">
                                    <select name="tahun" id="tahun">
                                        <option value="">-- Pilih Tahun --</option>
                                        @for($i=2019; $i<2025; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <script>
                                $('#tahun').selectize({
                                create: false,
                                sortField: 'text'
                                });                           
                            </script>
                            <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">No. Usulan</label>
                
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nomor" id="nomor" required>
                            </div>
                            </div>
                            <hr>
                            <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                            </div>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
              <!-- /.modal-content -->
        </div>
            <!-- /.modal-dialog -->
    </div>
</body>
</html>
