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
            <button type="button"  class="close btn_cerrar_modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . EscenarioMultimedia::label(1); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row" id="contenedor-form-modal">
                <div id="container_img_modal" class="col-md-6">
                    <?php
                    $this->widget('ext.xupload.XUpload', array(
                        'model' => $archivo_modal,
                        'url' => CController::createUrl('/proyectos/proyectoMultimedia/uploadTmp'),
                        'htmlOptions' => array('id' => 'logo-escenario-form_modal', 'class' => 'form-horizontal'),
                        'attribute' => 'file',
                        'multiple' => false,
//                        'processdone' => 'function (e, data) {console.log(data);}',
                        'previewImages' => true,
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
                        'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => false,),
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
                        'dataProvider' => $model->search(),
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
            <button type="button" id-grid="#<?php echo $model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN ? 'images' : 'file'; ?>-grid" class="btn btn-default btn_cerrar_modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

