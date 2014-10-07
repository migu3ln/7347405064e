var btn_save_modal;
$(function () {
    initconpoment();
    
});
function saveEscenarioMultimedia(form) {
//    console.log($('#container_img_modal').find('img.imageslink'));
    if ($('#container_img_modal .delete').length <= 0) {
        $('#EscenarioMultimedia_ubicacion').val(null);
    }
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function () {
            btn_save_modal.setProgress(0.6);
        },
        successCall: function (data) {
            if (data.success) {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
                $('#images-modal-grid').yiiGridView('update');
                ajaxUpdateElement(baseUrl + 'escenarios/escenarioMultimedia/ajaxLoadForm/escenario_id/' + escenario_id + '/tipo/' + data.attr.tipo, "#contenedor-form-modal", function () {
                    initconpoment();
                });
            } else {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
            }
        },
        errorCall: function (data) {
            if (data.errors.ubicacion) {
                $('#EscenarioMultimedia_ubicacion_em_').parent().parent().addClass('has-error');
                $('#EscenarioMultimedia_ubicacion_em_').addClass('error');
                $('#EscenarioMultimedia_ubicacion_em_').removeAttr('style');
                $('#EscenarioMultimedia_ubicacion_em_').html(data.errors.ubicacion);
            }
            btn_save_modal.setProgress(1);
            btn_save_modal.stop();
        }
    });
}

function saveVideoMultimedia(form) {
//    console.log($('#container_img_modal').find('img.imageslink'));
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function () {
            btn_save_modal.setProgress(0.6);
        },
        successCall: function (data) {
            if (data.success) {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
                $('#escenario-multimedia-form').trigger('reset');
                $('#video-modal-grid').yiiGridView('update');
            } else {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
            }
        },
        errorCall: function (data) {
            btn_save_modal.setProgress(1);
            btn_save_modal.stop();
        }
    });
}
function initconpoment() {
    
    $("#container_img_modal").bind('fileuploaddone', function (e, data) {
        data.result[0].filename ? $('#EscenarioMultimedia_ubicacion').val(data.result[0].filename) : $('#EscenarioMultimedia_ubicacion').val(null);
    });     

    //bootstrapSwitch
    $("input[type='checkbox']#EscenarioMultimedia_local").bootstrapSwitch({
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
    $("input[type='checkbox']#EscenarioMultimedia_menu").bootstrapSwitch({
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
    $("input[type='checkbox']#EscenarioMultimedia_encabezado").bootstrapSwitch({
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
    $("#btn_save_escenario_multimedia").click(function (e) {
        e.preventDefault();
        btn_save_modal = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_modal.start();
        saveEscenarioMultimedia(form_id);
        return false;
    });

    $("#btn_save_multimedia").click(function (e) {
        e.preventDefault();
        btn_save_modal = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_modal.start();
        saveVideoMultimedia(form_id);
        return false;
    });
    $('.btn_cerrar_modal').on('click', function () {
        $('#mainModal').modal('hide');
        $($(this).attr('id-grid')).yiiGridView('update', {url: baseUrl + 'escenarios/escenario/create/id/' + escenario_id});
    });

}