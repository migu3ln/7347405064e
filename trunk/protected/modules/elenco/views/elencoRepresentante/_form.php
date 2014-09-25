<div class = "col-lg-6">
    

<?php
/** @var ElencoRepresentanteController $this */
/** @var ElencoRepresentante $model */
/** @var AweActiveForm $form */
 

//$this->widget(
//    'booster.widgets.TbTabs',
//    array(
//        'type' => 'tabs', // 'tabs' or 'pills'
//        'tabs' => array(
//            array(
//                'label' => 'Home',
//                'content' => 'Home Content',
//                'active' => true
//            ),
//            array('label' => 'Profile', 'content' => 'Profile Content'),
//            array('label' => 'Messages', 'content' => 'Messages Content'),
//        ),
//    )
//);

?>
</div>
<div class = "col-lg-6">
<div class = "panel panel-primary">
<div class = "panel-heading">
<h3 class = "panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . ElencoRepresentante::label(1);
?></h3>
</div>
<div class="panel-body">

    <?php
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'type' => 'horizontal',
    'id' => 'elenco-representante-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false, ),
    'enableClientValidation' => true,
    ));
    ?>



    <?php echo $form->textFieldGroup($model, 'titulo', array('maxlength' => 45)) ?>

<?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>
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
</div>
</div>