$("#modalPageType").hide();
$('#newPage').click(function () {
    $("#modalPageType").slideDown(200);
})
$('#closeModal').click(function () {
    $("#modalPageType").slideUp(200);
})
$('td').each(function () {
    $(this).click(function () {
        let currentData;
        $.get("../../albumstyles/album_one.html", function (data, status) {
            // alert("Data: " + data + "\nStatus: " + status);
            currentData = data;
            if (status === 'success') {
                $('#albumContainer').append(currentData);
            }
        });
        $("#modalPageType").slideUp(200);
    })

})
