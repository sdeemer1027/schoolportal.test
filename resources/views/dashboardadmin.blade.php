<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">           
            {{ __('Dashboard') }}              
            {{$user->name}}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-blck-100 text-black">
                  @if (auth()->user()->hasRole('admin'))                 
                   <a href="{{route('admin.schools')}}" class="btn btn-primary">Schools</a>
                  @endif                    
                </div>

                @if (auth()->user()->hasRole('admin'))
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        @if ($teachers->isNotEmpty())
                            <h2>All Teachers</h2>

 <table id="teacherTable"  class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Full Name</th>
            <th scope="col">Contact</th>            
            <th scope="col">Address</th>
            <!-- Add more table headers as needed -->
        </tr>
        </thead>
        <tbody>
 @foreach ($teachers as $teacher)
 <tr>{{--$teacher}} <a href="{{route('admin.teachers.edit', ['teacher' => $teacher->id])}}"> [{{$teacher->id}} <i class="fas fa-pencil-alt"></i> {{$teacher->user_id}}]</a> --}}
        <td>{{ $teacher->name }}</td>
        <td>{{ $teacher->fname }} {{ $teacher->lname }}</td>
        <td>{{ $teacher->email }}</td>

<td>{{ $teacher->address }}</td>
</tr>

                                @endforeach
</tbody>
</table>

{{$teachers}}


                        @endif
                    </div>
                    <div class="col-md-6">
                        @if ($students->isNotEmpty())
                            <h2>All Students</h2>
                            <ul>
                                @foreach ($students as $student)
                                    <li>{{ $student->name }} - {{ $student->email }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

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
