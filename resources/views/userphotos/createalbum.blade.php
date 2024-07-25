<x-app-layout>
    <h2 style="background-color: steelblue;">&nbsp;Create your album <span style="color:white">{{Auth::user()->name}}</span></h2>
    <ul class="photoList">
        @foreach ($userPhotos as $photo)        
            <li>
                <img id="{{'img' . $photo->id}}" src="{{ asset($photo->photo)}}" alt="preview image" draggable="true" ondragstart="drag(event)">
            </li>
        @endforeach
    </ul>
    
    <div class="albumContainer">
    <div class="sideBar">
        <h3>Add page</h3>
        <x-heroicon-s-document id="newPage" class="icons" />                
        <h3>Print page</h3>
        <x-heroicon-s-printer id="printPage" class="icons" />        
    </div>
        <div class="leftPage">
            <div id="item1" class="bigImg items" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
        <div class="center"></div>        
        <div class="rightPage">
            <div class="sideGallery">
                <div id="item2" ondrop="drop(event)" ondragover="allowDrop(event)" class="items galleryItem1"></div>
                <div id="item3" ondrop="drop(event)" ondragover="allowDrop(event)" class="items galleryItem2"></div>
                <div id="item4" ondrop="drop(event)" ondragover="allowDrop(event)" class="items galleryItem3"></div>
                <div id="item5" ondrop="drop(event)" ondragover="allowDrop(event)" class="items galleryItem4"></div>
                <div id="item6" ondrop="drop(event)" ondragover="allowDrop(event)" class="items galleryItem5"></div>
            </div>
        </div>
    </div>

    
</x-app-layout>
<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        let imgSrc = document.getElementById(data).getAttribute('src');                
        document.getElementById(ev.target.id).style.backgroundImage = `url(${imgSrc})`;
    }
    document.addEventListener('DOMContentLoaded', function () {
        //this gets the reference of the last id in the gallery items to put upon creating new album page
        console.log(document.getElementsByClassName('items').length)        
    })
   

</script>