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
?>
<script type="text/javascript">
    var elenco_id =<?php print $model->id ? $model->id : 0  ?>;
    var elenco_tipo =<?php echo json_encode($tipo ? $tipo : 0); ?>;

</script>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <?php if ($model->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN): ?>

                <button type="button"  class="close btn_cerrar_modal"  id-grid="#images-grid"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?php else: ?>
                <button type="button"  class="close btn_cerrar_modal"  id-grid="#file-grid"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

            <?php endif; ?>
            <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ElencoMultimedia::label(1); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row" id="contenedor-form-modal">
                <div id="container_img_modal" class="col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="content_prev_tipo" class="row" hidden>
                                <div class="col-md-offset-3 col-md-3 col-xs-4">
                                    <div class="thumbnail">
                                        <img id="img_prev_tipo" data-src="holder.js/100%x200" alt="100%x300" src="#">

                                        <div class="caption">
                                            <h4><strong>Imagen</strong></h4>

                                            <p>
                                                <a id="btn_upload_change" href="#" class="btn btn-info" role="button">
                                                    <i class="fa fa-arrows-h"></i>
                                                    Cambiar</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="content_action_tipo" class="row">
                                <div class="col-lg-12">
                                    <form id="logo-form" class="form-horizontal" role="form">
                                        <div class="form-group form-group-sm">
                                            <label class="col-sm-3 control-label" for="formGroupInputSmall">Imagen</label>

                                            <div class="col-sm-9">
                                                <button id="btn_upload_action" class="btn btn-default btn-xs"><i
                                                        class="fa fa-plus"></i> Seleccione
                                                </button>
                                                <input name="logo_imagen_tipo" id="logo_imagen_tipo" type="file" style="display: none">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

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


            </div>
            <div class="row">
                <div class="col-md-12">

                    <?php
                    $elenco_id = $model->elenco_id;
                    $tipo = $model->tipo;
                    $model->unsetAttributes();
//                    var_dump( $model->de_elenco($model->elenco_id)->search()->getData());
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-modal-grid',
//                        'showTableOnEmpty' => false,
//                        'emptyText' => '<a class="empty-portlet btn" class="jumbotron">
//                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
//                                        SUBIR IMAGEN
//                                        </a>',
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $model->de_elenco($elenco_id)->search(),
                        'columns' => $tipo == Constants::MULTIMEDIA_TIPO_IMAGEN ? array(
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
            <?php if ($tipo == Constants::MULTIMEDIA_TIPO_IMAGEN): ?>
                <button type="button" id-grid="#images-grid" class="btn btn-default btn_cerrar_modal" data-dismiss="modal">Close</button>
            <?php else: ?>
                <button type="button" id-grid="#file-grid" class="btn btn-default btn_cerrar_modal" data-dismiss="modal">Close</button>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php unset($archivo_modal) ?>

