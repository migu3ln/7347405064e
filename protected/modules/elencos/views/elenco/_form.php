<?php
/** @var ElencoController $this */
/** @var Elenco $model */
/** @var AweActiveForm $form */
Util::tsRegisterAssetJs('_form.js')
?>
<div class="col-lg-12">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Elenco::label(1); ?></h3>
        </div>
        <div class="panel-body">

            <?php
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                'type' => 'horizontal',
                'id' => 'elenco-form',
                'enableAjaxValidation' => false,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                'enableClientValidation' => true,
            ));
            ?>
            <?php
//            echo $form->select2Group($model, 'elenco_representante_id', array(
//                'wrapperHtmlOptions' =>
//                array('class' => 'col-sm-7',),
//                "append" => '<a href="#" id="popover1" class="pop" entidad="Escenario" ><i class="fa fa-plus"></i></a>',
//                'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(ElencoRepresentante::model()->findAll(), 'id', ElencoRepresentante::representingColumn()),
//                    'htmlOptions' => array(),)))
//                    array('class' => 'col-sm-7',), "append" => '<a href="#" class="rss" onclick="crearEscenario()"><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),)))
            ?>  
            <div class="form-group">
                <label class="col-sm-3 control-label" for="Elenco_escenario_id">Elenco Representante <span class="required">*</span></label>
                <div class="col-sm-7 col-sm-9">
                    <?php
                    $htmlOptions = array('class' => "form-control");
                    if ($model->elenco_representante_id) {
                        $model_elenco_representante = ElencoRepresentante::model()->findByPk($model->elenco_representante_id);
                        $htmlOptions = array_merge($htmlOptions, array(
                            'selected-text' => $model_elenco_representante->nombre
                        ));
                    }
                    echo $form->hiddenField($model, 'elenco_representante_id', $htmlOptions);
                    ?>
                    <span class="input-group-addon"><a href="#" id="popover2" class="pop" entidad="ElencoRepresentante" data-original-title="" title=""><i class="fa fa-plus"></i></a></span>

                    <?php echo $form->error($model, 'elenco_representante_id', array('class' => 'help-block error')); ?>

                </div>
            </div>
            <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>


            <?php
            echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50))
            ?>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php
                    $this->widget('booster.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'context' => 'success',
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

<div id="popover-head-ElencoRepresentante" class="hide popover-head">Nuevo Elenco Representante</div>
<div id="popover-content-ElencoRepresentante" class="hide popover-content">
    <?php $modelElencoRepresentante = new ElencoRepresentante ?>
    <?php
    $formElencoRepresentate = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'inline',
        'id' => 'elenco-representante-form',
        'enableAjaxValidation' => true,
        'action' => Yii::app()->createUrl('/elencos/elencoRepresentante/ajaxCreate'),
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>
    <?php echo $formElencoRepresentate->textFieldGroup($modelElencoRepresentante, 'titulo', array('maxlength' => 45)) ?>

    <?php echo $formElencoRepresentate->textFieldGroup($modelElencoRepresentante, 'nombre', array('maxlength' => 150)) ?>

    <br />
    <!--    <div class="form-group">
            <div class="col-xs-offset-2">-->
    <?php
    $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
        'size' => 'mini',
        'label' => $modelElencoRepresentante->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onclick' => 'js:saveElencoRepresentante("#elenco-representante-form")',
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