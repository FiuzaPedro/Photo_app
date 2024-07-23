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
                <x-heroicon-s-camera style="height:80px; display:inline"/>
                    {{ __("Welcome to the Photo App ") }}
                    <span style="color:steelblue;">{{ Auth::user()->name }}</span>                        
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 dashboardContent">        
        <div class="leftSide">
            <h2>Here you can download the specific files you will use to create your Album</h2> <hr class="mb-2">
            @if (session('status'))
                <div class="success">{{session('status')}}</div>
            @endif
            @if (session('nostatus'))
                <div class="fail">{{session('nostatus')}}</div>
            @endif
            @if ($errors->any())
                <ul class="errorAlert">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ url('userphotos/' . Auth::user()->id . '/upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="photos">Upload photos (Max: 20 photos only) </label>
                <input type="file" name="photos[]" id="photoUpload" multiple class="form-control">
                <div class="mt-2">
                    <button id="uploadBtn">Upload</button>
                </div>
            </form>
        </div>
        <div class="rightSide">        
            @if ($photoData !== null && sizeof($photoData) !== 0)
                <h2>Available photos to edit</h2>
                <hr>
                <ul class="itemUl">
                    @foreach ($photoData as $photo )                    
                        <div class="divPreviews">
                            <img class="preview" src="{{ asset($photo->photo)}}" alt="preview image">    
                            <li>{{$photo->photo}}</li>                                                        
                            <button class="btnDel"><a href="{{url('/delete/'. $photo->id  )}}">Delete</a></button>
                        </div>
                    @endforeach                    
                </ul>
                <div class="linkItem"><a href="{{url('/userphotos/createalbum/' . Auth::user()->id . '/')}}" class="createAlbumLink">Create Album</a></div>
            @else
                <h1>No photos uploaded yet</h1>
            @endif
            
         
        </div>
        
    </div>
    
</x-app-layout>
