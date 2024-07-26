<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-back-200 leading-tight">           
            {{$user->name}}  [ <span id="current-time"></span> / <span id="current-day"></span>,<span id="current-date"></span>] 
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">              
 

                @if (auth()->user()->hasRole('student'))
                            Children - Teachers
                            {{--$user}}
                            <HR>
                            {{$student--}}
                            <hr>
                            
                @endif

@foreach($classschedule as $schedule)
{{$schedule->name}} {{$schedule->schedule_time}}<BR>

@endforeach
<BR><BR><BR>
                {{$classschedule}}





<h2>Classrooms</h2>
            <ul>
                @foreach ($student->classrooms as $classroom)
                <li>{{ $classroom->name }}</li>
                @endforeach
            </ul>
            <h2>Classroom Schedules</h2>
            <ul id="schedule-list">
                @foreach ($classschedule as $schedule)
                <li data-time="{{ $schedule->schedule_time }}" data-classroom="{{ $schedule->classroom_id }}">
    {{ $classrooms[$schedule->classroom_id]->name ?? 'Unknown Classroom' }} - {{ $schedule->name }} at {{ $schedule->schedule_time }}
</li>
                @endforeach
            </ul>
            <div id="classroom-link"></div>

















                </div>

                

                @if (auth()->user()->hasRole('student'))

                    @include('student.student-content')



                @endif

            </div>
        </div>
    </div>



<script>
    // Embed classroom data as a JavaScript object
    const classrooms = @json($classrooms);

    function updateTimeAndDate() {
        const now = new Date();
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
        const dayOptions = { weekday: 'long' };

        const formattedTime = now.toLocaleTimeString(undefined, timeOptions);
        const formattedDate = now.toLocaleDateString(undefined, dateOptions);
        const formattedDay = now.toLocaleDateString(undefined, dayOptions);

        document.getElementById('current-time').innerText = 'Current Time: ' + formattedTime;
        document.getElementById('current-date').innerText = 'Current Date: ' + formattedDate;

        const dayOfWeek = now.getDay(); // 0 is Sunday, 1 is Monday, ..., 6 is Saturday
        if (dayOfWeek >= 1 && dayOfWeek <= 5) { // Monday to Friday
            document.getElementById('current-day').innerText = 'Current Day: ' + formattedDay;

            const hours = now.getHours();
            const minutes = now.getMinutes();
            const currentTime = `${hours}:${minutes < 10 ? '0' : ''}${minutes}`;
            let linkDisplayed = false;

            const scheduleList = document.getElementById('schedule-list').children;

            for (let i = 0; i < scheduleList.length; i++) {
                const scheduleTime = scheduleList[i].getAttribute('data-time');
                const classroomId = scheduleList[i].getAttribute('data-classroom');

                // Find the current class based on the current time and schedule times
                if (scheduleTime <= currentTime && (i === scheduleList.length - 1 || scheduleList[i + 1].getAttribute('data-time') > currentTime)) {
                    if (currentTime >= '08:00' && currentTime < '16:00') { // Between 8 AM and 4 PM
                        const classLink = document.createElement('a');
                        classLink.href = `/class/${classroomId}`; // Link to the classroom with ID
                        classLink.innerText = `Go to ${classrooms[classroomId]?.name ?? 'Classroom'}`;
                        document.getElementById('classroom-link').appendChild(classLink);
                        linkDisplayed = true;
                        break;
                    }
                }
            }

            if (!linkDisplayed) {
                document.getElementById('classroom-link').innerText = 'No active class at this time.';
            }
        } else {
            document.getElementById('current-day').innerText = 'Out of School Days';
            document.getElementById('classroom-link').innerText = 'No classes available on weekends.';
        }
    }

    updateTimeAndDate();
    setInterval(updateTimeAndDate, 1000); // Update the time and date every second
</script>

    <script>
/*

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
*/
    </script>
</x-app-layout>
