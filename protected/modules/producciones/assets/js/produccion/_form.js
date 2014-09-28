$(function() {
      $('#popover1').on('show.bs.popover', function () {
        abrirpopover($(this).attr('entidad'));
    });
    $('#popover2').on('show.bs.popover', function () {
        abrirpopover($(this).attr('entidad'));
    });
$('#popover1').popover({
        html: true,
        placement: 'left',
        title: function () {
            return $("#popover-head-Escenario").html();
        },
        content: function () {
            return $("#popover-content-Escenario").html();
        }
    });
$('#popover2').popover({
        html: true,
        placement: 'left',
        title: function () {
            return $("#popover-head-ProduccionCategoria").html();
        },
        content: function () {
            return $("#popover-content-ProduccionCategoria").html();
        }
    });
});

function crearCategoria(){
    console.log('crearCategoria');
}
function crearEscenario(){
    console.log('crearEscenario');
}

function abrirpopover(entidad_tipo) {
    $('#'+entidad_tipo+'_nombre_em_').attr('style', 'display:none;');
//    $('#Proyecto_nombre_em_').attr('style', 'display:none;');
}

function cerrarpopover() {
    $('#popover1').popover('hide');
    $('#popover2').popover('hide');
    $('#escenario-form').trigger("reset");
    $('#produccion-categoria-form').trigger("reset");
}

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