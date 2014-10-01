$(function () {
    //bootstrapSwitch
    $("#ProyectoMultimedia_local").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function (event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        }
    });
    $("#ProyectoMultimedia_menu").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function (event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        }
    });
    $("#ProyectoMultimedia_encabezado").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function (event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        }
    });
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