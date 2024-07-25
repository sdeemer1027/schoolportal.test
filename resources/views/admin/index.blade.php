<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          
{{$user->name}}


{{--$roles--}}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white-100">
                  {{--$studentInfos--}}
@foreach($states as $state)
<a href="{{route('admin.schoolsbystate', ['stateabv' => $state->stateabv])}}">{{$state->statename}} </a><BR>
@endforeach
                </div>     
            </div>
        </div>
    </div>
   
</x-app-layout>
