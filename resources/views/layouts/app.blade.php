<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />

        {{-- <link href="{{ asset('css/output.css') }}" rel="stylesheet"> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="../resources/css/plantilla.css">
        

        <!--instalacion bootstrap 5.3.2-->
        <link rel="stylesheet" href="../resources/bootstrap-5.3.2-install/css/bootstrap.min.css">
        <!--datatable 5.3.2-->
        <link rel="stylesheet" href="../resources/datatable-install/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/datatable-install/css/dataTables.bootstrap5.min.css">
        <!--datatable-->
        <link rel="stylesheet" href="../resources/datatable-install/responsive/datatables.min.css">
        <!--responsive-->
        <link rel="stylesheet"
            href="../resources/datatable-install/responsive/Responsive-2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="../resources/icons/node_modules/bootstrap-icons/font/bootstrap-icons.min.css"
            rel="stylesheet">
        <!--fontawesome-->
        <link rel="stylesheet" href="../resources/fontawesome/css/all.css">
        <link rel="shortcut icon" href="../resources/imagen/favicon.ico">
        <!--Botones-->
        <link rel="stylesheet" href="../resources/datatable-install/buttons.dataTables.min.css">
        <link rel="stylesheet" href="../resources/css/styles.css">
        <link rel="stylesheet" href="../resources/bootstrap-5.3.2-install/js/bootstrap.bundle.js">

        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        {{-- <x-banner /> --}}
        <x-sidebard />
            
        

        {{-- @yield('content') --}}

        @stack('modals')

        @livewireScripts
        <script src="../resources/datatable-install/js/jquery-3.7.0.js"></script>
        <script src="../resources/bootstrap-5.3.2-install/js/bootstrap.bundle.min.js"></script>
        <script src="../resources/datatable-install/js/jquery.dataTables.min.js"></script>
        <script src="../resources/datatable-install/js/dataTables.bootstrap5.min.js"></script>

        <!--datatable-->
        <script src="../resources/datatable-install/responsive/datatables.min.js"></script>
        
        <!--responsive-->
        <script src="../resources/datatable-install/responsive/datatables.min.js"></script>
        <script src="../resources/datatable-install/responsive/Responsive-2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="../resources/datatable-install/responsive/Responsive-2.5.0/js/responsive.bootstrap5.min.js"></script>


        <!--sweetalert 2-->
        <script src="../resources/sweetalert2/sweetalert2@11.js"></script>

        <script src="../resources/js/home/actualizarDatosPersonales.js"></script>

        <!--Botones-->
        <script src="../resources/datatable-install/dataTables.buttons.min.js"></script>
        <script src="../resources/datatable-install/jszip.min.js"></script>
        <script src="../resources/datatable-install/pdfmake.min.js"></script>
        <script src="../resources/datatable-install/vfs_fonts.js"></script>
        <script src="../resources/datatable-install/buttons.html5.min.js"></script>
        <script src="../resources/datatable-install/buttons.print.min.js"></script>

        <script src="../resources/js/Validacion/ValidarCampos.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

        <script src="../resources/jquery/jquery-3.6.0.min.js"></script>
        <script src="../resources/bootstrap/popper.min.js"></script>
        <script src="../resources/bootstrap/bootstrap.min.js"></script>
        <script src="../resources/sweetalert2/sweetalert2@11.js"></script>
        <script src="public/Js/usuarios/login.js"></script>
    </body>

    
</html>


