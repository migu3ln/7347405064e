<?php
Util::tsRegisterAssetJs('_form.js');
/** @var ProyectoMultimediaController $this */
/** @var ProyectoMultimedia $model */
/** @var AweActiveForm $form */
?>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ProyectoMultimedia::label(1); ?></h3>
        </div>
        <div class="panel-body">
            <?php
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                'type' => 'horizontal',
                'id' => 'proyecto-multimedia-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                'enableClientValidation' => false,
            ));
            ?>

            <?php echo $form->textFieldGroup($model, 'tipo', array('maxlength' => 45)) ?>

            <?php
            echo $form->switchGroup($model, 'local', array(
                'widgetOptions' => array(
                    'options' => array(
                        'onText' => 'SI',
                        'offText' => 'NO',
                    )
                )
            ));
            ?>
            <?php
            echo $form->switchGroup($model, 'menu', array(
                'widgetOptions' => array(
                    'options' => array(
                        'onText' => 'SI',
                        'offText' => 'NO',
                    )
                )
            ));
            ?>
            <?php
            echo $form->switchGroup($model, 'encabezado', array(
                'widgetOptions' => array(
                    'options' => array(
                        'onText' => 'SI',
                        'offText' => 'NO',
                    )
                )
            ));
            ?>

            <?php // echo $form->dropDownListGroup($model, 'proyecto_id', array('wrapperHtmlOptions' => array('class' => 'col-sm-12',), 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Proyecto::model()->findAll(), 'id', Proyecto::representingColumn()), 'htmlOptions' => array(),)))  ?>
            <?php
            $data_proyecto = CHtml::listData(Proyecto::model()->findAll(), 'id', Proyecto::representingColumn());

            echo $form->select2Group(
                    $model, 'proyecto_id', array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-8',
                ),
                "append" => '<a href="#"  id="popover" ><i class="fa fa-plus"></i></a>',
                'widgetOptions' => array(
                    'data' => $data_proyecto ? array(null => ' -- Seleccione -- ') + $data_proyecto : array(null => ' -- Ninguno -- '),
                    'asDropDownList' => true,
                    'options' => array(
                        'tokenSeparators' => array(',', ' ')
                    )
                )
                    )
            );
            ?>
            <?php echo $form->textAreaGroup($model, 'ubicacion', array('rows' => 3, 'cols' => 50)) ?>

            <div class="form-group">

                <div class="col-lg-10 col-lg-offset-2">
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
<div id="popover-head" class="hide">Nuevo Proyecto</div>
<div id="popover-content" class="hide">
    <?php $modelProyecto = new Proyecto ?>
    <?php
    $formProyecto = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'inline',
        'id' => 'proyecto-form',
        'enableAjaxValidation' => true,
        'action' => Yii::app()->createUrl('/proyectos/proyecto/ajaxCreate'),
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $formProyecto->textFieldGroup($modelProyecto, 'nombre', array('maxlength' => 150, 'placeholder' => 'Proyecto', 'class' => 'form-control ')) ?>
    <?php // echo $formProyecto->error($modelProyecto, 'nombre') ?>
    <br />
    <!--    <div class="form-group">
            <div class="col-xs-offset-2">-->
    <?php
    $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
        'size' => 'mini',
        'label' => $modelProyecto->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onclick' => 'js:saveProyecto("#proyecto-form")',
            'class' => 'btn-xs'
        )
    ));
    ?>
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'label' => Yii::t('AweCrud.app', 'Cancel'),
        'htmlOptions' => array('onclick' => 'js:cerrarpopover();',
            'class' => 'btn-xs'
        )
    ));
    ?>
    <?php $this->endWidget(); ?>
    <!--        </div>
    
        </div>-->
</div>
