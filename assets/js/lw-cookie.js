$(function() {

    if(localStorage.cookie !== 'true') {

        $('.div-cookie').show();
        $('.link-cookie-add').show();

    } else $('.link-cookie-remove').show();

    $('.btn-cookie, .link-cookie-add').click(function () {

        localStorage.cookie = 'true';
        $('.div-cookie').hide();
        $('.link-cookie-add').hide();
        $('.link-cookie-remove').show();

    });

    $('.link-cookie-remove').click(function () {

        localStorage.cookie = 'false';
        $('.div-cookie').show();
        $('.link-cookie-add').show();
        $('.link-cookie-remove').hide();

    });

});