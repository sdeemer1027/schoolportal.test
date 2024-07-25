<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">          
{{$user->name}}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:black-100">
                  {{$schools->name}}<BR>
                  {{$schools->address}}<BR><BR>

      


<b>Teachers / Classroom</b><BR>
<table id="teacherTable" class="table">
 <thead class="thead-dark">
  <tr>
    <td>Name</td>
    <td>Classroom</td>
    <td>Seats</td>
    <td>Count</td>
  </tr>
 </thead>
@foreach($teachers as $teacher)
<tr>
    <td>
<a href="{{route('admin.teachers.edit', ['teacher' => $teacher->id])}}"> [ <i class="fas fa-pencil-alt"></i> ]</a>
{{$teacher->user->name}} </td>
    <td>@foreach($teacher->classrooms as $class)
    <a href="{{route('admin.getclassroom', ['id' => $class->id])}}"> {{$class->id}} </a>
   @endforeach</td>
    <td></td>
    <td></td>

</tr>
@endforeach
</table>

{{$teachers}}










{{-- 
@foreach($teachers as $teacher)
<a href="{{route('admin.teachers.edit', ['teacher' => $teacher->id])}}"> [ <i class="fas fa-pencil-alt"></i> ]</a>
{{$teacher->user->name}} 
[Classroom 
   @foreach($teacher->classrooms as $class)
    <a href="{{route('admin.getclassroom', ['id' => $class->id])}}"> {{$class->id}} </a>
   @endforeach
]<BR> 
@endforeach
--}}
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

    </script>
</x-app-layout>
