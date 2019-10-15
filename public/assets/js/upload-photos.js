$(document).ready(function () {
    $("#upload_image").fileinput({
        theme: 'fas',
        uploadUrl: "/setting/images",
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
        // initialPreviewAsData: true,
        // showUpload: true,
    });
});