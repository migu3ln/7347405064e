var btn_save;
var sc_teatro_sucre;
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
    //switchery
    var elem = document.querySelector('#Escenario_teatro_sucre');
    sc_teatro_sucre = new Switchery(elem);
//    sc_teatro_sucre = new Switchery($("#Escenario_teatro_sucre"));

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