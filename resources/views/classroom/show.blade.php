<!-- resources/views/classroom/show.blade.php -->
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
                <div class="sticky-container">
                    <!-- Top row of students -->
                    <div class="student-row">
                        @foreach ($classroom->students as $student)
                            <div class="student-profile student{{ $loop->index + 1 }}">
                                {{ $student->name }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Whiteboard -->
                <div class="whiteboard">
                    Whiteboard cccccccccccccccccccccccccccccccccccc
                </div>

                <div class="container mt-5">
                    <h1>Class Schedules</h1>
                    <div class="accordion" id="scheduleAccordion">
                        @foreach ($schedule as $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                        {{ $item->name }} (Schedule Time: {{ $item->schedule_time }})
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#scheduleAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            @for ($i = 1; $i <= 24; $i++)
                                                <li class="list-group-item">
                                                    Seat {{ $i }}: 
                                                    @if (isset($item->students[$i - 1]))
                                                        {{ $item->students[$i - 1]->name }}
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
</x-app-layout>
