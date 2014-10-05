<?php
/** @var EscenarioController $this */
/** @var Escenario $model */
/** @var AweActiveForm $form */
Util::tsRegisterAssetJs('_form.js');
?>
<div class="row-fluid" hidden>
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Escenario::label(1); ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <?php
                $this->widget('ext.xupload.XUpload', array(
                    'model' => $archivo,
                    'url' => CController::createUrl('/proyectos/proyectoMultimedia/uploadTmp'),
                    'htmlOptions' => array('id' => 'logo-proyecto-form', 'class' => 'form-horizontal'),
                    'attribute' => 'file',
                    'multiple' => false,
                    'previewImages' => true,
                    'autoUpload' => true,
                ));
                ?>
                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'escenario-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => false,),
                    'enableClientValidation' => false,
                ));
                ?>
                <input type="hidden" name="Escenario[logo]" id="logo" value=null />
                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label required" for="Escenario_teatro_sucre">¿Pertenece al Teatro Sucre ? </label>
                    <div class="col-sm-9">
                        <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="Escenario[teatro_sucre]" id="Escenario_teatro_sucre">
                        <div class="help-block error" id="Escenario_teatro_sucre_em_" style="display:none">
                        </div>
                    </div>
                </div>
                <?php echo $form->textFieldGroup($model, 'ubicacion', array('maxlength' => 100)) ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="Escenario_descripcion">Descripcion</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" placeholder="Descripcion" name="Escenario[descripcion]" id="Escenario_descripcion"></textarea>
                        <div class="help-block error" id="Escenario_descripcion_em_" style="display:none"></div>
                    </div>

                </div>
                <?php // echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>
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
<div class="row-fluid" hidden>
    <?php $this->renderPartial('steps/_taquilla_seccion', array('model_taquilla' => $model_taquilla, 'model_taquilla_seccion' => $model_taquilla_seccion)) ?>
</div>
<div class="row-fluid">
    <?php $this->renderPartial('steps/_taquilla_seccion', array('model_taquilla' => $model_taquilla, 'model_taquilla_seccion' => $model_taquilla_seccion)) ?>
</div>