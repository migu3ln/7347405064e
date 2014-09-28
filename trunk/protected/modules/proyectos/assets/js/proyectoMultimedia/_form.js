$(function () {
    $('#popover').popover({
        html: true,
        placement: 'auto',
        title: function () {
            return $("#popover-head").html();
        },
        content: function () {
            return $("#popover-content").html();
        }
    });
});
function saveProyecto(form) {
    console.log('adsasd');
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function () {

        },
        successCall: function (data) {
            if (data.success) {
                console.log('save success');
            } else {
                console.log('save error');

            }
        },
        errorCall: function (data) {

        }
    });
}