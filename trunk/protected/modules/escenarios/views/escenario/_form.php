<?php
/** @var EscenarioController $this */
/** @var Escenario $model */
/** @var AweActiveForm $form */
Util::tsRegisterAssetJs('_form.js')
?>
<div class="col-lg-12">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Escenario::label(1); ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'escenario-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => true,),
                    'enableClientValidation' => false,
                ));
                ?>
                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>
                <?php echo $form->textFieldGroup($model, 'teatro_sucre') ?>
                <?php echo $form->textFieldGroup($model, 'ubicacion', array('maxlength' => 100)) ?>
                <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>
            </div>                       
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-danger ladda-button" data-color="purple" data-style="contract">
<!--                        <span class="ladda-label">Submit</span>
                        <span class="ladda-spinner"></span>
                        <div class="ladda-progress" style="width: 52px;"></div>-->
                    </button>
                    <!--<button id="btn_save_escenario" >Crear</button>-->
                    <?php
//                    $this->widget('booster.widgets.TbButton', array(
//                        'buttonType' => 'submit',
//                        'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
//                    ));
//                    
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
    </div>
</div>
</div>