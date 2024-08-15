<x-app-layout>
    <h2 style="background-color: steelblue;">&nbsp;Create your album <span style="color:white">{{Auth::user()->name}}</span></h2>
    <ul class="photoList">
        @foreach ($userPhotos as $photo)        
            <li>
                <img id="{{'img' . $photo->id}}" src="{{ asset($photo->photo)}}" alt="preview image" draggable="true" ondragstart="drag(event)">
            </li>
        @endforeach
    </ul>
    
    
    <div class="sideBar">
        <h3>Add page</h3>
        <x-heroicon-s-document id="newPage" class="icons" />                
        <h3>Print page</h3>
        <x-heroicon-s-printer id="printPage" class="icons" />        
        <h3>Save page</h3>
        <x-heroicon-c-cloud-arrow-down id="savePage" class="icons" />        
    </div>
    <form method="POST" id="frmAlbum" action="{{ url('savealbum/' . Auth::user()->id ) }}" style="padding:0; margin:0">
        @csrf
        <div id="albumContainer" class="albumContainer">            
        </div>
    </form>
        
    <div class="pages">
    </div>
    <div id="modalPageType"> &nbsp;        
        <h3 class="h3Pages"><span style=" margin-top: 10px; font-weight:bold">Choose your page style:</span></h3>
        <table>
            <tr>
                <td id="pageStyle1">
                    <!-- <img src="{{ asset('./img/pagestyles/2rows.JPG')}}" alt=""> -->
                </td>                
            </tr>            
            <tr>
                <td id="pageStyle2">
                    <!-- <img src="{{ asset('./img/pagestyles/2cols2rows.JPG')}}"> -->
                </td>                
            </tr>            
            <tr>
                <td id="pageStyle3">
                    <!-- <img src="{{ asset('./img/pagestyles/3cols3rows.JPG')}}"> -->
            </td>                
            </tr>
        </table>
        <x-heroicon-s-x-mark id="closeModal" class="icons iconClose" />
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
</script>
<script src="{{ asset('./js/createalbum.js')}}"></script> 