var btn_save;
$(function () {
    init();
});

function init() {
    $("#btn_save_proyecto").click(function (e) {
        e.preventDefault();
        btn_save = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save.start();
        saveProyecto(form_id);
        return false;
    });
}

function saveProyecto($form) {
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
        successCall: function (data) {
            if (data.success) {
                proyecto_id = data.attr.id;
                habilitarPaneles();
            } else {
                btn_save.setProgress(1);
                btn_save.stop();
            }
        },
        errorCall: function () {
            btn_save.setProgress(1);
            btn_save.stop();
        }
    });
}

function habilitarPaneles() {
    $('#contenedor-form').animate({
        'height': 'toggle'
    }, 200, function () {
        $('#contenedor-multimedia').animate({
            'height': 'toggle'
        }, 200, function () {
            $('#contenedor-multimedia').removeClass('hidden');
        });
    });
}