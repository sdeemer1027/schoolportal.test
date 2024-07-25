<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight">
Classroom For 
@foreach($teachers as $teacher)
{{$teacher->user->name}}
{{$teacher->user->school_id}}
@endforeach
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:black-100">

     {{--$teachers--}}
<hr>

{{--$teachers->teacher_id-- }}

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
<!--
<HR>
<pre>
 "id":2428,
 "school_id":"70220",
 "name":"Rashad Johnson",
 "fname":"Katelynn",
 "lname":"Koss",
 "phone":"+1.785.345.6516",
 "address":"976 Mia River Apt. 186",
 "address2":null,
 "city":"HACKETTSTOWN",
 "state":"NJ",
 "zip":"07840",
 "email":"simonis.jaden@example.org",
 "email_verified_at":null,
 "created_at":"2024-03-07T21:25:10.000000Z",
 "updated_at":"2024-03-07T21:25:10.000000Z",
 "school_name":"Hackettstown High School" 
</pre>
-->
{{--$students


<select name="classroom_id" id="classroom_{{$student->id}}">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
--}}

{{--$students--}}



ClassRoom Schedule: <BR>

@foreach($classsched as $clas)

[ID: {{$clas->id}}] Time : {{$clas->schedule_time}}<BR>

@endforeach
{{--$classsched--}}


<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>






@foreach($students as $student)
{{--$student--}}
 <form action="{{ route('admin.assign_student_to_classroom', ['student' => $student->id, 'classroom' => $classroom->id]) }}" method="POST">
        @csrf
        <input type="text" name="classroom_id" value="{{ $classroom->id }}">
        <input type="text" name="student_id" value="{{ $student->id }}">
        <input type="test" name="school_id" value="{{$teacher->user->school_id}}">
        <div>
            <span>[ {{$student->id}} ]</span>
            <span>{{$student->fname}} {{$student->lname}}</span>
        </div>
        <button type="submit" class="btn btn-primary">Assign to Classroom</button>
    </form>
    <br>
@endforeach
      </div>
      
 <div class="p-6 text-black-900 dark:black-100">
<img src="/img/classroom-layout-pair-up.jpg">
 </div>
              
{{--$students--}}
            </div>
        </div>
    </div>
   
</x-app-layout>
