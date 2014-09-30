<?php
/** @var ProyectoController $this */
/** @var Proyecto $model */
/** @var AweActiveForm $form */
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Proyecto::label(1); ?></h3>
            </div>
            <div class="panel-body">

                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'proyecto-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                    'enableClientValidation' => false,
                ));
                ?>

                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>

                <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>

                <?php // echo $form->dropDownListGroup($model, 'estado', array('wrapperHtmlOptions' => array('class' => 'col-sm-12',), 'widgetOptions' => array('data' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',), 'htmlOptions' => array(),))) ?>
                <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-2">
                        <?php
                        $this->widget('booster.widgets.TbButton', array(
                            'buttonType' => 'submit',
                            'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
                        ));
                        ?>
                        <?php
                        $this->widget('booster.widgets.TbButton', array(
                            'label' => Yii::t('AweCrud.app', 'Cancel'),
                            'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
                        ));
                        ?>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contenedor-multimedia" class="hidden">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Imagenes'; ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<div class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </div>',
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => ProyectoMultimedia::model()->search(),
//                            'columns' => array(
//                                'nombre',
//                                array(
//                                    'name' => 'estado',
//                                    'filter' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',),
//                                ),
//                                array(
//                                    'class' => 'CButtonColumn',
//                                    'template' => '{update} {delete}',
//                                    'afterDelete' => 'function(link,success,data){ 
//                    if(success) {
//                         $("#flashMsg").empty();
//                         $("#flashMsg").css("display","");
//                         $("#flashMsg").html(data).animate({opacity: 1.0}, 5500).fadeOut("slow");
//                    }
//                    }',
//                                    'buttons' => array(
//                                        'update' => array(
//                                            'label' => '<button class="btn btn-primary"><i class="icon-pencil"></i></button>',
//                                            'options' => array('title' => 'Actualizar'),
//                                            'imageUrl' => false,
//                                        //'visible' => 'Util::checkAccess(array("action_incidenciaPrioridad_update"))'
//                                        ),
//                                        'delete' => array(
//                                            'label' => '<button class="btn btn-danger"><i class="icon-trash"></i></button>',
//                                            'options' => array('title' => 'Eliminar'),
//                                            'imageUrl' => false,
//                                        //'visible' => 'Util::checkAccess(array("action_incidenciaPrioridad_delete"))'
//                                        ),
//                                    ),
//                                    'htmlOptions' => array(
//                                        'width' => '80px'
//                                    )
//                                ),
//                            ),
                    ));
                    ?>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Videos'; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Archivos'; ?></h3>

                </div>
                <div class="panel-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>