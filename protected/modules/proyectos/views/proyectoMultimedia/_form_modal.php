<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;

Util::tsRegisterAssetJs('_form.js');
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
            <?php
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                'type' => 'horizontal',
                'id' => 'proyecto-multimedia-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                'enableClientValidation' => false,
            ));
            ?>

            <?php echo $form->textFieldGroup($model, 'tipo', array('maxlength' => 45)) ?>
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

            <?php
//            echo $form->switchGroup($model, 'local', array(
//                'widgetOptions' => array(
//                    'options' => array(
////                        'onText' => 'SI',
//                        'offText' => 'NO',
//                    )
//                )
//            ));
            ?>
            <?php
//            echo $form->switchGroup($model, 'menu', array(
//                'widgetOptions' => array(
//                    'options' => array(
////                        'onText' => 'SI',
////                        'offText' => 'NO',
//                    )
//                )
//            ));
            ?>
            <?php
//            echo $form->switchGroup($model, 'encabezado', array(
//                'widgetOptions' => array(
//                    'options' => array(
////                        'onText' => 'SI',
////                        'offText' => 'NO',
//                    )
//                )
//            ));
            ?>

            <?php // echo $form->dropDownListGroup($model, 'proyecto_id', array('wrapperHtmlOptions' => array('class' => 'col-sm-12',), 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Proyecto::model()->findAll(), 'id', Proyecto::representingColumn()), 'htmlOptions' => array(),)))  ?>
            <?php
//            $data_proyecto = CHtml::listData(Proyecto::model()->findAll(), 'id', Proyecto::representingColumn());
//
//            echo $form->select2Group(
//                    $model, 'proyecto_id', array(
//                'wrapperHtmlOptions' => array(
//                    'class' => 'col-sm-8',
//                ),
//                "append" => '<a href="#"  id="popover" ><i class="fa fa-plus"></i></a>',
//                'widgetOptions' => array(
//                    'data' => $data_proyecto ? array(null => ' -- Seleccione -- ') + $data_proyecto : array(null => ' -- Ninguno -- '),
//                    'asDropDownList' => true,
//                    'options' => array(
//                        'tokenSeparators' => array(',', ' ')
//                    )
//                )
//                    )
//            );
//            
            ?>
<?php echo $form->textAreaGroup($model, 'ubicacion', array('rows' => 3, 'cols' => 50)) ?>

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
                        'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
                    ));
                    ?>
<?php $this->endWidget(); ?>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>

