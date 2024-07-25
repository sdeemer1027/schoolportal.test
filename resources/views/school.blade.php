<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-black leading-tight">
           {{$school->name}}
        </h2>
    </x-slot>

    <style>
        .background-container {
            background: url('/img/school-background.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: black; /* Ensures text is readable */
        }
    </style>

    <div class="py-12 background-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black">
                  
                </div>

                
                <div class="row">
                    <div class="col-md-6">
                        {{--$user
                        <img src="/img/school-layout.png">--}}


                        <hr>
                        {{$school}}
                    </div>
                    <div class="col-md-6">
                       
                    </div>
                </div>

























            </div>
        </div>
    </div>
    <script>


        $(document).ready(function() {
            $('#teacherTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                // Add more options as needed
            });
        });
        $(document).ready(function() {
            $('#studentTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                // Add more options as needed
            });
        });

    </script>
</x-app-layout>
