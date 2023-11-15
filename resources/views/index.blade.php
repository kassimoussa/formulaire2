<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire Djibouti Telecom</title>


    @livewireStyles
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- Google fonts-->
    {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" /> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />


    <style>
        body {
            /*background-color: #dde3fb;*/
            background: url({{ asset('images/djibtelbg2.jpeg') }}) center center fixed #ffffff no-repeat;
            background-size: cover;
        }

        /* Square button */
        .square {
            border-radius: 0 !important;
        }

        .bg-cp {
            background-color: #282733 !important;
        }

        .modal-content {
            background-color: #f1f2f5 !important;
        }

        /* Style to make the image cover its parent */
        .cover-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .nav_link:hover {
            color: #f9be2a !important;
            font-weight: bold;
            font-size: 18px;

        }

        .nav_link {
            color: white !important;
            font-size: 18px;
        }

        .bg_l {
            background-color: #f1f1f1;
        }

        .activee {
            color: #f9be2a !important;
            font-weight: bold;
            /* font-size: 38px; */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
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

        /* Custom styles for a scrollable modal */
        .scrollable-modal {
            max-height: calc(100vh - 90px);
            /* Adjust as needed */
            overflow-y: auto;
        }

        /* Style to make the image cover its parent */
        .cover-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Reverse image horizontally */
        .reverse-image {
            transform: scaleX(-1);
        }


        /* Custom styles can be added here */
        @media (max-width: 576px) {
            .custom-font-sm {
                font-size: 20px;
            }
        }
        @media (min-width: 576px) {
            .custom-font-sm {
                font-size: 25px;
            }
        }

        @media (min-width: 768px) {
            .custom-font-md {
                font-size: 30px;
            }
        }

        @media (min-width: 992px) {
            .custom-font-lg {
                font-size: 40px;
            }
        }

        @media (min-width: 1200px) {
            .custom-font-xl {
                font-size: 40px;
            }
        }
    </style>

</head>

<body class="">
    <!-- Page Heading2 -->
    <div class="container-fluid my-4 ms-3 d-flex justify-content-between">
        <div class="float-start ">
            <a class=""><img src="{{ asset('images/djibtelogo.png') }}" height="80"></a>
        </div>
        <div class="mx-auto  order-0 ">
            <p class="text-center my-3 activee custom-font-sm custom-font-md custom-font-lg  ">Bienvenue sur le formulaire d'enregistrement en ligne </p>
        </div>
    </div>


    {{--  <div class="container my-5">
        @livewire('upload-photo')
    </div> --}}

    <div class="container-fluid my-5 ">

        <div class="container  d-flex justify-content-center">
            @if ($message = Session::get('success'))
                <div class="alert alert-dismissible fade show alert-success d-flex align-items-center w-50 "
                    role="alert">
                    <i class="fas fa-check-circle fa-2x text-success me-1"></i>
                    <div>
                        L'enregistrement de vos informations s'est déroulé avec succès !
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('fail'))
                <div class="alert alert-dismissible alert-danger fade show  d-flex align-items-center w-50"
                    role="alert">
                    <i class="fas fa-times-circle fa-2x text-danger me-1"></i>
                    <div>
                        L'enregistrement de vos informations a échoué. Veuillez réessayer.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        @livewire('enregistrement')

        {{-- @livewire('countdown2') --}}

    </div>


    @stack('modals')
    @stack('scripts')


    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>

    {{-- <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('startCountdown', function(countdownTime) {
                var countdownElement = document.getElementById('countdown');
                var interval = setInterval(function() {
                    countdownTime--;
                    countdownElement.innerText = countdownTime;
                    if (countdownTime <= 0) {
                        clearInterval(interval);
                    }
                }, 1000);
            });
        });
    </script> --}}


    @livewireScripts

</body>

</html>
