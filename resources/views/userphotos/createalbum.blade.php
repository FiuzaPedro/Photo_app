<x-app-layout>
    <h2 style="background-color: steelblue;">&nbsp;Create your album <span style="color:white">{{Auth::user()->name}}</span></h2>
    <ul class="photoList">
        @foreach ($userPhotos as $photo)
            <li><img src="{{ asset($photo->photo)}}" alt="preview image"> </li>
        @endforeach
    </ul>
    <div class="albumContainer">
        <div class="leftPage">
            <div class="bigImg"></div>
        </div>
        <div class="center"></div>        
        <div class="rightPage">
            <div class="sideGallery">
                <div class="galleryItem1">1</div>
                <div class="galleryItem2">2</div>
                <div class="galleryItem3">3</div>
                <div class="galleryItem4">4</div>
                <div class="galleryItem5">5</div>
            </div>
        </div>
    </div>
</x-app-layout>
