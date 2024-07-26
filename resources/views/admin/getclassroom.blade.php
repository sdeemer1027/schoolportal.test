<x-app-layout>

<style>
        .container {
            position: relative;
            display: inline-block;
        }

        .profile {
            position: absolute;
            width: 30px; /* Adjusted size */
            height: 30px; /* Adjusted size */
            border-radius: 50%; /* Makes the image circular */
            border: 2px solid black; /* Optional: adds a white border */
        }
        .profilet {
            position: absolute;
            width: 50px; /* Adjusted size */
            height: 50px; /* Adjusted size */
            border-radius: 50%; /* Makes the image circular */
            border: 2px solid black; /* Optional: adds a white border */
        }

        /* Teacher profile */
        .teacher-profile {
            top: 162px; /* Adjust as needed */
            left: 60px; /* Adjust as needed */
        }

        /* Student profiles */
        .student1-profile {
            top: 6px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student2-profile {
            top: 43px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student3-profile {
            top: 9px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student4-profile {
            top: 44px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student5-profile {
            top: 12px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student6-profile {
            top: 49px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student7-profile {
            top: 111px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student8-profile {
            top: 149px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student9-profile {
            top: 113px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student10-profile {
            top: 150px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student11-profile {
            top: 110px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student12-profile {
            top: 150px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student13-profile {
            top: 202px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student14-profile {
            top: 236px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student15-profile {
            top: 203px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student16-profile {
            top: 241px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student17-profile {
            top: 208px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student18-profile {
            top: 247px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student19-profile {
            top: 291px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student20-profile {
            top: 328px; /* Adjust as needed */
            left: 150px; /* Adjust as needed */
        }

        .student21-profile {
            top: 293px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student22-profile {
            top: 332px; /* Adjust as needed */
            left: 230px; /* Adjust as needed */
        }

        .student23-profile {
            top: 295px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }

        .student24-profile {
            top: 333px; /* Adjust as needed */
            left: 313px; /* Adjust as needed */
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
Classroom For 
@foreach($teachers as $teacher)
{{$teacher->user->name}}
{{$teacher->user->school_id}}
@endforeach
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:black-100">
{{--
@foreach ($teachers as $school)
    <div>
        <h2>School ID: {{ $school->school_id }}</h2>
        <h3>Teacher: {{ $school->user->name }}</h3>
        
        @foreach ($school->classrooms as $classroom)
            <div>
                <p>Classroom ID: {{ $classroom->id }}</p>
                <p>Teacher ID (from pivot): {{ $classroom->pivot->teacher_id }}</p>
            </div>
        @endforeach
    </div>
@endforeach
--}}
     {{--$classroom--}}          
{{--$students
<select name="classroom_id" id="classroom_{{$student->id}}">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
--}}

{{--$students-- }}


ClassRoom Schedule: <BR>

@foreach($classsched as $clas)

[ID: {{$clas->id}}] Time : {{$clas->schedule_time}} {{$clas->name}}<BR>

@endforeach


{{ --$classsched--}}


<BR>








<h2>Students in HomeRoom</h2>
 @foreach($classroomStudents as $studenthr)
    {{ $studenthr->user->name }}<BR>
   
@endforeach
{{--$classroomStudents--}}


      </div>
      
 <div class="p-6 text-black-900 dark:black-100">


<div class="container">

<!-- Image Map Generated by http://www.image-map.net/ -->
<img src="/img/classroom-layout-pair-up.jpg" usemap="#image-map">
 <img src="/img/me.jpg" alt="Teacher Profile" class="profilet teacher-profile">


   @foreach($classroomStudents as $student1)
    <img src="/img/stu.jpg" alt="{{ $student1->user->name }}" class="profile student{{$loop->index + 1}}-profile">
@endforeach



<!-- Student profiles -->
<!--
    <img src="/evetslogo.png" alt="Student 1 Profile" class="profile student1-profile">
    <img src="/evetslogo.png" alt="Student 2 Profile" class="profile student2-profile">
    <img src="/evetslogo.png" alt="Student 3 Profile" class="profile student3-profile">
    <img src="/evetslogo.png" alt="Student 4 Profile" class="profile student4-profile">
    <img src="/evetslogo.png" alt="Student 5 Profile" class="profile student5-profile">
    <img src="/evetslogo.png" alt="Student 6 Profile" class="profile student6-profile">
    <img src="/evetslogo.png" alt="Student 7 Profile" class="profile student7-profile">
    <img src="/evetslogo.png" alt="Student 8 Profile" class="profile student8-profile">
    <img src="/evetslogo.png" alt="Student 9 Profile" class="profile student9-profile">
    <img src="/evetslogo.png" alt="Student 10 Profile" class="profile student10-profile">
-->
    <img src="/evetslogo.png" alt="Student 11 Profile" class="profile student11-profile">
    <img src="/evetslogo.png" alt="Student 12 Profile" class="profile student12-profile">
    <img src="/evetslogo.png" alt="Student 13 Profile" class="profile student13-profile">
    <img src="/evetslogo.png" alt="Student 14 Profile" class="profile student14-profile">
    <img src="/evetslogo.png" alt="Student 15 Profile" class="profile student15-profile">
    <img src="/evetslogo.png" alt="Student 16 Profile" class="profile student16-profile">
    <img src="/evetslogo.png" alt="Student 17 Profile" class="profile student17-profile">
    <img src="/evetslogo.png" alt="Student 18 Profile" class="profile student18-profile">
    <img src="/evetslogo.png" alt="Student 19 Profile" class="profile student19-profile">
    <img src="/evetslogo.png" alt="Student 20 Profile" class="profile student20-profile">
    <img src="/evetslogo.png" alt="Student 21 Profile" class="profile student21-profile">
    <img src="/evetslogo.png" alt="Student 22 Profile" class="profile student22-profile">
    <img src="/evetslogo.png" alt="Student 23 Profile" class="profile student23-profile">
    <img src="/evetslogo.png" alt="Student 24 Profile" class="profile student24-profile">
    

<map name="image-map">
    <area target="" alt="teach" title="teach" href="teacher"        coords="24,142,100,228" shape="rect">
    <area target="" alt="student" title="student" href="student1"   coords="137,6,179,38" shape="rect">
    <area target="" alt="student" title="student" href="student2"   coords="137,43,179,76" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="216,9,265,41" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="215,44,264,80" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="296,12,345,46" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="298,49,343,83" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="135,111,181,140" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="134,149,179,179" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="219,113,264,146" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="219,150,263,182" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="299,110,348,146" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="299,150,346,183" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="130,202,178,233" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="133,236,176,272" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="214,203,264,237" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="215,241,262,274" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="297,208,348,244" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="293,247,349,280" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="128,291,180,323" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="126,328,180,361" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="211,293,260,328" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="212,332,258,363" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="294,295,340,330" shape="rect">
    <area target="" alt="student1" title="student1" href="student1" coords="296,333,337,361" shape="rect">
</map>





</div>









<h2>All Students in School</h2>
@foreach($allStudents as $student)
    {{ $student->name }}<br>
@endforeach

 </div>
              
{{--$students--}}



            </div>





        </div>
    </div>
   
</x-app-layout>
