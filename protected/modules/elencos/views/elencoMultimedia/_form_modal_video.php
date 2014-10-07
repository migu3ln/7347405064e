<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.yiigridview.js'] = false;

Util::tsRegisterAssetJs('_form_modal.js');
/** @var ProyectoMultimediaController $this */
/** @var ProyectoMultimedia $model */
/** @var AweActiveForm $form */
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id-grid="#video-grid" class="close btn_cerrar_modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ElencoMultimedia::label(1); ?></h4>
        </div>
        <div class="modal-body">
            <?php
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                'type' => 'horizontal',
                'id' => 'elenco-multimedia-form',
                'action' => Yii::app()->createUrl('/elencos/elencoMultimedia/ajaxCreate/elenco_id/' . $model->elenco_id . '/tipo/' . Constants::MULTIMEDIA_TIPO_VIDEO),
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                'enableClientValidation' => false,
            ));
            ?>
            <?php $model->local = 0;
            ?>
            <?php
            echo $form->textFieldGroup($model, 'ubicacion', array(
                'wrapperHtmlOptions' => array(
                    'type' => 'url',
                ),
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
            <!--<input type="hidden" name="ProyectoMultimedia[ubicacion]" id="ProyectoMultimedia_ubicacion" value=""/>-->

            <?php echo $form->hiddenField($model, 'local') ?>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button id="btn_save_multimedia" class="btn btn-success ladda-button" form-id="#elenco-multimedia-form" data-style="expand-right">
                        <span class="ladda-label">Registrar</span>
                    </button>
                    <?php
                    $this->widget('booster.widgets.TbButton', array(
                        'label' => Yii::t('AweCrud.app', 'Cancel'),
                        'htmlOptions' => array(
                            'class' => "btn_cerrar_modal",
                            'id-grid' => "#video-grid"
                        )
                    ));
                    ?>
                    <?php $this->endWidget(); ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                  
                    <?php
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'video-modal-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR VIDEO
                                        </a>',
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $model->de_tipo(Constants::MULTIMEDIA_TIPO_VIDEO)->de_elenco($model->elenco_id)->search(),
                        'columns' => array(
                            'ubicacion'
                        )
                    ));
                    ?>

                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" id-grid="#video-grid" class="btn btn-default btn_cerrar_modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

