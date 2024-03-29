/*------------------------------------------------------------------
Project:    Paperclip
Author:     Yevgeny S.
URL:        http://simpleqode.com/
            https://twitter.com/YevSim
Version:    1.1
Created:        11/03/2014
Last change:    14/08/2014
-------------------------------------------------------------------*/

/* ===== Navbar Search ===== */

$('#navbar-search > a').on('click', function() {
    $('#navbar-search > a > i').toggleClass('fa-search fa-times');
    $("#navbar-search-box").toggleClass('show hidden animated fadeInUp');
    return false;
});

/* ===== Lost password form ===== */

$('.pwd-lost > .pwd-lost-q > a').on('click', function() {
    $(".pwd-lost > .pwd-lost-q").toggleClass("show hidden");
    $(".pwd-lost > .pwd-lost-f").toggleClass("hidden show animated fadeIn");
    return false;
});

/* ===== Thumbs rating ===== */

$('.rating .voteup').on('click', function () {
    var up = $(this).closest('div').find('.up');
    up.text(parseInt(up.text(),10) + 1);
    return false;
});
$('.rating .votedown').on('click', function () {
    var down = $(this).closest('div').find('.down');
    down.text(parseInt(down.text(),10) + 1);
    return false;
});

/* ===== Responsive Showcase ===== */

$('.responsive-showcase ul > li > i').on('click', function() {
    var device = $(this).data('device');
    $('.responsive-showcase ul > li > i').addClass("inactive");
    $(this).removeClass("inactive");
    $('.responsive-showcase img').removeClass("show");
    $('.responsive-showcase img').addClass("hidden");
    $('.responsive-showcase img' + device).toggleClass("hidden show");
    $('.responsive-showcase img' + device).addClass("animated fadeIn");
    return false;
});

/* ===== Services ===== */

$('.service-item').hover (function() {
    $(this).children("i").toggleClass("fa-rotate-90");
    return false;
});

/* ===== Theme Options ===== */

$('.b-theme-options__trigger').on('click', function() {
    $(this).toggleClass("hidden show");
    $('.b-theme-options__box').toggleClass("hidden show");
    return false;
});

$('.b-theme-options-box__close').on('click', function() {
    $('.b-theme-options__trigger').toggleClass("hidden show");
    $('.b-theme-options__box').toggleClass("hidden show");
    return false;
});



/**
 * 
 * @param {cadena} url
 * @returns {undefined}
 */
function viewModal(url, CallBack, tipo)
{
    $.ajax({
        type: "POST",
        url: baseUrl + url,
        beforeSend: function () {
            showModalLoading(tipo);
        },
        success: function (data) {
            showModalData(data, tipo);
            CallBack();
        }
    });
}

function showModalLoading(tipo) {
    var html = "";

    html += '<div class="modal-dialog">';
    html += '<div class="modal-content">';
    html += "<div class='modal-header'><a class='close' data-dismiss='modal'>&times;</a><h4><i class='icon-refresh'></i> Cargando</h4></div>";
    html += "<div class='modal-body'><div class='loading'><img src='" + themeUrl + "img/loading.gif' /></div></div>";
    html += "</div>";
    html += "</div>";
    if (tipo)
    {
        $("#mainBigModal").html(html);
        $("#mainBigModal").modal("show");
    }
    else {
        $("#mainModal").html(html);
        $("#mainModal").modal("show");
    }

}
function showModalData(html, tipo) {
    if (tipo) {

        $("#mainBigModal").html(html);

    }
    else {

        $("#mainModal").html(html);

    }
//    $('select.fix').selectBox();
}
/**
 * Actualizacion de vistas por ajax
 * @param {type} url
 * @param {type} elemento
 * @param {type} callBack
 * @returns {undefined}
 */
function ajaxUpdateElement(url, elemento, callBack)
{
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        beforeSend: function (xhr) {
            var html = "<div class='loading'><img src='" + themeUrl + "img/loading.gif' /></div>";
            $(elemento).html(html);
        },
        success: function (data) {
            if (data.success) {
                $(elemento).html(data.html);
                callBack();
            } else {
                bootbox.alert(data.messages.error.toString());
            }
        }
    });
}