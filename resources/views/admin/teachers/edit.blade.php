

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-black leading-tight">
           
        </h2>
    </x-slot>

    

    <div class="py-12 background-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black">
                  
                </div>

                
                <div class="row">
                    <div class="col-md-12">
                       




<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold leading-tight text-gray-800">Edit Teacher Information</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $data->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">f Name</label>
            <input type="text" name="fname" id="fname" value="{{ old('fname', $data->fname) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('fname')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">l Name</label>
            <input type="text" name="lname" id="lname" value="{{ old('lname', $data->lname) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('lname')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">

            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $data->email) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $data->phone) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('phone')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Add other fields as needed -->

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
        </div>
    </form>

    {{$data}}

</div>


                    </div>
                    
                </div>

























            </div>
        </div>
    </div>
    
</x-app-layout>





