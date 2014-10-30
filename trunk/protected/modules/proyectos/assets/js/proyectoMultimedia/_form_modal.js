var btn_save_modal;
var dataFile = {success: false};

$(function () {
    initconpoment();
    //$("#ProyectoMultimedia_ubicacion").on('change', function () {
    //    var urlyoutube = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    //    if (urlyoutube.test($(this).val())) {
    //        $('#video').empty();
    //        html = "<div  class = \"embed-responsive embed-responsive-4by3\" >";
    //        html = html + "[youtube = " + $(this).val() + "]";
    //        html = html + " </div>";
    //        $('#video').append(html);
    //        $('#video').mb_embedMovies();
    //    }
    //});

    /****imagen****/
        //btn_actions
    $('#btn_upload_action,#btn_upload_change').click(function () {
        $('#logo_imagen_tipo').click();
        return false;
    });
    //ation load
    $("#logo_imagen_tipo").change(function () {
        var file = $("#logo_imagen_tipo")[0].files[0];
        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            $msj = (elenco_tipo == "IMAGEN" || elenco_tipo == "LOGO") ? "El archivo seleccionado no es una imagen." : "El archivo seleccionado no es un archivo.";
            $validacion = (elenco_tipo == "IMAGEN" || elenco_tipo == "LOGO") ? isImage(fileExtension) : isDocument(fileExtension);
            if (file && $validacion) {
                if (elenco_tipo == "IMAGEN" || elenco_tipo == "LOGO") {
                    mostrarImagen(this, "#img_prev_tipo");
                }
//                else {
//                    $("#img_prev_tipo").html('<i class="icon icon-paper-clip"></i> ' + data.data.name);
//
//                }
                upload({
                    successCall: function (data) {
                        if (dataFile.success) {
                            deleted({delete_url: dataFile.data.delete_url});
//                            $("#url_archivo").val('');
                        }
                        $("#ProyectoMultimedia_ubicacion").val(data.data.name);
                        console.log(data);
                        $("#img_prev_tipo").html('<i class="icon icon-paper-clip"></i> ' + data.data.name);

                        console.log("valor");
//                        $("#url_archivo").val();
                        if ($("#content_prev_tipo").attr('hidden')) {
                            $("#content_prev_tipo").toggle(200, function () {
                                $("#content_action_tipo").toggle(200);
                                $("#content_action_tipo").attr('hidden', '');
                                $("#content_prev_tipo").removeAttr('hidden');
                            });
                        }
                    }
                });
            }
            else {
                $("#ProyectoMultimedia_ubicacion").val(null);
                bootbox.alert($msj);
            }
        }
    });


});
function saveProyectoMultimedia(form) {
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function () {
            btn_save_modal.setProgress(0.6);
        },
        successCall: function (data) {
            if (data.success) {
                btn_save_modal.setProgress(1);
                btn_save_modal.stop();
                if ($("#content_action_tipo").attr('hidden')) {
                    $("#content_action_tipo").toggle(200, function () {
                        $("#content_prev_tipo").toggle(200);
                        $("#content_prev_tipo").attr('hidden', '');
                        $("#content_action_tipo").removeAttr('hidden');
                    });
                }
                $('#proyecto-multimedia-form').trigger('reset');
                $('#images-modal-grid').yiiGridView('update');
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
                $('#proyecto-multimedia-form').trigger('reset');
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

    //bootstrapSwitch
    $("input[type='checkbox']#ProyectoMultimedia_local").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function (event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        },

    });
    $("input[type='checkbox']#ProyectoMultimedia_menu").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function (event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        },

    });
    $("input[type='checkbox']#ProyectoMultimedia_encabezado").bootstrapSwitch({
        onColor: 'success',
        onText: 'Si',
        offText: 'No',
        onSwitchChange: function (event, state) {
            if (state) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        },

    });
    $("#btn_save_proyecto_multimedia").click(function (e) {
        e.preventDefault();
        btn_save_modal = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save_modal.start();
        saveProyectoMultimedia(form_id);
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
        $($(this).attr('id-grid')).yiiGridView('update', {url: baseUrl + 'proyectos/proyecto/create/id/' + proyecto_id});
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
function isDocument(extension) {
    switch (extension.toLowerCase()) {
        case 'pdf':
        case 'docx':
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
    var inputFileImage = document.getElementById('logo_imagen_tipo');
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