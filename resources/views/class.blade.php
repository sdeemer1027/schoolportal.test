<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-back-200 leading-tight">           
            {{$user->name}}  
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">         
 {{--$user--}}  
               
<BR><BR>
{{$classroom}}

<BR><BR>

{{$schedule}}<BR><BR>
{{$teacher}}






 <h1>Classroom Details</h1>

    <p>Classroom ID: {{ $classroom->id }}</p>
    <p>Classroom Name: {{ $classroom->name }}</p>
    
    <h2>Teacher</h2>
    @if ($teacher)
        <p>Name: {{ $teacher->user->name }}</p>
        <p>Email: {{ $teacher->user->email }}</p>
    @else
        <p>No teacher assigned to this classroom.</p>
    @endif

    <h2>Current Schedule</h2>
    @if ($schedule)
        <p>Schedule Name: {{ $schedule->name }}</p>
        <p>Schedule Time: {{ $schedule->schedule_time }}</p>
    @else
        <p>No schedule available for the current time.</p>
    @endif

    <h2>Students in Classroom</h2>
    @if ($classroom->students->count())
        <ul>
            @foreach ($classroom->students as $student)
                <li>{{ $student->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No students assigned to this classroom.</p>
    @endif



















                </div>
            </div>
        </div>
    </div>
 



    </x-app-layout>
