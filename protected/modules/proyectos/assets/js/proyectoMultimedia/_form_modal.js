var btn_save_modal;
$(function () {
    initconpoment ();

});
function saveProyectoMultimedia(form) {
//    console.log($('#container_img_modal').find('img.imageslink'));
    if ($('#container_img_modal').find('img.imageslink').length > 0) {
        $('#ProyectoMultimedia_ubicacion').val($('#container_img_modal').find('img.imageslink').attr('filename'));
    } else {
        $('#ProyectoMultimedia_ubicacion').val(null);
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
                ajaxUpdateElement(baseUrl + 'proyectos/proyectoMultimedia/ajaxLoadForm/proyecto_id/' + proyecto_id, "#contenedor-form-modal", function () {
                initconpoment ();
                });
            } else {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
            }
        },
        errorCall: function (data) {
            if (data.errors.ubicacion) {
                $('#ProyectoMultimedia_ubicacion_em_').parent().parent().addClass('has-error');
                $('#ProyectoMultimedia_ubicacion_em_').addClass('error');
                $('#ProyectoMultimedia_ubicacion_em_').removeAttr('style');
                $('#ProyectoMultimedia_ubicacion_em_').html(data.errors.ubicacion);
            }
            btn_save_modal.setProgress(1);
            btn_save_modal.stop();
        }
    });
}
function initconpoment () {

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
    $("#btn_save_proyecto_multimedia").click(function (e) {
        e.preventDefault();
        btn_save_modal = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_modal.start();
        saveProyectoMultimedia(form_id);
        return false;
    });
    $('.btn_cerrar_modal').on('click', function () {
        $('#mainModal').modal('hide');
        $('#images-grid').yiiGridView('update',{url:baseUrl + 'proyectos/proyecto/create/id/'+proyecto_id});
    });

}