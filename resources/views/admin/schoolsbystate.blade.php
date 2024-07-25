<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{$user->name}}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white-100">
              

<table id="schoolTable" class="table">
 <thead class="thead-dark">
  <tr>
    <td>Name</td>
    <td>Address</td>
    <td>City</td>
    <td>County</td>
  </tr>
 </thead>
@foreach($schools as $school)
<tr>
    <td><a href="{{route('admin.getschool', ['id' => $school->id])}}">{{$school->name}}</a></td>
    <td>{{$school->address}}</td>
    <td>{{$school->city}}</td>
    <td>{{$school->county}}</td>

</tr>
@endforeach
</table>

{{$schools}}
   
                </div>

              

            </div>
        </div>
    </div>
    <script>


        $(document).ready(function() {
            $('#schoolTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                // Add more options as needed
            });
        });
        

    </script>
</x-app-layout>
