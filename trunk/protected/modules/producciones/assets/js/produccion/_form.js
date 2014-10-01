$(function() {
    $('#popover1').on('show.bs.popover', function() {
        abrirpopover($(this).attr('entidad'));
    });
    $('#popover2').on('show.bs.popover', function() {
        abrirpopover($(this).attr('entidad'));
    });
    $('#popover1').popover({
        html: true,
        placement: 'left',
        title: function() {
            return $("#popover-head-Escenario").html();
        },
        content: function() {
            return $("#popover-content-Escenario").html();
        }
    });
    $('#popover2').popover({
        html: true,
        placement: 'left',
        title: function() {
            return $("#popover-head-ProduccionCategoria").html();
        },
        content: function() {
            return $("#popover-content-ProduccionCategoria").html();
        }
    });

    $("#Produccion_escenario_id").select2({
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
            url: baseUrl + "escenarios/escenario/ajaxlistEscenarios",
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
    $("#Produccion_produccion_categoria_id").select2({
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
            url: baseUrl + "producciones/produccionCategoria/ajaxlistProduccionCategorias",
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

});

function crearCategoria() {
    console.log('crearCategoria');
}
function crearEscenario() {
    console.log('crearEscenario');
}

function abrirpopover(entidad_tipo) {
    $('#' + entidad_tipo + '_nombre_em_').attr('style', 'display:none;');
//    $('#Proyecto_nombre_em_').attr('style', 'display:none;');
}

function cerrarpopover() {
    $('#popover1').popover('hide');
    $('#popover2').popover('hide');
    $('#escenario-form').trigger("reset");
    $('#produccion-categoria-form').trigger("reset");
}

function saveProyecto(form) {
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