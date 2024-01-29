<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (auth()->user()->hasRole('teacher'))
            Teachers
            @endif
            {{ __('Dashboard') }}


                @if (auth()->user()->hasRole('parent'))
                    Are you a Parent   {{-- could be a menu for teacher --}}
                @endif
{{$user->name}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white-100 text-white">
                    @if (auth()->user()->hasRole('teacher'))
                   {{-- could be a menu for teacher --}}
                    @endif
                    @if (auth()->user()->hasRole('parent'))
                            Children - Teachers
                    @endif
                    @if (auth()->user()->hasRole('student'))
                            Children - Teachers
                            {{$user}}
                    @endif
                </div>

                @if (auth()->user()->hasRole('admin'))
                <div class="row">
                    <div class="col-md-6">
                        @if ($teachers->isNotEmpty())
                            <h2>All Teachers</h2>
                            <ul>
                                @foreach ($teachers as $teacher)
                                    <li>{{ $teacher->name }} - {{ $teacher->email }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if ($students->isNotEmpty())
                            <h2>All Students</h2>
                            <ul>
                                @foreach ($students as $student)
                                    <li>{{ $student->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                @endif

                @if (auth()->user()->hasRole('teacher'))
                    @include('teacher.teacher-content')
                @endif


                @if (auth()->user()->hasRole('parent'))

                    @include('parent.parent-content')



                @endif
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
