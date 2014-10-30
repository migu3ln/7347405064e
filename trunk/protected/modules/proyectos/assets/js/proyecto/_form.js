var btn_save;
var dataFile = {success: false};
$(function () {
    init();
//    $('#example').mb_embedMovies();
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

    $("#Proyecto_descripcion").ckeditor(function () {
    }, {
        toolbarGroups: [
            {name: 'mode', groups: ['mode', 'basicstyles', 'colors', 'list', 'indent', 'blocks']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'styles']}
        ]
    });

    //-------------------------Image------------------------
    /****imagen****/
        //btn_actions
    $('#btn_upload_action,#btn_upload_change').click(function () {
        $('#logo_imagen').click();
        return false;
    });
    //ation load
    $("#logo_imagen").change(function () {
        var file = $("#logo_imagen")[0].files[0];
        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            if (file && isImage(fileExtension)) {
                mostrarImagen(this, "#img_prev");
                upload({
                    successCall: function (data) {
                        if (dataFile.success) {
                            deleted({delete_url: dataFile.data.delete_url});
//                            $("#url_archivo").val('');
                        }
                        $("#Proyecto_logo").val(data.data.name);
                        //console.log(data.data.name);
                        //console.log("valor");
//                        $("#url_archivo").val();
                        if ($("#content_prev").attr('hidden')) {
                            $("#content_prev").toggle(200, function () {
                                $("#content_action").toggle(200);
                                $("#content_prev").removeAttr('hidden');
                            });
                        }
                    }
                });
            }
            else {
                $("#Proyecto_logo").val(null);
                bootbox.alert('El archivo seleccionado no es una imagen');
            }
        }
    });

    //--------------------------End image---------------------


}

function saveProyecto($form) {
    //if ($('img.imageslink').length > 0) {
    //    $('#logo').val($('img.imageslink').attr('filename'));
    //} else {
    //    $('#logo').val(null);
    //}
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


/************* Upload archivo ****************/
/**
 * previsualización de la imagen
 * @autor Alex Yépez <alex.Yepez@outlook.com>
 * @param input
 */
function mostrarImagen(input, prev_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(prev_id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function isImage(extension) {
    switch (extension.toLowerCase()) {
        case 'jpg':
        case 'gif':
        case 'png':
        case 'jpeg':
            return true;
            break;
        default:
            return false;
            break;
    }
}
function deleted(options) {
    $.ajax({
        url: options.delete_url,
        success: function (data) {
            if (data.success) {
                if (options.successCall)
                    options.successCall(data);
            }
            else {
                if (options.successCall)
                    options.errorCall(data);
            }
        }
    });
}
function upload(options) {
    //información del formulario
    var inputFileImage = document.getElementById('logo_imagen');
    if (inputFileImage.files[0]) {
        var file = inputFileImage.files[0];
        var formData = new FormData();
        formData.append('file', file);
        //hacemos la petición ajax
        $.ajax({
            url: baseUrl + 'elencos/elencoMultimedia/ajaxUploadTemp',
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //una vez finalizado correctamente
            success: function (data) {
                var json = JSON.parse(data);
                if (options.successCall)
                    options.successCall(json);
                dataFile = json;
            },
            //si ha ocurrido un error
            error: function () {
            }
        });
    }
}
/************* end Upload archivo****************/