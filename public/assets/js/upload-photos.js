$(document).ready(function () {
    $("#upload_image").fileinput({
        theme: 'fas',
        uploadUrl: "/profile/photos",
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),
            };
        },
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFilesNum: 10,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        },
        overwriteInitial: false,
        showCancel: false,
        // showUpload: false,
        fileActionSettings: {
            showUpload: false
        }
        // initialPreviewAsData: true,
        // showUpload: true,
    });

    $('#setting-refresh-album').on('click', function(){
        location.reload(); 
    });

    $('#delete-image').on('click', function(){
        $('#delete_image_in_setting').submit();
    });
    
});

function deleteCallAjax(photoId, url){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: url,
        data: {_method: 'DELETE', id: photoId}
    })
    .done(function (data) {
        location.reload();
    }).fail(function (err) {
        alert('failed');
        location.reload();
    });
}