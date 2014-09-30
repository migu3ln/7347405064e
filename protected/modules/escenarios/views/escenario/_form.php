<?php
/** @var EscenarioController $this */
/** @var Escenario $model */
/** @var AweActiveForm $form */
//plugins
Util::tsRegisterAssetCss('plugins/switchery.min.css');
Util::tsRegisterAssetJs('plugins/switchery.min.js');

Util::tsRegisterAssetJs('_form.js');
?>
<div class="col-lg-12">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Escenario::label(1); ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'escenario-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => false,),
                    'enableClientValidation' => false,
                ));
                ?>
                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>
                <div class="form-group">
                    <label></label>
                    <div class="col-sm-9">
                        <input type="checkbox" id="Escenario_teatro_sucre" class="js-switch" checked />
                        <?php // echo $form->hiddenField($model, 'teatro_sucre'); ?>
                    </div>
                </div>
                <?php // echo $form->textFieldGroup($model, 'teatro_sucre') ?>
                <?php echo $form->textFieldGroup($model, 'ubicacion', array('maxlength' => 100)) ?>
                <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>
            </div>                       
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button id="btn_save_escenario" class="btn btn-success ladda-button" form-id="#escenario-form" data-style="expand-right">
                        <span class="ladda-label">Registrar</span>
                    </button>
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