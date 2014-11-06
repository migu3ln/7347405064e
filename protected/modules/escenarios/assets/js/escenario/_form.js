var btn_save;
var btn_save_taquilla;
var btn_save_taquilla_seccion;
var btn_upload_file;
$(function () {
    /****imagen****/
        //btn_actions
    $('#Escenario_logo').uploadFile({
        urlUpload: baseUrl + 'escenarios/escenario/ajaxUploadTemp',
        beforeClickAction: function (attr) {
            btn_upload_file = $('#' + attr.btnUploadChangeId + ',#' + attr.btnUploadActionId).ladda();
        },
        beforeUploadFile: function () {
            console.log('buf');
            btn_upload_file.ladda('start');
            btn_upload_file.ladda('setProgress', 0.4);
        },
        successUploadCall: function (data) {
            console.log('suc');
            btn_upload_file.ladda('setProgress', 1);
            btn_upload_file.ladda('stop');
        },
        errorUploadCall: function (data) {
            btn_upload_file.ladda('setProgress', 1);
            btn_upload_file.ladda('stop');
        }
    });
    $("#Escenario_descripcion").ckeditor(function () {
    }, {
        toolbarGroups: [
            {name: 'mode', groups: ['mode', 'basicstyles', 'colors', 'list', 'indent', 'blocks']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'styles']}
        ]
    });
//ladda submit
//save escenario
    $("#btn_save_escenario").click(function (e) {
        e.preventDefault();
        btn_save = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save.start();
        saveEscenario(form_id);
        return false;
    });
//save taquilla
    $("#btn_save_taquilla").click(function (e) {
        e.preventDefault();
        btn_save_taquilla = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_taquilla.start();
        saveTaquilla(form_id);
        return false;
    });
//save seccion
    $("#btn_save_taquilla_seccion").click(function (e) {
        e.preventDefault();
        btn_save_taquilla_seccion = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_taquilla_seccion.start();
        saveTaquillaSeccion(form_id);
        return false;
    });
//btn agregar multimedia
    $("#btn_multimedia").click(function () {
        $('#panel_taquilla_secciones').fadeOut(200, function () {
            $('#panel_multimedia').fadeIn(200, function () {
            });
        });
    });
//bootstrapSwitch
    $("#Escenario_teatro_sucre").bootstrapSwitch({
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
})
;
function saveEscenario($form) {
    ajaxValidarFormulario({
        formId: $form,
        beforeCall: function () {
            btn_save.setProgress(0.6);
        },
        errorCall: function () {
            btn_save.setProgress(1);
            btn_save.stop();
        },
        successCall: function (data) {
            escenario_id = data.attr.id;
            $('#panel_escenario').fadeOut(200, function () {
                $('[for="btn_multimedia"]').fadeIn(200);
                $('#panel_taquilla_secciones').fadeIn(200);
                $('#Escenario_Taquilla_escenario_id').val(escenario_id);
            });
        }
    });
}
/**
 * save taquilla
 * @param {type} $form
 * @returns {undefined}
 */
function saveTaquilla($form) {
    ajaxValidarFormulario({
        formId: $form,
        beforeCall: function () {
            btn_save_taquilla.setProgress(0.6);
        },
        errorCall: function () {
            btn_save_taquilla.setProgress(1);
            btn_save_taquilla.stop();
        },
        successCall: function (data) {
            btn_save_taquilla.setProgress(1);
            btn_save_taquilla.stop();
            $("#Escenario_Taquilla_nombre").val('');
            $("#escenario-taquilla-grid").yiiGridView('update', {
                data: {EscenarioTaquilla: {escenario_id: data.attr.escenario_id}}
            });
        }
    });
}

function selectTaquilla($id) {
    var info = $id.split('-');
    $('#escenario-taquilla-seccion-form_em').fadeOut(100, function () {
        $('#escenario-taquilla-seccion-form_panel').fadeIn(100);
        $('#Escenario_Taquilla_Seccion_escenario_taquilla_id').val(info[0]);
        $('#taquilla_nombre').val(info[1]);
        $("#escenario-taquilla-seccion-grid").yiiGridView('update', {
            data: {EscenarioTaquillaSeccion: {escenario_taquilla_id: info[0]}}
        });
    });
}
/**
 * save taquilla
 * @param {type} $form
 * @returns {undefined}
 */
function saveTaquillaSeccion($form) {
    ajaxValidarFormulario({
        formId: $form,
        beforeCall: function () {
            btn_save_taquilla_seccion.setProgress(0.6);
        },
        errorCall: function () {
            btn_save_taquilla_seccion.setProgress(1);
            btn_save_taquilla_seccion.stop();
        },
        successCall: function (data) {
            btn_save_taquilla_seccion.setProgress(1);
            btn_save_taquilla_seccion.stop();
            $("#Escenario_Taquilla_Seccion_nombre").val('');
            $("#escenario-taquilla-seccion-grid").yiiGridView('update', {
                data: {EscenarioTaquilla: {escenario_id: data.attr.escenario_id}}
            });
        }
    });
}