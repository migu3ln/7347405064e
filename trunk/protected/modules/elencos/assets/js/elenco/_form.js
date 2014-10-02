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
    if ($('img.imageslink').length > 0) {
        $('#logo').val($('img.imageslink').attr('filename'));
    } else {
        $('#logo').val(null);
    }
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