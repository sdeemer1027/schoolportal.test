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
            @for($i = 1; $i <= 12; $i++)
                <div class="student-profile student{{ $i }}">
                    Student {{ $i }}
                </div>
            @endfor
        </div>

        <!-- Bottom row of students -->
        <div class="student-row">
            @for($i = 13; $i <= 24; $i++)
                <div class="student-profile student{{ $i }}">
                    Student {{ $i }}
                </div>
            @endfor
        </div>
    </div>

    <!-- Whiteboard -->
    <div class="whiteboard">
        Whiteboard
    </div>



           </div>
</div>
</div>






</x-app-layout>


