
<?php
Util::tsRegisterAssetJs('_form.js')
?>
<?php
/** @var ProduccionController $this */
/** @var Produccion $model */
/** @var AweActiveForm $form */
?>
<div class="col-lg-12">
    <div class="panel panel-theme-secondary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Produccion::label(1); ?></h3>
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


                <div class="form-group">
                    <label class="control-label" for="Producion_escenario_id">Escenario</label>
                    <div class="form-control">
                        <?php
                        $wrapperHtmlOptions = array('class' => "col-sm-7");
                        if ($model->escenario_id) {
                            $model_escenario = Escenario::model()->findByPk($model->escenario_id);
                            $wrapperHtmlOptions = array_merge($wrapperHtmlOptions, array(
                                'selected-text' => $model_escenario->nombre
                            ));
                        }
                        echo $form->hiddenField($model, 'escenario_id',$wrapperHtmlOptions);
                        ?>
                        <span class="help-inline error" id="Producion_escenario_id_em_" style="display: none"></span>
                    </div>
                </div>

                <?php
//                echo $form->select2Group($model, 'escenario_id', array('wrapperHtmlOptions' =>
//                    array('class' => 'col-sm-7',), "append" => '<a href="#" id="popover1" class="pop" entidad="Escenario" ><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),)))
//                    array('class' => 'col-sm-7',), "append" => '<a href="#" class="rss" onclick="crearEscenario()"><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),)))
                ?>  


                <?php
//                echo $form->select2Group($model, 'produccion_categoria_id', array('wrapperHtmlOptions' =>
//                    array('class' => 'col-sm-7',), "prepend" => '<a href="#" id="popover2"  class="pop"  entidad="ProduccionCategoria"><i  class="fa fa-plus "></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(ProduccionCategoria::model()->findAll(), 'id', ProduccionCategoria::representingColumn()), 'htmlOptions' => array(),)))
                ?>  



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

                <?php // echo $form->dropDownListGroup($model, 'estado', array('wrapperHtmlOptions' => array('class' => 'col-sm-7',), 'widgetOptions' => array('data' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',), 'htmlOptions' => array(),)))   ?>


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

<div class="col-lg-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Imagenes'; ?></h3>
        </div>
        <div class="panel-body">
            <div class="jumbotron">
                <h1><span class="
                          glyphicon glyphicon-open"></span></h1>

                SUBIR IMAGEN
            </div>
            <div class="row-fluid">

            </div>
        </div>
    </div>

</div>
<div class="col-lg-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Videos'; ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">

            </div>
        </div>
    </div>

</div>
<div class="col-lg-6">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Archivos'; ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">

            </div>
        </div>
    </div>

</div>


<div id="popover-head-Escenario" class="hide popover-head">Nuevo Escenario</div>
<div id="popover-content-Escenario" class="hide popover-content">
    <?php $modelEscenario = new Escenario ?>
    <?php
    $formProyecto = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'inline',
        'id' => 'escenario-form',
        'enableAjaxValidation' => true,
        'action' => Yii::app()->createUrl('/escenarios/escenario/ajaxCreate'),
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $formProyecto->textFieldGroup($modelEscenario, 'nombre', array('maxlength' => 150, 'placeholder' => 'Proyecto', 'class' => 'form-control ')) ?>
    <?php // echo $formProyecto->error($modelEscenario, 'nombre') ?>
    <br />
    <!--    <div class="form-group">
            <div class="col-xs-offset-2">-->
    <?php
    $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
        'size' => 'mini',
        'label' => $modelEscenario->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onclick' => 'js:saveProyecto("#escenario-form")',
            'class' => 'btn-xs'
        )
    ));
    ?>
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'label' => Yii::t('AweCrud.app', 'Cancel'),
        'htmlOptions' => array('onclick' => 'js:cerrarpopover();',
            'class' => 'btn-xs'
        )
    ));
    ?>
    <?php $this->endWidget(); ?>
    <!--        </div>
    
        </div>-->
</div>

<div id="popover-head-ProduccionCategoria" class="hide popover-head">Nueva Categoria</div>
<div id="popover-content-ProduccionCategoria" class="hide popover-content">
    <?php $modelCategoria = new ProduccionCategoria ?>
    <?php
    $formProyecto = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'type' => 'inline',
        'id' => 'produccion-categoria-form',
        'enableAjaxValidation' => true,
        'action' => Yii::app()->createUrl('/producciones/produccionCategoria/ajaxCreate'),
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $formProyecto->textFieldGroup($modelCategoria, 'nombre', array('maxlength' => 150, 'placeholder' => 'Proyecto', 'class' => 'form-control ')) ?>
    <?php // echo $formProyecto->error($modelCategoria, 'nombre') ?>
    <br />
    <!--    <div class="form-group">
            <div class="col-xs-offset-2">-->
    <?php
    $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
        'size' => 'mini',
        'label' => $modelCategoria->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onclick' => 'js:saveProyecto("#produccion-categoria-form")',
            'class' => 'btn-xs'
        )
    ));
    ?>
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'label' => Yii::t('AweCrud.app', 'Cancel'),
        'htmlOptions' => array('onclick' => 'js:cerrarpopover();',
            'class' => 'btn-xs'
        )
    ));
    ?>
    <?php $this->endWidget(); ?>
    <!--        </div>
    
        </div>-->
</div>