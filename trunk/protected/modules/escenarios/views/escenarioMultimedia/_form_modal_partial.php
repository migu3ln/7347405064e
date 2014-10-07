<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;

Yii::app()->clientScript->scriptMap['tmpl.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fileupload.js'] = false;
Yii::app()->clientScript->scriptMap['load-image.min.js'] = false;
Yii::app()->clientScript->scriptMap['canvas-to-blob.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.iframe-transport.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fileupload-ip.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fileupload-ui-preview.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.yiigridview.js'] = false;




//Util::tsRegisterAssetJs('_form_modal.js');
/** @var EscenarioMultimediaController $this */
/** @var EscenarioMultimedia $model */
/** @var AweActiveForm $form */
?>

<div id="container_img_modal" class="col-md-6">
    <?php
    $this->widget('ext.xupload.XUpload', array(
        'model' => $archivo_modal,
        'url' => CController::createUrl('/proyectos/proyectoMultimedia/uploadTmp'),
        'htmlOptions' => array('id' => 'logo-escenario-form_modal', 'class' => 'form-horizontal'),
        'attribute' => 'file',
        'multiple' => false,
        'previewImages' => $model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN ? true : false,
        'autoUpload' => true,
    ));
    ?>
    <div class="help-block error" id="EscenarioMultimedia_ubicacion_em_" style="display:none">
    </div>
</div>

<div class="col-md-6">
    <?php
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'horizontal',
        'id' => 'escenario-multimedia-form',
        'action' => Yii::app()->createUrl('/escenarios/escenarioMultimedia/ajaxCreate/escenario_id/' . $model->escenario_id . '/tipo/' . $model->tipo),
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>
    <?php echo $form->hiddenField($model, 'ubicacion') ?>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <button id="btn_save_escenario_multimedia" class="btn btn-success ladda-button" form-id="#escenario-multimedia-form" data-style="expand-right">
                <span class="ladda-label">Registrar</span>
            </button>
            <?php
            $this->widget('booster.widgets.TbButton', array(
                'label' => Yii::t('AweCrud.app', 'Cancel'),
                'htmlOptions' => array(
                    'class' => "btn_cerrar_modal",
                )
            ));
            ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

