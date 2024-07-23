<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-back-200 leading-tight">
           
            {{$user->name}}

        </h2>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">



               

                @if (auth()->user()->hasRole('student'))
                            Children - Teachers
                            {{$user}}

                            <HR>

                            {{$student}}
                            <hr>
                            
                @endif
                </div>

                

                @if (auth()->user()->hasRole('student'))

                    @include('student.student-content')



                @endif

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
