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
    $('#frmAlbum').submit();
})