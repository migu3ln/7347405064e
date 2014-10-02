<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;

Yii::app()->clientScript->scriptMap['tmpl.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fileupload.js'] = false;
Yii::app()->clientScript->scriptMap['load-image.min.js'] = false;
Yii::app()->clientScript->scriptMap['canvas-to-blob.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.iframe-transport.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fileupload-ip.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fileupload-ui-preview.js'] = false;




Util::tsRegisterAssetJs('_form_modal.js');
/** @var ProyectoMultimediaController $this */
/** @var ProyectoMultimedia $model */
/** @var AweActiveForm $form */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ProyectoMultimedia::label(1); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                        'type' => 'horizontal',
                        'id' => 'proyecto-multimedia-form',
                        'enableAjaxValidation' => true,
                        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                        'enableClientValidation' => false,
                    ));
                    ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label required" for="ProyectoMultimedia_local">Local <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="ProyectoMultimedia[local]" id="ProyectoMultimedia_local">
                            <div class="help-block error" id="ProyectoMultimedia_local_em_" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label required" for="ProyectoMultimedia_menu">Menu </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="checkbox"  data-switch-left="NO" data-switch-right="SI" name="ProyectoMultimedia[menu]" id="ProyectoMultimedia_menu">
                            <div class="help-block error" id="ProyectoMultimedia_menu_em_" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label required" for="ProyectoMultimedia_encabezado">Encabezado </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="checkbox" data-switch-left="NO" data-switch-right="SI" name="ProyectoMultimedia[encabezado]" id="ProyectoMultimedia_encabezado">
                            <div class="help-block error" id="ProyectoMultimedia_encabezado_em_" style="display:none">
                            </div>
                        </div>
                    </div>
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
                                'htmlOptions' => array(
                                    'data-dismiss' => "modal",)
                            ));
                            ?>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    $this->widget('ext.xupload.XUpload', array(
                        'model' => $archivo_modal,
                        'url' => CController::createUrl('/proyectos/proyectoMultimedia/uploadTmp'),
                        'htmlOptions' => array('id' => 'logo-proyecto-form_modal', 'class' => 'form-horizontal'),
                        'attribute' => 'file',
                        'multiple' => false,
                        'previewImages' => true,
                        'autoUpload' => true,
                    ));
                    ?>

                </div>

            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>

