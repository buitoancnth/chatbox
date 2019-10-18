// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//     if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
//         $('#totop').css('display', 'block');
//     } else {
//         $('#totop').css('display', 'none');
//     }
// }

// $(function () {
//     $("div").slice(0, 4).show();
//     $("#loadMore").on('click', function (e) {
//         e.preventDefault();
//         $("div:hidden").slice(0, 4).slideDown();
//         if ($("div:hidden").length == 0) {
//             $("#load").fadeOut('slow');
//         }
//         $('html,body').animate({
//             scrollTop: $(this).offset().top
//         }, 1500);
//     });
// });


$(document).ready(function () {
    $('#totop').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#totop').fadeIn();
        } else {
            $('#totop').fadeOut();
        }
    });

    $(function () {
    $("div.photo-relax").slice(0, 8).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("div.photo-relax:hidden").slice(0, 4).slideDown();
        if ($("div.photo-relax:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});
});
