<div id="flashMsg" class="flash-messages"></div>
<div class="row">
    <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('elencos/elenco/create') ?>"><i
            class="fa fa-plus"></i> Crear
    </a>
</div>
<br> 
<div class="row">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i
                    class="fa fa-university"></i> <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Elenco::label(2) ?>
            </h3>
        </div>
        <div class="panel-body">
            <div class="well">


                <?php
                $this->widget('booster.widgets.TbGridView', array(
                    'id' => 'elenco-grid',
                    'type' => 'striped hover advance',
                    'dataProvider' => $model->search(),
                    'columns' => array(
                        'nombre',
                        array(
                            'name' => 'estado',
                            'filter' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',),
                        ),
                        array(
                            'name' => 'elenco_representante_id',
                            'value' => 'isset($data->elencoRepresentante) ? $data->elencoRepresentante : null',
                            'filter' => CHtml::listData(ElencoRepresentante::model()->findAll(), 'id', ElencoRepresentante::representingColumn()),
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
                ));
                ?>
            </div>
        </div>
    </div>
</div>

