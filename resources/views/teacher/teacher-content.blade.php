
@if ($teachers->isNotEmpty())
    <table id="teacherTable" class="display">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>school</th>
            <!-- Add more table headers as needed -->
        </tr>
        </thead>
        <tbody>
        @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{-- $teacher->school_id --}}{{ $teacher->school_name }}</td>
                <!-- Add more table cells for other columns -->
            </tr>
        @endforeach
        </tbody>
    </table>
@endif



@if ($students->isNotEmpty())

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
