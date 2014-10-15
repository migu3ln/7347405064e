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
            <div class="well">
                <?php
                $this->widget('booster.widgets.TbGridView', array(
                    'id' => 'escenario-grid',
                    'type' => 'striped hover advance',
                    'dataProvider' => $model->search(),
                    'columns' => array(
                        'nombre',
                        array(
                            'name' => 'teatro_sucre',
                            'value' => '$data->teatro_sucre==1? "<span class=\'label label-success\'> Pertenece </span>": "<span class=\'label label-warning\'> No Pertenece</span>"',
                            'type' => 'raw'
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
                                    'label' => '<button class="btn btn-primary"><i class="fa fa-pencil"></i></button>',
                                    'options' => array('title' => 'Actualizar'),
                                    'imageUrl' => false,
                                ),
                                'delete' => array(
                                    'label' => '<button class="btn btn-danger"><i class="fa fa-trash"></i></button>',
                                    'options' => array('title' => 'Eliminar'),
                                    'imageUrl' => false,
                                ),
                            ),
                            'htmlOptions' => array(
                                'width' => '120px'
                            )
                        ),
                    ),
                )); ?>
            </div>
        </div>
    </div>
</div>

