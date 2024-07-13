<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          
{{$user->name}}

<BR>
{{--$roles--}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white-100">
              

<table class="table">
    <tr>
    <td>Name</td>
    <td>Address</td>
    <td>City</td>
    <td>County</td>

</tr>
@foreach($schools as $school)
<tr>
    <td><a href="{{route('admin.getschool', ['id' => $school->id])}}">{{$school->name}}</a></td>
    <td>{{$school->address}}</td>
    <td>{{$school->city}}</td>
    <td>{{$school->county}}</td>

</tr>
@endforeach
</table>


{"id","name","address","city","state","zip",
"county","lat","lon"}


{{$schools}}
   
                </div>

              

            </div>
        </div>
    </div>
   
</x-app-layout>
