<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire Djibouti Telecom</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">


    @livewireStyles
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script> 
 

    <style>
        /* Set a fixed height for the container to enable vertical centering */
        .center-container {
            height: 100vh; /* 100% of the viewport height */
        }
    </style>

</head>

<body class=""> 

    {{--  <div class="container my-5">
        @livewire('upload-photo')
    </div> --}}

    
    <div class="container center-container w-md-50">
        @livewire('send-sms')
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


    @livewireScripts

</body>

</html>
