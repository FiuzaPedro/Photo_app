$("#modalPageType").hide();
$('#newPage').click(function () {
    $("#modalPageType").slideDown(200);
})
$('#closeModal').click(function () {
    $("#modalPageType").slideUp(200);
})

$('td').each(function () {
    $(this).click(function () {
        let currentId = $(this).attr('id');
        var urlToFetch = '', numberOfIds;
        switch (currentId) {
            case 'pageStyle1':
                urlToFetch = "../../albumstyles/pageone.html";
                numberOfIds = 2;
                break;
            case 'pageStyle2':
                urlToFetch = "../../albumstyles/pagetwo.html";
                numberOfIds = 4;
                break;
            case 'pageStyle3':
                urlToFetch = "../../albumstyles/pagethree.html";
                numberOfIds = 9;
                break;

            default: console.log('default case');
                break;
        }
        let currentData, currentLength;
        $.get(urlToFetch, function (data, status) {
            currentData = data;
            if (status === 'success') {
                $('#albumContainer').append(currentData);
                currentLength = document.getElementsByClassName('items').length;
                for (let i = currentLength - numberOfIds; i < document.getElementsByClassName('items').length; i++) {
                    document.getElementsByClassName('items')[i].setAttribute('id', 'item' + i);
                }
            }
        });
        $("#modalPageType").slideUp(200);

        setTimeout(() => {
            $('html, body').stop().animate({ scrollTop: "+=600px" }, 400);
        }, 500);


    })

})

$("#savePage").click(function () {
    let id = document.getElementById('albumContainer').dataset.id;
    let albumHTML = $('#albumContainer').html();
    $('#html').css({
        visibility: 'visible',
        opacity: 1
    })
    setTimeout(() => {
        $('#html').val(albumHTML);
        $('#frmAlbum').attr('action', window.location.protocol + "//" + window.location.host + "/photoalbum_app/public/userphotos/savealbum/" + id);
        $('#frmAlbum').submit();
    }, 500);
})

$('#printPage').click(function () {
    Convert_HTML_To_PDF();
})

async function Convert_HTML_To_PDF() {
    const loader = document.getElementById('loader')
    loader.style.display = 'block';
    let allDels = $('.btnDelete');
    allDels.each(function () {
        $(this).hide();
    })
    var pages = document.getElementById('albumContainer');

    const pdf = await html2PDF(pages, {
        jsPDF: {
            format: 'a4',
            orientation: 'portrait'
        },
        margin: {
            top: 5,
            right: 10,
            bottom: 5,
            left: 10,
        },
        output: 'album.pdf'
    });

    loader.style.display = 'none';
    setTimeout(() => {
        allDels.show(100);
    }, 1000);
}//end ConvertHTMLtoPDF function 