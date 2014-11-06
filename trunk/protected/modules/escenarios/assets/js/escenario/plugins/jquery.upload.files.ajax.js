/**
 * Created by @author Alex Yepez <ayepez@tradesystem.com.ec> on 31/10/2014.
 */
(function ($) {
    var methods;
    var dataElemento = {};
    var default_options = {
        preview: true,
        multiple: false,
        type: 'image',
        urlUpload: '',
        urlMethods: '',
        pnPreviewId: 'content_prev',
        pnContentActionsId: 'content_action',
        preElement: 'img_prev',
        btnUploadActionId: 'btn_upload_action',
        btnUploadChangeId: 'btn_upload_change',
        inputFile: 'logo_imagen'
        // urlUpload: url para almacenar temporalmente el archivo,
        // urlMethods: 'ur para metoros de eliminado',
        // beforeUploadFile: function (id) {},
        // successUploadCall: function (id) {},
        // successDeleteCall: function (id) {},
        // afterAjaxUpdate: function (id, data) {},
        // selectionChanged: function (id) {},
        // url: 'ajax request URL'
    };
    methods = {
        init: function (options) {
            options = $.extend(default_options, options || {});
            var elemento_id = $(this).attr('id');
            dataElemento[elemento_id] = default_options;
            setActionsBtn(elemento_id);
        }
    };
    function setActionsBtn(input_id) {
        var attr = dataElemento[input_id];
        $('#' + attr.btnUploadChangeId + ',#' + attr.btnUploadActionId).click(function (e) {
            e.preventDefault();
            if (attr.beforeClickAction !== undefined) {
                attr.beforeClickAction(attr);
            }
            $('#' + attr.inputFile).click();
        });

        $('#' + attr.inputFile).change(function () {
            var file = $("#" + attr.inputFile)[0].files[0];
            if (file) {
                var fileName = file.name;
                var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                if (file && isImage(fileExtension)) {
                    if (attr.beforeUploadFile === !undefined) {
                        attr.beforeUploadFile();
                    }
                    upload(input_id);
                }
                else {
                    $("#" + attr.inputFile).val(null);
                    bootbox.alert('El archivo seleccionado no es una imagen')
                }
            }
        });
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

    function deleted(input_id) {
        var attr = dataElemento[input_id];
        $.ajax({
            url: attr.data.data.delete_url,
            success: function (data) {
                if (data.success) {
                    $('#' + input_id).val(null);
                    if (attr.successDeleteCall !== undefined)
                        attr.successDeleteCall(data);
                }
                else {
                    if (attr.errorDeleteCall === !undefined)
                        attr.errorDeleteCall(data);
                }
            }
        });
    }

    function upload(input_id) {
        //información del formulario
        var attr = dataElemento[input_id];
        var inputFileImage = document.getElementById(attr.inputFile);
        if (inputFileImage.files[0]) {
            var file = inputFileImage.files[0];
            var formData = new FormData();
            formData.append('file', file);
            //hacemos la petición ajax
            $.ajax({
                //url: baseUrl + 'escenarios/escenario/ajaxUploadTemp',
                url: attr.urlUpload,
                type: 'POST',
                // Form data
                //datos del formulario
                data: formData,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    if (attr.beforeUploadFile !== undefined)
                        attr.beforeUploadFile();
                },
                //una vez finalizado correctamente
                success: function (data) {
                    var json = JSON.parse(data);
                    if (attr.successUploadCall !== undefined)
                        attr.successUploadCall(json);
                    if (json.success) {
                        if (attr.preview && attr.type === 'image') {
                            $('#' + attr.preElement).attr('src', json.data.src)
                        }
                        if (attr.data !== undefined && attr.data.success) {
                            deleted(input_id);
                        }
                        $('#' + input_id).val(json.data.name);
                        if ($("#" + attr.pnPreviewId).attr('hidden')) {
                            $("#" + attr.pnPreviewId).toggle(200, function () {
                                $("#" + attr.pnContentActionsId).toggle(200);
                                $("#" + attr.pnPreviewId).removeAttr('hidden');
                            });
                        }
                    }
                    else {
                        if (attr.errorUploadCall !== undefined)
                            attr.errorUploadCall(json);
                    }
                    dataElemento[input_id]['data'] = json;
                },
                //si ha ocurrido un error
                error: function () {
                }
            });
        }
    }

    $.fn.uploadFile = function ($method) {
        if (methods[$method]) {
            return methods[$method].apply(this, Array.prototype.slice(arguments, 1));
        }
        else if (typeof $method === 'object' || !$method) {
            return methods.init.apply(this, arguments);
        }
        else {
            $.error('Method ' + method + ' does not exist');
            return false;
        }
    };
})
(jQuery);