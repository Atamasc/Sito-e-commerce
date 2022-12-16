$(function () {

    String.prototype.replaceArray = function (find, replace) {
        var replaceString = this;
        for (var i = 0; i < find.length; i++) {
            replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
    };

    $('.form-rewrite').parents('form').submit(function (e) {
        e.preventDefault(e);
        return false;
    });

    $('.form-rewrite').click(function () {

        if (!$(this).parents('form')[0].checkValidity()) {
            $(this).parents('form').checkValidity();
            return false;
        }

        var val = $(this).parents('form').serialize();
        var action = $(this).data('action');

        var find = [" ", "?", "!"];
        var replace = ["-"];
        val = val.replaceArray(find, replace);

        window.location.replace(action + "/" + val);

    });

});

// === CARRELLO ===
$(function () {

    checkCart();

});

function loadDelButton() {

    $('.carrello-del').click(function () {

        let target = $(this).data('target');

        $.get('ajax/carrello-del-do?cr_id=' + target, function () {
            checkCart();
        });

    });

}

function checkCart() {

    $.get('ajax/carrello-list?no_cache=' + Date.now(), function (data) {

        $('.mini-cart-warp').html(data);
        loadDelButton();
        //checkHeader();

    });

}

$('.carrello-add').click(function () {

    if ($(this).hasClass('disabled')) return 0;

    $('#lw-alert')
        .delay(100).fadeIn('slow')
        .delay(1000).animate({bottom: '150px', opacity: 0}, 700).css('translate', 'transform')
        .css({'bottom': 0, 'opacity': 1});

    let pr_codice = $(this).data('codice');
    let pr_quantita = $('#pr_quantita').val() > 0 ? $('#pr_quantita').val() : 1;
    
    $.get('ajax/carrello-add-do?pr_quantita=' + pr_quantita + '&pr_codice=' + pr_codice, function (data) {

        checkCart();

    });

});

$('.cr-quantita').on('click change', function () {

    let cr_id = $(this).data('carrello');
    let cr_pr_quantita = $(this).children('input').val();
    let target = $(this).data('target');

    $.get('ajax/carrello-update-do?cr_pr_quantita=' + cr_pr_quantita + '&cr_id=' + cr_id, function (data) {

        checkCart();
        $(target).html(data);

        $.get('ajax/carrello-total', function (data) {

            $('.carrello-total').html(data);

        });

    });

});

// == WISHLIST ==

$('.wishlist-add').click(function () {

    if ($(this).hasClass('disabled')) return 0;

    $('#lw-alert')
        .delay(100).fadeIn('slow')
        .delay(1000).animate({bottom: '150px', opacity: 0}, 700).css('translate', 'transform')
        .css({'bottom': 0, 'opacity': 1});

    let pr_codice = $(this).data('codice');
    $.get('ajax/wishlist-add-do?pr_codice=' + pr_codice, function (data) {

    });

});


$(function () {

    // ==== MODALI ====
    $('a[data-target="#modal_box"]').click(function () {

        $.get($(this).data('href'), function (data) {

            $('#modal_box_frame').html(data);

        });

    });


});

$(function () {
    if (window.matchMedia("(max-width:800px)").matches) {
        $('.carrello-add').click(function () {
            $('#similapp').css('display', 'block');

            if ($(this).hasClass('disabled')) return 0;

            $('#tidio-chat-iframe')
                .css({'bottom': 60});

            $('#scrollUp')
                .css({'bottom': 140, 'right': 18});

        });
    } else {
        $('.carrello-add').click(function () {
            $('#lw-alert')
                .delay(100).fadeIn('slow')
                .delay(1000).animate({bottom: '150px', opacity: 0}, 700).css('translate', 'transform')
                .css({'bottom': 0, 'opacity': 1});
        });
    }
});


/* LAZY LOADING todo: LUCA Commento la sezione per problemi nella gestione delle immagini allo scroll di ritorno in alto delle pagine con le immagini */
function lw_isVisable(element) {

    var top_of_element = $(element).offset().top;
    var bottom_of_element = $(element).offset().top + $(element).outerHeight();
    var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
    var top_of_screen = $(window).scrollTop();

    return (bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element) ? true : false;

}

function lw_lazyLoading() {

    $("img[data-src]").each(function (index) {

        if (lw_isVisable($(this))) {
            $(this).attr("src", $(this).data("src"));
        }


    });

    $("img[src]").each(function (index) { //IMPOSTA DIMENSIONI FISSE RICHESTE DA LIGHTHOUSE

        let width = Math.round($(this).width());
        let height = Math.round($(this).height());
        if (width > 0) $(this).attr("width", width);
        if (height > 0) $(this).attr("height", height);

    });

    $("*[data-lw-bg]").each(function (index) {

        if (lw_isVisable($(this))) $(this).css("background-image", "url(" + $(this).data("lw-bg") + ")");

    });

}

function lw_lazyLoadingJS() {

    $("script[data-src]").each(function (index) {

        $(this).attr("src", $(this).data("src"));

    });

}

$(function () {

    lw_lazyLoading();

});

$(window).scroll(function () {

    lw_lazyLoading();
    lw_lazyLoadingJS();

});
