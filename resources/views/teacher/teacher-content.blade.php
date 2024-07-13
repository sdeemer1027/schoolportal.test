<span style=color:#fff>

{{$user}}

@if ($schoolName)
    <h2>Your School Details</h2>
    <p>Name: {{ $schoolName->name }}</p>
    <p>Address: {{ $schoolName->address }}</p>
    <p>City: {{ $schoolName->city }}, {{ $schoolName->state }} {{ $schoolName->zip }}</p>
    <p>Phone: {{ $schoolName->phone }}</p>
@else
    <p>No school details found.</p>
@endif
</span>
<BR>
{{--$user->school_id--}}
{{--$schoolName}}

{{$schoolN--}}

{{--$user--}}
{{--$students--}}
{{--$teachers--}}

@if ($teachers->isNotEmpty())
    <table id="teacherTable" class="display">
        <thead>
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>School</th>
            <th>Address</th>
            <!-- Add more table headers as needed -->
        </tr>
        </thead>
        <tbody>
        @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}<br>{{ $teacher->phone }}</td>
                <td>{{-- $teacher->school_id --}}{{ $teacher->school_name }}</td>
                <td>{{ $teacher->school_address }}<BR>{{ $teacher->school_city }}</td>
                <!-- Add more table cells for other columns -->
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

 <div class="p-6">

@if ($students->isNotEmpty())
students
    <table id="studentTable" class="display">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>school</th>
            <!-- Add more table headers as needed -->
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->fname }} {{ $student->lname }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->school_name }}</td>
                <!-- Add more table cells for other columns -->
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</div>