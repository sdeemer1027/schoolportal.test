<x-app-layout>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .sticky-container {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            z-index: 1;
        }

        .student-profile {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f1f1f1;
            text-align: center;
            line-height: 50px;
            margin: 5px;
        }

        .whiteboard {
            width: 100%;
            height: 500px;
            background-color: #fff;
            border: 1px solid #ddd;
            text-align: center;
            line-height: 500px;
            margin-top: 10px;
        }

        .student-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            background-color: #f8f9fa;
        }
    </style>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

<div class="profile">
{{--
        @if (Auth::user()->profile_picture)
            <img src="{{ Storage::url('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-full w-24 h-24">
        @else
            <img src="{{ asset('default-avatar.png') }}" alt="Default Avatar" class="rounded-full w-24 h-24">
        @endif
--}}
    </div>





                <div class="sticky-container">
                    <!-- Top row of students -->
                    <div class="student-row" id="top-row">
                        @for ($i = 1; $i <= 12; $i++)
                            <div class="student-profile" id="student{{ $i }}">
                                Available
                            </div>
                        @endfor
                    </div>

                    <!-- Bottom row of students -->
                    <div class="student-row" id="bottom-row">
                        @for ($i = 13; $i <= 24; $i++)
                            <div class="student-profile" id="student{{ $i }}">
                                Available
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Whiteboard -->
                <div class="whiteboard">
                    Whiteboard
                </div>

                <div class="container mt-5">
                    <h1>Class Schedules</h1>
                    <div class="accordion" id="scheduleAccordion">
                        @php
                            $classSchedules = [];
                            foreach ($schedule as $item) {
                                $className = $item['name'];
                                if (!isset($classSchedules[$className])) {
                                    $classSchedules[$className] = [
                                        'schedule_time' => json_decode($item['schedule_time'], true) ?? ['start' => '00:00', 'end' => '23:59'],
                                        'students' => []
                                    ];
                                }

                                if ($item['student_id'] !== null) {
                                    $studentInfo = $item['student'];
                                    $classSchedules[$className]['students'][] = [
                                        'id' => $studentInfo['id'],
                                        'name' => $studentInfo['name']
                                    ];
                                }
                               // dd($item['schedule_time']);
                            }
                        @endphp

                      
                        @foreach ($classSchedules as $className => $details)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                        {{ $className }} (Schedule Time: {{ $details['schedule_time']['start'] ?? 'N/A' }} - {{ $details['schedule_time']['end'] ?? 'N/A' }})
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#scheduleAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            @for ($i = 1; $i <= 24; $i++)
                                                @php
                                                    $seat = $details['students'][$i - 1] ?? null;
                                                @endphp
                                                <li class="list-group-item">
                                                    Seat {{ $i }}: 
                                                    @if ($seat)
                                                        {{ $seat['name'] }} (ID: {{ $seat['id'] }})
                                                    @else
                                                        Available
                                                    @endif
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach





                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scheduleData = @json($classSchedules);

            function getCurrentSchedule() {
                const now = new Date();
                const currentTime = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

                let currentClassSchedule = null;

                for (const className in scheduleData) {
                    const schedule = scheduleData[className]?.schedule_time ?? {};
                    const start = schedule.start ?? '00:00';
                    const end = schedule.end ?? '23:59';

                    if (currentTime >= start && currentTime <= end) {
                        currentClassSchedule = scheduleData[className];
                        break;
                    }
                }

                return currentClassSchedule;
            }

            function updateSeating() {
                const currentSchedule = getCurrentSchedule();

                for (let i = 1; i <= 24; i++) {
                    const studentDiv = document.getElementById('student' + i);
                    if (currentSchedule && currentSchedule.students && currentSchedule.students[i - 1]) {
                        const student = currentSchedule.students[i - 1];
                        studentDiv.textContent = student.name;
                    } else {
                        studentDiv.textContent = 'Available';
                    }
                }
            }

            updateSeating();

            // Update seating every minute
            setInterval(updateSeating, 60000);
        });
    </script>
</x-app-layout>
