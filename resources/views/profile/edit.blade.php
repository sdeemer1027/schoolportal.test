<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
{{-- 
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
--}}

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>


{{--
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
    --}}
</x-app-layout>
