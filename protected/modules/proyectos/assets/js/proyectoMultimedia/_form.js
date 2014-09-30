$(function () {
    $('input[type="checkbox"]').adaptiveSwitch();

//    $('#popover').on('show.bs.popover', function () {
//        abrirpopover();
//    });
//    $('#popover').popover({
//        html: true,
//        placement: 'left',
//        title: function () {
//            return $("#popover-head").html();
//        },
//        content: function () {
//            return $("#popover-content").html();
//        }
//    });
});
function saveProyecto(form) {
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function () {

        },
        successCall: function (data) {
            if (data.success) {
                cerrarpopover();
            } else {
            }
        },
        errorCall: function (data) {

        }
    });
}
function abrirpopover() {
    $('#Proyecto_nombre_em_').attr('style', 'display:none;');
}
function cerrarpopover() {
    $('#popover').popover('hide');
    $('#proyecto-form').trigger("reset");
}