<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight">
          
{{$user->name}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:black-100">

 {{$schools->name}}<BR>
 {{$schools->address}}<BR><BR>
<b>Teachers</b><BR>
@foreach($teachers as $teacher)
{{$teacher->user->name}} 
[Classroom 
   @foreach($teacher->classrooms as $class)
    <a href="{{route('admin.getclassroom', ['id' => $class->id])}}"> {{$class->id}} </a>
   @endforeach
]<BR> 




@endforeach

{{--$teachers--}}
<HR>
<b>Classrooms:</b><BR>
{{$classrooms}}
<BR><BR>
                  {{--$schools--}}
                </div>

              

            </div>
        </div>
    </div>
   
</x-app-layout>
