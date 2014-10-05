var btn_save;
var btn_save_taquilla;
var sc_teatro_sucre;
$(function () {
    //ckeditor 
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
        btn_save_taquilla = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_taquilla.start();
        saveTaquillaSeccion(form_id);
        return false;
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
});
function saveEscenario($form) {
    if ($('img.imageslink').length > 0) {
        $('#logo').val($('img.imageslink').attr('filename'));
    } else {
        $('#logo').val(null);
    }
    ajaxValidarFormulario({
        formId: $form,
        beforeCall: function () {
            btn_save.setProgress(0.6);
        },
        errorCall: function () {
            btn_save.setProgress(1);
            btn_save.stop();
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
    $('#escenario-taquilla-seccion-form_em').fadeOut(100, function () {
        $('#escenario-taquilla-seccion-form_panel').fadeIn(100);
        $('#Escenario_Taquilla_Escenario_escenario_taquilla_id').val($id);
        $("#escenario-taquilla-seccion-grid").yiiGridView('update', {
            data: {EscenarioTaquillaSeccion: {escenario_taquilla_id: $id}}
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