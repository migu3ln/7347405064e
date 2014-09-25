<?php
/** @var EscenarioTaquillaSeccionController $this */
/** @var EscenarioTaquillaSeccion $model */
/** @var AweActiveForm $form */
?>
<div class="col-lg-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app',$model->isNewRecord ? 'Create' : 'Update') . ' ' . EscenarioTaquillaSeccion::label(1); ?></h3>
        </div>
        <div class="panel-body">

            <?php
 
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
            'type' => 'horizontal',
            'id' => 'escenario-taquilla-seccion-form',
            'enableAjaxValidation' => true,
            'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => true,),
            'enableClientValidation' => false,
            ));
            ?>
            
            
                                                    <?php echo $form->textFieldGroup($model, 'id') ?>
                                            
                                                    <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 45)) ?>
                                            
                                                    <?php echo $form->dropDownListGroup( $model, 'escenario_taquilla_id', array( 'wrapperHtmlOptions' => array('class' => 'col-sm-12',),'widgetOptions' => array('data' =>  array('' => ' -- Seleccione -- ') + CHtml::listData(EscenarioTaquilla::model()->findAll(), 'id', EscenarioTaquilla::representingColumn()),'htmlOptions' => array(),) )) ?>
                                                        </div>                        <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                                        <?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
                    <?php $this->widget('booster.widgets.TbButton', array(
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>