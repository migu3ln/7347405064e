<?php
/** @var ElencoController $this */
/** @var Elenco $model */
/** @var AweActiveForm $form */
?>
<div class="col-lg-12">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Elenco::label(1); ?></h3>
        </div>
        <div class="panel-body">

            <?php
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                'type' => 'horizontal',
                'id' => 'elenco-form',
                'enableAjaxValidation' => false,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                'enableClientValidation' => true,
            ));
            ?>
            <?php
            echo $form->select2Group($model, 'elenco_representante_id', array(
                'wrapperHtmlOptions' =>
                array('class' => 'col-sm-7',),
                "append" => '<a href="#" id="popover1" class="pop" entidad="Escenario" ><i class="fa fa-plus"></i></a>',
                'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(ElencoRepresentante::model()->findAll(), 'id', ElencoRepresentante::representingColumn()),
                    'htmlOptions' => array(),)))
//                    array('class' => 'col-sm-7',), "append" => '<a href="#" class="rss" onclick="crearEscenario()"><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),)))
            ?>  
            <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>


            <?php
        

            echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50))
            ?>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php
                    $this->widget('booster.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'context' => 'success',
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
    </div>
</div>