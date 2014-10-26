var dataFile = {success: false};
$(function() {
    init();
});
function init()
{
    $("#btn_save_elenco").click(function(e) {
        e.preventDefault();
        btn_save = Ladda.create(this);
        var form_id = $(this).attr('form-id');
        btn_save.start();
        saveElenco(form_id);
        return false;
    });
    $("#Elenco_descripcion").ckeditor(function() {
    }, {
        toolbarGroups: [
            {name: 'mode', groups: ['mode', 'basicstyles', 'colors', 'list', 'indent', 'blocks']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'styles']}
        ]
    });
    $('#popover2').on('show.bs.popover', function() {
        abrirpopover($(this).attr('entidad'));
    });
    $('#popover2').popover({
        html: true,
        placement: 'left',
        title: function() {
            return $("#popover-head-ElencoRepresentante").html();
        },
        content: function() {
            return $("#popover-content-ElencoRepresentante").html();
        }
    });
    $("#Elenco_elenco_representante_id").select2({
        enable: true,
        initSelection: function(element, callback) {
            if ($(element).val()) {
                var data = {id: element.val(), text: $(element).attr('selected-text')};
                callback(data);
            }
//            else {
//                $("#Incidencia_contacto_id").select2("enable", false);
//            }
        },
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: baseUrl + "elencos/elencoRepresentante/ajaxlistRepresentante",
            type: "get",
            dataType: 'json',
            data: function(term, page) {
                return {
                    search_value: term, // search term
                };
            },
            results: function(data, page) { // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to alter remote JSON data
                return {results: data};
            }
        }
    });
    /****imagen****/
    //btn_actions
    $('#btn_upload_action,#btn_upload_change').click(function() {
        if (dataFile.success) {
            $('#logo_imagen').click();
        }
        else {
            $('#logo_imagen').click();
        }

        return false;
    });
    //ation load
    $("#logo_imagen").change(function() {
        var file = $("#logo_imagen")[0].files[0];
        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            if (file && isImage(fileExtension)) {
                mostrarImagen(this, "#img_prev");
                upload({
                    successCall: function(data) {
                        if (dataFile.success) {
                            deleted({delete_url: dataFile.data.delete_url});
//                            $("#url_archivo").val('');
                        }
                        $("#url_archivo").val(data.data.name);
                        console.log(data.data.name);
                        console.log("valor");
//                        $("#url_archivo").val();
                        if ($("#content_prev").attr('hidden')) {
                            $("#content_prev").toggle(200, function() {
                                $("#content_action").toggle(200);
                                $("#content_prev").removeAttr('hidden');
                            });
                        }
                    }
                });
            }
            else {
                $("#url_archivo").val(null);
                bootbox.alert('El archivo seleccionado no es una imagen');
            }
        }
    });
}
function abrirpopover(entidad_tipo) {
    $('#' + entidad_tipo + '_nombre_em_').attr('style', 'display:none;');
//    $('#Proyecto_nombre_em_').attr('style', 'display:none;');
}

function cerrarpopover() {
    $('#popover1').popover('hide');
    $('#popover2').popover('hide');
    $('#elenco-representante-form').trigger("reset");
    $('#produccion-categoria-form').trigger("reset");
}

function saveElencoRepresentante(form) {
    ajaxValidarFormulario({
        formId: form,
        beforeCall: function() {

        },
        successCall: function(data) {
            if (data.success) {
                cerrarpopover();
            } else {
            }
        },
        errorCall: function(data) {

        }
    });
}
function saveElenco($form) {

    ajaxValidarFormulario({
        formId: $form,
        beforeCall: function() {
            btn_save.setProgress(0.6);
        },
        successCall: function(data) {
            if (data.success) {
                elenco_id = data.attr.id;
                habilitarPaneles();
            } else {
                btn_save.setProgress(1);
                btn_save.stop();
            }
        },
        errorCall: function() {
            btn_save.setProgress(1);
            btn_save.stop();
        }
    });
}
function habilitarPaneles() {
    $('#contenedor-form').animate({
        'height': 'toggle'
    }, 200, function() {
        $('#contenedor-multimedia').animate({
            'height': 'toggle'
        }, 200, function() {
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
        reader.onload = function(e) {
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
        success: function(data) {
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
            success: function(data) {
                var json = JSON.parse(data);
                if (options.successCall)
                    options.successCall(json);
                dataFile = json;
            },
            //si ha ocurrido un error
            error: function() {
            }
        });
    }
}
/************* end Upload archivo****************/
/**
 * 
 * @param {type} tipo=1 IMAGEN ,3 ARCHIVO,2 VIDEOS
 * @returns {undefined}
 */
function getModal(tipo) {
    if (tipo == "2") {

        url = "elencos/elencoMultimedia/ajaxCreate/elenco_id/" + elenco_id + "/tipo/VIDEO";
        viewModal(url, function() {
        });
    }
    else if (tipo == "1") {

        url = "elencos/elencoMultimedia/ajaxCreate/elenco_id/" + elenco_id + "/tipo/IMAGEN";
        viewModal(url, function() {
        });
    }
    else if (tipo == "3") {
        url = "elencos/elencoMultimedia/ajaxCreate/elenco_id/" + elenco_id + "/tipo/ARCHIVO";
        viewModal(url, function() {
        });
    }

}