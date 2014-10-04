<?php
if (!$model_taquilla->escenario_id) {
    $model_taquilla->escenario_id = 0;
}
$dp_model_taquilla = $model_taquilla->search();
?>
<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Agregar Taquilla') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <form id="escenario-taquilla-form"  role="form" action="<?php echo Yii::app()->createUrl('escenarios/escenarioTaquilla/ajaxCreate') ?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label required" for="Escenario_Taquilla_nombre">Nombre <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" id="Escenario_Taquilla_nombre" class="form-control" name="EscenarioTaquilla[nombre]">
                            <div class="help-block error" id="EscenarioTaquilla_nombre_em_" style="display:none"></div>
                        </div>
                    </div>
                    <input type="hidden" id="Escenario_Taquilla_escenario_id" value="1" name="EscenarioTaquilla[escenario_id]">
                    <div class="form-group">
                        <button id="btn_save_taquilla" class="btn btn-success ladda-button" form-id="#escenario-taquilla-form" data-style="expand-right">
                            <span class="ladda-label">Registrar</span>
                        </button>
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
                                    'label' => '<button class="btn btn-danger"><i class="icon-trash"></i></button>',
                                    'options' => array('title' => 'Eliminar'),
                                    'imageUrl' => false,
                                ),
                            ),
                            'htmlOptions' => array(
                                'width' => '80px'
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
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Agregar Taquilla') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <div class="col-sm-6">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Taquilla</label>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="well">
                        <div class="row-fluid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
