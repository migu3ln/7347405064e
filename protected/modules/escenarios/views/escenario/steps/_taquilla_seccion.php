<?php
/**
 * @var EscenarioTaquilla $model_taquilla /*
 * @var EscenarioTaquillaSeccion $model_taquilla_seccion /*
 */
//taquillas
if (!$model_taquilla->escenario_id) {
    $model_taquilla->escenario_id = 0;
}
$dp_model_taquilla = $model_taquilla->search();

//secciones
if (!$model_taquilla_seccion->escenario_taquilla_id) {
    $model_taquilla_seccion->escenario_taquilla_id = 0;
}
$dp_model_taquilla_seccion = $model_taquilla_seccion->search();
?>
<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Agregar Taquilla') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form id="escenario-taquilla-form" role="form"
                      action="<?php echo Yii::app()->createUrl('escenarios/escenarioTaquilla/ajaxCreate') ?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label required" for="Escenario_Taquilla_nombre">Nombre <span
                                class="required">*</span></label>

                        <div class="col-md-8">
                            <input type="text" id="Escenario_Taquilla_nombre" class="form-control"
                                   name="EscenarioTaquilla[nombre]">

                            <div class="help-block error" id="EscenarioTaquilla_nombre_em_" style="display:none"></div>
                        </div>
                    </div>
                    <input type="hidden" id="Escenario_Taquilla_escenario_id" name="EscenarioTaquilla[escenario_id]">

                    <div class="form-group">
                        <div class="col-md-6">
                            <button id="btn_save_taquilla" class="btn btn-success ladda-button"
                                    form-id="#escenario-taquilla-form" data-style="expand-right">
                                <span class="ladda-label">Registrar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row-fluid">
                <?php
                $this->widget('booster.widgets.TbGridView', array(
                    'id' => 'escenario-taquilla-grid',
                    'type' => 'striped bordered hover advance',
                    'dataProvider' => $dp_model_taquilla,
                    'columns' => array(
                        'nombre',
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{select} {delete}',
                            'afterDelete' => 'function(link,success,data){ 
                            if(success) {
                                 $("#flashMsg").empty();
                                 $("#flashMsg").css("display","");
                                 $("#flashMsg").html(data).animate({opacity: 1.0}, 5500).fadeOut("slow");
                            }
                            }',
                            'buttons' => array(
                                'select' => array(
                                    'label' => '<button class="btn btn-primary"><i class="fa fa-share"></i></button>',
                                    'options' => array('title' => 'Selecionar'),
                                    'url' => '$data->id."-$data->nombre"',
                                    'click' => 'js:function(){selectTaquilla($(this).attr("href")); return false;}',
                                    'imageUrl' => false,
                                ),
                                'delete' => array(
                                    'label' => '<button class="btn btn-danger"><i class="fa fa-trash"></i></button>',
                                    'options' => array('title' => 'Eliminar'),
                                    'url' => 'Yii::app()->createUrl(\'escenarios/escenarioTaquilla/delete\',array(\'id\'=>$data->id))',
                                    'imageUrl' => false,
                                ),
                            ),
                            'htmlOptions' => array(
                                'width' => '100px'
                            )
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Agregar Secciones') ?></h3>
        </div>
        <div class="panel-body">
            <div id="escenario-taquilla-seccion-form_em" class="info-board info-board-theme-secondary">
                <h4>Antes de registrar secciones!</h4>

                <p>
                    tiene que selecionar una taquilla primero
                </p>
            </div>
            <div id="escenario-taquilla-seccion-form_panel" hidden>
                <div class="row-fluid">
                    <form id="escenario-taquilla-seccion-form" class="form-horizontal" role="form"
                          action="<?php echo Yii::app()->createUrl('escenarios/escenarioTaquillaSeccion/ajaxCreate') ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="taquilla_nombre">Taquilla Selecionada</label>

                            <div class="col-md-8">
                                <input type="text" id="taquilla_nombre" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label required" for="Escenario_Taquilla_seccion_nombre">Nombre
                                <span class="required">*</span></label>

                            <div class="col-md-8">
                                <input type="text" id="Escenario_Taquilla_Seccion_nombre" class="form-control"
                                       name="EscenarioTaquillaSeccion[nombre]">

                                <div class="help-block error" id="EscenarioTaquillaSeccion_nombre_em_"
                                     style="display:none"></div>
                            </div>
                        </div>
                        <input type="hidden" id="Escenario_Taquilla_Seccion_escenario_taquilla_id"
                               name="EscenarioTaquillaSeccion[escenario_taquilla_id]">

                        <div class="form-group">
                            <div class="col-md-6">
                                <button id="btn_save_taquilla_seccion" class="btn btn-success ladda-button"
                                        form-id="#escenario-taquilla-seccion-form" data-style="expand-right">
                                    <span class="ladda-label">Registrar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row-fluid">
                    <?php
                    $this->widget('booster.widgets.TbGridView', array(
                        'id' => 'escenario-taquilla-seccion-grid',
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $dp_model_taquilla_seccion,
                        'columns' => array(
                            'nombre',
                            array(
                                'class' => 'CButtonColumn',
                                'template' => '{delete}',
                                'afterDelete' => 'function(link,success,data){ 
                            if(success) {
                                 $("#flashMsg").empty();
                                 $("#flashMsg").css("display","");
                                 $("#flashMsg").html(data).animate({opacity: 1.0}, 5500).fadeOut("slow");
                            }
                            }',
                                'buttons' => array(
                                    'delete' => array(
                                        'label' => '<button class="btn btn-danger"><i class="fa fa-trash"></i></button>',
                                        'options' => array('title' => 'Eliminar'),
                                        'url' => 'Yii::app()->createUrl(\'escenarios/escenarioTaquillaSeccion/delete\',array(\'id\'=>$data->id))',
                                        'imageUrl' => false,
                                    ),
                                ),
                                'htmlOptions' => array(
                                    'width' => '60px'
                                )
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
