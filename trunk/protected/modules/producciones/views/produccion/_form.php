
<?php
Util::tsRegisterAssetJs('_form.js')
?>
<?php
/** @var ProduccionController $this */
/** @var Produccion $model */
/** @var AweActiveForm $form */
?>
<script type="text/javascript">
    var produccion_id =<?php print $model->id ? $model->id : 0 ; ?>;
</script>
<div class="row" id='contenedor-form'>
    <div class="col-lg-12">
        <div class="panel panel-theme-secondary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Produccion::label(1); ?></h3>
            </div>
            <div class="panel-body">
                <div class="row-fluid">

                    <?php
                    $this->widget('ext.xupload.XUpload', array(
                        'model' => $archivo,
                        'url' => CController::createUrl('/producciones/produccionMultimedia/uploadTmp'),
                        'htmlOptions' => array('id' => 'logo-produccion-form', 'class' => 'form-horizontal'),
                        'attribute' => 'file',
                        'multiple' => false,
                        'previewImages' => true,
                        'autoUpload' => true,
                    ));
                    ?>
                    <?php
                    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                        'type' => 'horizontal',
                        'id' => 'produccion-form',
                        'enableAjaxValidation' => true,
                        'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => false,),
                        'enableClientValidation' => false,
                    ));
                    ?>



                    <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150, 'wrapperHtmlOptions' => array('class' => 'col-sm-7'))) ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="Produccion_escenario_id">Escenario <span class="required">*</span></label>
                        <div class="col-sm-7 col-sm-9">
                            <?php
                            $htmlOptions = array('class' => "form-control");
                            if ($model->escenario_id) {
                                $model_escenario = Escenario::model()->findByPk($model->escenario_id);
                                $htmlOptions = array_merge($htmlOptions, array(
                                    'selected-text' => $model_escenario->nombre
                                ));
                            }
                            echo $form->hiddenField($model, 'escenario_id', $htmlOptions);
                            ?> 
                            <!--<span class="input-group-addon">.00</span>-->
                            <?php echo $form->error($model, 'escenario_id', array('class' => 'help-block error')); ?>
                        </div>

                    </div>
                    <input type="hidden" name="Produccion[logo]" id="logo" value=null />

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="Produccion_produccion_categoria_id">Categoria <span class="required">*</span></label>
                        <div class="col-sm-7 col-sm-9">
                            <?php
                            $htmlOptions = array('class' => "form-control");
                            if ($model->escenario_id) {
                                $model_categoria = ProduccionCategoria::model()->findByPk($model->produccion_categoria_id);
                                $htmlOptions = array_merge($htmlOptions, array(
                                    'selected-text' => $model_categoria->nombre
                                ));
                            }
                            echo $form->hiddenField($model, 'produccion_categoria_id', $htmlOptions);
                            ?> 
                            <span class="input-group-addon"><a href="#" id="popover2" class="pop" entidad="Categoria" data-original-title="" title=""><i class="fa fa-plus"></i></a></span>
                            <!--<span class="input-group-addon">.00</span>-->
                            <?php echo $form->error($model, 'produccion_categoria_id', array('class' => 'help-block error')); ?>
                        </div>

                    </div>

                    <?php
//                echo $form->select2Group($model, 'escenario_id', array('wrapperHtmlOptions' =>
//                    array('class' => 'col-sm-7',), "append" => '<a href="#" id="popover1" class="pop" entidad="Escenario" ><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),)))
//                    array('class' => 'col-sm-7',), "append" => '<a href="#" class="rss" onclick="crearEscenario()"><i class="fa fa-plus"></i></a>', 'widgetOptions' => array('data' => array('' => ' -- Seleccione -- ') + CHtml::listData(Escenario::model()->findAll(), 'id', Escenario::representingColumn()), 'htmlOptions' => array(),)))
                    ?>  


                    <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>

                    <?php // echo $form->dropDownListGroup($model, 'estado', array('wrapperHtmlOptions' => array('class' => 'col-sm-7',), 'widgetOptions' => array('data' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO',), 'htmlOptions' => array(),)))    ?>


                </div>   

                <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-5">
                       <button id="btn_save_produccion" class="btn btn-success ladda-button" form-id="#produccion-form" data-style="expand-right">
                            <span class="ladda-label">Registrar</span>
                        </button>
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
<div id="contenedor-multimedia" class="hidden">
    <div class="row">


        <div class="col-lg-6">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Imagenes'; ?></h3>
                </div>
                <div class="panel-body">
                           <?php
//                    var_dump('id  '.$model->id);
                    $modelImagen = new ProduccionMultimedia('search');
                    $modelImagen->unsetAttributes();
                    $modelImagen->produccion_id = $model->id ? $model->id : 0;
                    $dataProvider =$modelImagen->de_produccion($model->id)->search();
                    $fData = $dataProvider->getData();
//                    $numItem = ProyectoMultimedia::model()->de_proyecto($model->id)->search()->itemCount;
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'producciones/produccionMultimedia/ajaxCreate/produccion_id/'+produccion_id+'/tipo/IMAGEN'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </a>',
                        'template' => (!empty($fData)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('producciones/produccionMultimedia/ajaxCreate/produccion_id/'+produccion_id+'/tipo/IMAGEN',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $dataProvider,
                         'columns'=>array(
                             array(
                                 'class'=>'ext.booster.widgets.TbImageColumn',
//                                 'name'=>'ubicacion',
                                 'imagePathExpression'=>'$data->ubicacion',
                                 'imageOptions'=>array(
                                     'width'=>150,
                                     'height'=>150
                                 )
                                 )
                             )
                    ));
                    ?>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Videos'; ?></h3>
                </div>
                <div class="panel-body">
                    <a onclick="js:formModalSmsMotivo()" class="empty-portlet btn" id="add-motivo-sms"><span class="glyphicon glyphicon-open"></span> <br>Subir Videos</a>
                    <div class="row-fluid">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . 'Archivos'; ?></h3>
                </div>
                <div class="panel-body">
                    <a onclick="js:formModalSmsMotivo()" class="empty-portlet btn" id="add-motivo-sms"><span class="glyphicon glyphicon-open"></span> <br>Subir Archivos</a>

                    <div class="row-fluid">

                    </div>
                </div>
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