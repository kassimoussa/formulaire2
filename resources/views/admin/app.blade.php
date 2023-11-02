@php
    use App\Models\User;
    $user = User::where('id', session('id'))->first(); 
    if (session('id') != $user->id) {
        session()->forget('id');
        session()->put('id', $user->id);
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}"> --}}

    <title> {{ $page }} </title>

    @livewireStyles 
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}"> --}}


    <!-- Scripts --> 
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script> 

 

    <style>
        body {
            background-color: #f1f2f5;
        }

        .nav_link:hover {
            color: blue !important;
            font-weight: bold;
            font-size: 18px;

        }

        .nav_link {
            color: white !important;
            font-size: 18px;
        }

        .activee {
            color: blue !important;
            font-weight: bold;
            font-size: 18px;
            background: #212529 !important;
        }

        .dropdown-item .activee {}

        .main-c {
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 6rem
        }

        .dropend:hover .dropdown-menu {
            display: block;
            margin-top: 0; // remove the gap so it doesn't close
        }

        .warning {
            color: #ffc107;
        }

        .info {
            color: #67ace0;
        }

        a {
            text-decoration: none
        }

        .dataTables_filter {
            margin-bottom: 10px;
            float: left;
        }
    </style>
</head>

<body>

    <!-- Page Heading -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" height="40px" width="70px"
                    alt=""></a> --}}
            <a class="navbar-brand @if ($pageSlug == 'accueil') {{ 'activee' }} @endif"
                href="{{ url('index') }}">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link nav_link  @if ($pageSlug == 'stats') {{ 'activee' }} @endif "
                            href="{{ url('stats') }}">Stats</a>
                    </li>

                   {{--  @if (session('level') == 1 || session('level') == 4)
                        <li class="nav-item">
                            <a class="nav-link nav_link  @if ($pageSlug == 'create') {{ 'activee' }} @endif "
                                href="{{ url('fiches/create') }}">Ajouter</a>
                        </li>
                    @endif --}}
                </ul>
                <div class="d-flex">
                    <div class="nav-item dropdown dropstart">

                        <h5 class="nav-link nav_link fw-bold   dropdown-toggle"
                            id="user" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->name }} </h5>

                        <ul class="dropdown-menu dropdown-menu-dark bg-dark " aria-labelledby="user"> 
                            <li><a class="dropdown-item" href="{{ url('logout') }}">Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Page Content -->
    <!--Container Main start-->

    <div class="main-c   ">
        @yield('content')
        <x-go-top />
    </div>


    @stack('modals')
    @stack('scripts')

    @yield('script')

    @livewireScripts



</body>

</html>
