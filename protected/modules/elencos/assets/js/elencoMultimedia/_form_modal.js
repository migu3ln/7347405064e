var btn_save_modal;
$(function() {
    initconpoment();

});
function saveElencoMultimedia(form) {
    if ($('#container_img_modal').find('.file').length > 0) {
        $('#ElencoMultimedia_ubicacion').val($('#container_img_modal').find('.file').attr('filename'));
    } else {
        $('#ElencoMultimedia_ubicacion').val(null);
    }
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function() {
            btn_save_modal.setProgress(0.6);
        },
        successCall: function(data) {
            if (data.success) {
                console.log(data);
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
                $('#images-modal-grid').yiiGridView('update');
                ajaxUpdateElement(baseUrl + 'elencos/elencoMultimedia/ajaxLoadForm/elenco_id/' + elenco_id + '/tipo/' + data.attr.tipo, "#contenedor-form-modal", function() {
                    initconpoment();
                });
            } else {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
            }
        },
        errorCall: function(data) {
            if (data.errors.ubicacion) {
                $('#ElencoMultimedia_ubicacion_em_').parent().parent().addClass('has-error');
                $('#ElencoMultimedia_ubicacion_em_').addClass('error');
                $('#ElencoMultimedia_ubicacion_em_').removeAttr('style');
                $('#ElencoMultimedia_ubicacion_em_').html(data.errors.ubicacion);
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
        beforeCall: function() {
            btn_save_modal.setProgress(0.6);
        },
        successCall: function(data) {
            if (data.success) {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
                $('#elenco-multimedia-form').trigger('reset');
                $('#video-modal-grid').yiiGridView('update');
            } else {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
            }
        },
        errorCall: function(data) {
            btn_save_modal.setProgress(1);
            btn_save_modal.stop();
        }
    });
}
function initconpoment() {

    //bootstrapSwitch
    $("input[type='checkbox']#ElencoMultimedia_local").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function(event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        },
    });
    $("input[type='checkbox']#ElencoMultimedia_menu").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function(event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        },
    });
    $("input[type='checkbox']#ElencoMultimedia_encabezado").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function(event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        },
    });
    $("#btn_save_elenco_multimedia").click(function(e) {
        e.preventDefault();
        btn_save_modal = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_modal.start();
        saveElencoMultimedia(form_id);
        return false;
    });
    $("#btn_save_multimedia").click(function(e) {
        e.preventDefault();
        btn_save_modal = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_modal.start();
        saveVideoMultimedia(form_id);
        return false;
    });
    $('.btn_cerrar_modal').on('click', function() {
        $('#mainModal').modal('hide');
        $($(this).attr('id-grid')).yiiGridView('update', {url: baseUrl + 'elencos/elenco/create/id/' + elenco_id});
    });

}