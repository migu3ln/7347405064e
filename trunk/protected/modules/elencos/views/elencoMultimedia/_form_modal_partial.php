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

?>

<div id="container_img_modal" class="col-md-6">
    <?php
    $this->widget('ext.xupload.XUpload', array(
        'model' => $archivo_modal,
        'url' => CController::createUrl('/elencos/elencoMultimedia/uploadTmp'),
        'htmlOptions' => array('id' => 'logo-elenco-form_modal', 'class' => 'form-horizontal'),
        'attribute' => 'file',
        'multiple' => false,
        'previewImages' => $model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN ? true : false,
        'autoUpload' => true,
    ));
    ?>
    <div class="help-block error" id="ElencoMultimedia_ubicacion_em_" style="display:none">
    </div>
</div>

<div class="col-md-6">
    <?php
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'horizontal',
        'id' => 'elenco-multimedia-form',
        'action' => Yii::app()->createUrl('/elencos/elencoMultimedia/ajaxCreate/elenco_id/' . $model->elenco_id . '/tipo/' . $model->tipo),
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <div class="form-group">
        <label class="col-sm-3 control-label required" for="ElencoMultimedia_local">Local <span class="required">*</span></label>
        <div class="col-sm-9">
            <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="ElencoMultimedia[local]" id="ElencoMultimedia_local">
            <div class="help-block error" id="ElencoMultimedia_local_em_" style="display:none">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label required" for="ElencoMultimedia_menu">Menu </label>
        <div class="col-sm-9">
            <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="ElencoMultimedia[menu]" id="ElencoMultimedia_menu">
            <div class="help-block error" id="ElencoMultimedia_menu_em_" style="display:none">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label required" for="ElencoMultimedia_encabezado">Encabezado </label>
        <div class="col-sm-9">
            <input class="form-control" type="checkbox" data-switch-left="NO" data-switch-right="SI" name="ElencoMultimedia[encabezado]" id="ElencoMultimedia_encabezado">
            <div class="help-block error" id="ElencoMultimedia_encabezado_em_" style="display:none">
            </div>
        </div>
    </div>
    <!--<input type="hidden" name="ProyectoMultimedia[ubicacion]" id="ProyectoMultimedia_ubicacion" value=""/>-->

    <?php echo $form->hiddenField($model, 'ubicacion') ?>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <button id="btn_save_elenco_multimedia" class="btn btn-success ladda-button" form-id="#elenco-multimedia-form" data-style="expand-right">
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

