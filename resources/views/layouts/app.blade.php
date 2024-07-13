<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Add DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- Add DataTables JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])



        <style>


            /* Example: Change header background color */
            .dataTable thead th {
                background-color: #f0f0f0;
            }

            /* Example: Change font size for table cells */
            .dataTable tbody td {
                font-size: 14px;
            }

            /* Add more custom styles as needed */


            select[name="teacherTable_length"] {
                /* Add your custom styles here */
                background-color: #fff; /* Change background color */
                color: #333; /* Change text color */
                border: 1px solid #ccc; /* Add a border */
                border-radius: 4px; /* Add rounded corners */
                padding: 5px; /* Adjust padding as needed */
                /* Add more styles as desired */
                background-image: none; /* Remove background image (arrow) */
                cursor: pointer; /* Show pointer cursor to indicate interactivity */
                font-size:13px;
            }
            select[name="studentTable_length"] {
                /* Add your custom styles here */
                background-color: #fff; /* Change background color */
                color: #333; /* Change text color */
                border: 1px solid #ccc; /* Add a border */
                border-radius: 4px; /* Add rounded corners */
                padding: 5px; /* Adjust padding as needed */
                /* Add more styles as desired */
                background-image: none; /* Remove background image (arrow) */
                cursor: pointer; /* Show pointer cursor to indicate interactivity */
                font-size:13px;
            }



        </style>



        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">



    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
