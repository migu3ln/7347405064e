<?php
/** @var EscenarioController $this */
/** @var Escenario $model */
?>
<div id="flashMsg" class="flash-messages"></div>
<div class="row">
    <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('escenarios/escenario/create') ?>"><i
            class="fa fa-plus"></i> Crear
    </a>
</div>
<br>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i
                    class="fa fa-university"></i> <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Escenario::label(2) ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php
            $this->widget('booster.widgets.TbGridView', array(
                'id' => 'escenario-grid',
                'type' => 'striped bordered hover advance',
                'dataProvider' => $model->search(),
                'columns' => array(
                    'nombre',
                    'teatro_sucre',
                    'ubicacion',
                    array(
                        'name' => 'estado',
                        'filter' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',),
                    ),
                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{update} {delete}',
                        'afterDelete' => 'function(link,success,data){
                    if(success) {
                         $("#flashMsg").empty();
                         $("#flashMsg").css("display","");
                         $("#flashMsg").html(data).animate({opacity: 1.0}, 5500).fadeOut("slow");
                    }
                    }',
                        'buttons' => array(
                            'update' => array(
                                'label' => '<button class="btn btn-primary"><i class="icon-pencil"></i></button>',
                                'options' => array('title' => 'Actualizar'),
                                'imageUrl' => false,
                                //'visible' => 'Util::checkAccess(array("action_incidenciaPrioridad_update"))'
                            ),
                            'delete' => array(
                                'label' => '<button class="btn btn-danger"><i class="icon-trash"></i></button>',
                                'options' => array('title' => 'Eliminar'),
                                'imageUrl' => false,
                                //'visible' => 'Util::checkAccess(array("action_incidenciaPrioridad_delete"))'
                            ),
                        ),
                        'htmlOptions' => array(
                            'width' => '80px'
                        )
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>

