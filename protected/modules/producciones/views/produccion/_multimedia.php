
<?php
Util::tsRegisterAssetJs('_form.js')
?>
<?php
/** @var ProduccionController $this */
/** @var Produccion $model */
/** @var AweActiveForm $form */
?>
<div class="col-lg-6">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' '.'Imagenes'  ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">

                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'produccion-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => true,),
                    'enableClientValidation' => false,
                ));
                ?>



                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150, 'wrapperHtmlOptions' => array('class' => 'col-sm-7'))) ?>
                <?php // echo $form->dropDownListGroup($model, 'escenario_id', array('wrapperHtmlOptions' => array('class' => 'col-sm-7',), 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),))) ?>

                 <?php echo $form->select2Group($model, 'escenario_id', 
                        array('wrapperHtmlOptions' =>
                            array('class' => 'col-sm-7',), "append" => '<a href="#" class="rss" onclick="crearEscenario()"><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),))) ?>  


                <?php echo $form->select2Group($model, 'produccion_categoria_id', 
                        array('wrapperHtmlOptions' =>
                            array('class' => 'col-sm-7',), "prepend" => '<a href="#" class="rss" onclick="crearCategoria()"><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(ProduccionCategoria::model()->findAll(), 'id', ProduccionCategoria::representingColumn()), 'htmlOptions' => array(),))) ?>  


                
                <?php
//                echo $form->select2Group($model, 'produccion_categoria_id', array(
//                    'asDropDownList' => true,
//                    'data' => CHtml::listData(ProduccionCategoria::model()->findAll(), 'id', ProduccionCategoria::representingColumn()),
////                    'class' => 'span6',
////                    'ajax' => array(
////                        'type' => 'POST',
////                        'url' => CController::createUrl('incidencia/cuentaContacto'),
////                        'update' => '#Incidencia_contacto_id',
//////                    'success' => 'function(data) {
//////                        $("#Incidencia_contacto_id").html(data); 
//////                        $("#Incidencia_contacto_id").selectBox("refresh"); ',
////                    ),
////                    'empty' => '- Ninguno -',
//                ));
                ?>
             

                <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>

                <?php // echo $form->dropDownListGroup($model, 'estado', array('wrapperHtmlOptions' => array('class' => 'col-sm-7',), 'widgetOptions' => array('data' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',), 'htmlOptions' => array(),)))  ?>


            </div>   
            
            <div class="form-group">
                <div class="col-lg-7 col-lg-offset-5">
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

<div class="">

</div>
