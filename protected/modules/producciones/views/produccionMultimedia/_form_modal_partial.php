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
/** @var ProduccionMultimediaController $this */
/** @var ProduccionMultimedia $model */
/** @var AweActiveForm $form */
?>

<div id="container_img_modal" class="col-md-6">
    <?php
    $this->widget('ext.xupload.XUpload', array(
        'model' => $archivo_modal,
        'url' => CController::createUrl('/proyectos/proyectoMultimedia/uploadTmp'),
        'htmlOptions' => array('id' => 'logo-produccion-form_modal', 'class' => 'form-horizontal'),
        'attribute' => 'file',
        'multiple' => false,
        'previewImages' => $model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN ? true : false,
        'autoUpload' => true,
    ));
    ?>
    <div class="help-block error" id="ProduccionMultimedia_ubicacion_em_" style="display:none">
    </div>
</div>

<div class="col-md-6">
    <?php
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'horizontal',
        'id' => 'produccion-multimedia-form',
        'action' => Yii::app()->createUrl('/producciones/produccionMultimedia/ajaxCreate/produccion_id/' . $model->produccion_id . '/tipo/' . $model->tipo),
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <div class="form-group">
        <label class="col-sm-3 control-label required" for="ProduccionMultimedia_local">Local <span class="required">*</span></label>
        <div class="col-sm-9">
            <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="ProduccionMultimedia[local]" id="ProduccionMultimedia_local">
            <div class="help-block error" id="ProduccionMultimedia_local_em_" style="display:none">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label required" for="ProduccionMultimedia_menu">Menu </label>
        <div class="col-sm-9">
            <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="ProduccionMultimedia[menu]" id="ProduccionMultimedia_menu">
            <div class="help-block error" id="ProduccionMultimedia_menu_em_" style="display:none">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label required" for="ProduccionMultimedia_encabezado">Encabezado </label>
        <div class="col-sm-9">
            <input class="form-control" type="checkbox" data-switch-left="NO" data-switch-right="SI" name="ProduccionMultimedia[encabezado]" id="ProduccionMultimedia_encabezado">
            <div class="help-block error" id="ProduccionMultimedia_encabezado_em_" style="display:none">
            </div>
        </div>
    </div>
    <!--<input type="hidden" name="ProduccionMultimedia[ubicacion]" id="ProduccionMultimedia_ubicacion" value=""/>-->

    <?php echo $form->hiddenField($model, 'ubicacion') ?>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <button id="btn_save_produccion_multimedia" class="btn btn-success ladda-button" form-id="#produccion-multimedia-form" data-style="expand-right">
                <span class="ladda-label">Registrar</span>
            </button>
           <?php
            if ($model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN) {
                $this->widget('booster.widgets.TbButton', array(
                    'label' => Yii::t('AweCrud.app', 'Cancel'),
                    'htmlOptions' => array(
                        'class' => "btn_cerrar_modal",
                        'id-grid' => "#images-grid",
                    )
                ));
            } else {

                $this->widget('booster.widgets.TbButton', array(
                    'label' => Yii::t('AweCrud.app', 'Cancel'),
                    'htmlOptions' => array(
                        'class' => "btn_cerrar_modal",
                        'id-grid' => "#file-grid",
                    )
                ));
            }
            ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

