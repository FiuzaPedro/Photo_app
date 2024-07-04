<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Photo App') }}
        </h2>
    </x-slot>

    <div class="py-2" >
        <div > <!-- class="max-w-7xl mx-auto sm:px-6 lg:px-8" -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm ">
                <div class="p-6 text-gray-900 dark:text-gray-100 dashboardWelcome">
                    {{ __("Welcome to the Photo App ") }}
                    <span style="color:steelblue;">{{ Auth::user()->name }}</span>                        
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 dashboardContent">
        <h2>Here you can download the specific files you will use to create your Album</h2> <hr class="mb-2">
        <form action="#" method="get" enctype="multipart/form-data">
            @csrf
            <label for="photos">Upload photos (Max: 20 photos only) </label>
            <input type="file" name="photos[]" id="photoUpload" multiple class="form-control">  
            <div class="mt-2 ">
                <button class="bg-orange-200">Upload</button>
            </div>
        </form>
        
    </div>
    
</x-app-layout>
