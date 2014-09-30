
<?php
Util::tsRegisterAssetJs('_form.js')
?>
<?php
/** @var ProduccionController $this */
/** @var Produccion $model */
/** @var AweActiveForm $form */
?>
<div class="col-lg-12">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Produccion::label(1); ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">

                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'produccion-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => false,),
                    'enableClientValidation' => false,
                ));
                ?>



                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150, 'wrapperHtmlOptions' => array('class' => 'col-sm-7'))) ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="Produccion_escenario_id">Escenario <span class="required">*</span></label>
                    <div class="col-sm-7 col-sm-9">
                        <?php
                        $htmlOptions = array('class' => "form-control");
                        if ($model->escenario_id) {
                            $model_escenario = Escenario::model()->findByPk($model->escenario_id);
                            $htmlOptions = array_merge($htmlOptions, array(
                                'selected-text' => $model_escenario->nombre
                            ));
                        }
                        echo $form->hiddenField($model, 'escenario_id', $htmlOptions);
                        ?>
                        <?php echo $form->error($model, 'escenario_id', array('class' => 'help-block error')); ?>
                    </div>
                </div>
                <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>

                <?php // echo $form->dropDownListGroup($model, 'estado', array('wrapperHtmlOptions' => array('class' => 'col-sm-7',), 'widgetOptions' => array('data' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',), 'htmlOptions' => array(),)))    ?>


            </div>   

            <div class="form-group">
                <div class="col-lg-7 col-lg-offset-5">
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

<div class="col-lg-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Imagenes'; ?></h3>
        </div>
        <div class="panel-body">
            <div class="jumbotron">
                <h1><span class="
                          glyphicon glyphicon-open"></span></h1>

                SUBIR IMAGEN
            </div>
            <div class="row-fluid">

            </div>
        </div>
    </div>

</div>
<div class="col-lg-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Videos'; ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">

            </div>
        </div>
    </div>

</div>
<div class="col-lg-6">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Archivos'; ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">

            </div>
        </div>
    </div>

</div>


<div id="popover-head-Escenario" class="hide popover-head">Nuevo Escenario</div>
<div id="popover-content-Escenario" class="hide popover-content">
    <?php $modelEscenario = new Escenario ?>
    <?php
    $formProyecto = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'inline',
        'id' => 'escenario-form',
        'enableAjaxValidation' => true,
        'action' => Yii::app()->createUrl('/escenarios/escenario/ajaxCreate'),
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $formProyecto->textFieldGroup($modelEscenario, 'nombre', array('maxlength' => 150, 'placeholder' => 'Proyecto', 'class' => 'form-control ')) ?>
    <?php // echo $formProyecto->error($modelEscenario, 'nombre') ?>
    <br />
    <!--    <div class="form-group">
            <div class="col-xs-offset-2">-->
    <?php
    $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
        'size' => 'mini',
        'label' => $modelEscenario->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onclick' => 'js:saveProyecto("#escenario-form")',
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

<div id="popover-head-ProduccionCategoria" class="hide popover-head">Nueva Categoria</div>
<div id="popover-content-ProduccionCategoria" class="hide popover-content">
    <?php $modelCategoria = new ProduccionCategoria ?>
    <?php
    $formProyecto = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'inline',
        'id' => 'produccion-categoria-form',
        'enableAjaxValidation' => true,
        'action' => Yii::app()->createUrl('/producciones/produccionCategoria/ajaxCreate'),
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $formProyecto->textFieldGroup($modelCategoria, 'nombre', array('maxlength' => 150, 'placeholder' => 'Proyecto', 'class' => 'form-control ')) ?>
    <?php // echo $formProyecto->error($modelCategoria, 'nombre') ?>
    <br />
    <!--    <div class="form-group">
            <div class="col-xs-offset-2">-->
    <?php
    $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
        'size' => 'mini',
        'label' => $modelCategoria->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onclick' => 'js:saveProyecto("#produccion-categoria-form")',
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