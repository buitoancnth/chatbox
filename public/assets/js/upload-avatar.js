$(document).ready(function () {
    $('.avatar figure').on('click', function () { 
        if($(".gambar").src == ''){
            $(".gambar").attr("src", "assets/image/user.jpg");
        }
        var $uploadCrop,
            tempFilename,
            rawImg,
            imageId;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-avatar').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            console.log("Sorry - you're browser doesn't support the FileReader API");
        }
    }

        var el1 = document.getElementById('upload-avatar');

        $uploadCrop = new Croppie(el1, {
            viewport: {
                width: 150,
                height: 150,
            },
            enforceBoundary: false,
            enableExif: true
        });
        $('#cropImagePop').on('shown.bs.modal', function () {
            // alert('Shown pop');
            $uploadCrop.bind({
                url: rawImg
            }).then(function () {
                console.log('jQuery bind complete');
            });
        });

        $('.item-img').on('change', function () {
            imageId = $(this).data('id');
            tempFilename = $(this).val();
            $('#cancelCropBtn').data('id', imageId);
            readFile(this);
        });

        $('#upload-avatar').mouseup(function () { 
            $uploadCrop.result( {
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 150,
                    height: 150
                }
            }).then(function (resp) {
                $('#preview_square, #preview_circle').attr('src', resp);
                // $('#cropImagePop').modal('hide');
            });
        });
        

        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.result( {
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 200,
                    height: 200
                }
            }).then(function (resp) {
                $('#item-img-output').attr('src', resp);
                $('#avatar_name').val(resp);
                $('#cropImagePop').modal('hide');
            });
        });
    });
    
    // End upload preview image
});
