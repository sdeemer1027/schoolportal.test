

@if(isset($user->zip) && $user->zip !== '')
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        Your Profile has a zipcode of {{$user->zip}} you may be interested in the following public schools within a 25 miles radius:

        <table id="schoolTable" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <!-- Add more table headers as needed -->
            </tr>
            </thead>
            <tbody>
            @foreach ($schoolsWithin25Miles as $schoolsWithin25Mile)
                <tr>


                    <td>{{$schoolsWithin25Mile->id}}</td>
                    <td>{{$schoolsWithin25Mile->name}}</td>
                    <td>{{$schoolsWithin25Mile->address}}</td>
                    <td>{{$schoolsWithin25Mile->city}}</td>
                    <td>{{$schoolsWithin25Mile->state}}</td>
                    <td>{{$schoolsWithin25Mile->zip}}</td>

                    <!-- Add more table cells for other columns -->
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endif

<script>

    $(document).ready(function() {
        $('#schoolTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            // Add more options as needed
        });
    });

</script>
