<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          
{{--$user->name--}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white-100 text-white">
                  {{--$studentInfos--}}


{{-- <hr> 

@foreach($studentInfos as $studentInfo)
<BR><BR>
{{$studentInfo}}
<hr>
@endforeach

--}}


@foreach($studentInfos as $studentInfo)
    <div>
        <h2>{{$studentInfo->days_and_times['class']}} - Grade {{$studentInfo->days_and_times['grade']}}  - <strong>Teacher:</strong> {{ $studentInfo->teacher->user->name }} {{-- $studentInfo->teacher->user->id --}}</h2>

        <p><strong>Classroom:</strong> {{ $studentInfo->classroom }}</p>

        <p><strong>Schedule:</strong></p>
        <ul>
            @foreach($studentInfo->days_and_times['schedule'] as $schedule)
                <li>{{ $schedule['day'] }} at {{ $schedule['time'] }}</li>
            @endforeach
        </ul>
 
        <p></p>
        {{-- Add more details as needed --}}

        <hr>
    </div>
@endforeach



                </div>

              

            </div>
        </div>
    </div>
   
</x-app-layout>
