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




Util::tsRegisterAssetJs('_form_modal.js');
/** @var ProyectoMultimediaController $this */
/** @var ProyectoMultimedia $model */
/** @var AweActiveForm $form */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <?php if ($model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN): ?>

                <button type="button"  class="close btn_cerrar_modal"  id-grid="#images-grid"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?php else: ?>
                <button type="button"  class="close btn_cerrar_modal"  id-grid="#file-grid"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

            <?php endif; ?>
            <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ProduccionMultimedia::label(1); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row" id="contenedor-form-modal">
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
                    <!--<input type="hidden" name="ProyectoMultimedia[ubicacion]" id="ProyectoMultimedia_ubicacion" value=""/>-->

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


            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-modal-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </a>',
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $model->de_produccion($model->produccion_id)->search(),
                        'columns' => $model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN ? array(
                            array(
                                'class' => 'ext.booster.widgets.TbImageColumn',
//                                 'name'=>'ubicacion',
                                'imagePathExpression' => '$data->ubicacion',
                                'imageOptions' => array(
                                    'width' => 150,
                                    'height' => 150
                                )
                            )
                                ) : array('ubicacion')
                    ));
                    ?>

                </div>
            </div>


        </div>
        <div class="modal-footer">
             <?php if ($model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN): ?>
                <button type="button" id-grid="#images-grid" class="btn btn-default btn_cerrar_modal" data-dismiss="modal">Close</button>
            <?php else: ?>
                <button type="button" id-grid="#file-grid" class="btn btn-default btn_cerrar_modal" data-dismiss="modal">Close</button>

            <?php endif; ?>
        </div>
    </div>
</div>

