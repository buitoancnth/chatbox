$(document).ready(function () {

    function readURL(input, img) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(img).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    };

    function browserURL(path, path2) {
        $(path).change(function () {
            readURL(this, path2);
        });
    };

    browserURL("#imgInp", "#imgId");
    var el = document.getElementById('demo-basic');
    var vanilla = new Croppie(el, {
        viewport: {
            width: 200,
            height: 200
        },
        boundary: {
            width: 400,
            height: 400
        },
        showZoomer: true,
        enableOrientation: true
    });
    vanilla.bind({
        url: 'assets/image/user.jpg',
        // orientation: 4
    });
    //on button click
    vanilla.result('blob').then(function (blob) {
        // do something with cropped blob
    });

    $(".gambar").attr("src", "assets/image/user.jpg");
    var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            swal("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    var el1 = document.getElementById('upload-demo');

    $uploadCrop = new Croppie(el1, {
        viewport: {
            width: 150,
            height: 200,
        },
        enforceBoundary: false,
        enableExif: true
    });
    $('#cropImagePop').on('shown.bs.modal', function () {
        // alert('Shown pop');
        $uploadCrop.croppie('bind', {
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
    $('#cropImageBtn').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {
                width: 150,
                height: 200
            }
        }).then(function (resp) {
            $('#item-img-output').attr('src', resp);
            $('#cropImagePop').modal('hide');
        });
    });
    // End upload preview image
});
