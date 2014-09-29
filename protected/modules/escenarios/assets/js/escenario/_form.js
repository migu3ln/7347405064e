var btn_save;
$(function () {

    //ladda submit
    $("#btn_save_escenario").click(function (e) {
        e.preventDefault();
        btn_save = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save.start();
        saveEscenario(form_id);
        return false;
    });

});
function saveEscenario($form) {
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