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
            <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ProyectoMultimedia::label(1); ?></h4>
        </div>
        <div class="modal-body">
            <?php
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                'type' => 'horizontal',
                'id' => 'proyecto-multimedia-form',
                'action' => Yii::app()->createUrl('/proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/' . $model->proyecto_id . '/tipo/' . Constants::MULTIMEDIA_TIPO_VIDEO),
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                'enableClientValidation' => false,
            ));
            ?>
            <?php
            $model->local = 0;
            $model->menu = 0;
            $model->encabezado = 0;
            ?>
            <?php
            echo $form->textFieldGroup($model, 'ubicacion', array(
                'wrapperHtmlOptions' => array(
                    'type' => 'url',
                ),
            ));
            ?>
            <hr />
            <div id="video">
            </div>
            <?php echo $form->hiddenField($model, 'local') ?>
            <?php echo $form->hiddenField($model, 'menu') ?>
            <?php echo $form->hiddenField($model, 'encabezado') ?>
            <br />
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button id="btn_save_multimedia" class="btn btn-success ladda-button" form-id="#proyecto-multimedia-form" data-style="expand-right">
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
                        'dataProvider' => $model->de_tipo(Constants::MULTIMEDIA_TIPO_VIDEO)->de_proyecto($model->proyecto_id)->search(),
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

