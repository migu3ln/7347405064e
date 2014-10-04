<?php
Util::tsRegisterAssetJs('_form.js');
/** @var ProyectoController $this */
/** @var Proyecto $model */
/** @var AweActiveForm $form */
?>
<script type="text/javascript">
    var proyecto_id =<?php print $model->id ? $model->id : 0 ; ?>;
</script>
<!-- begin contendor-form -->
<div class="row" id='contenedor-form'>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Proyecto::label(1); ?></h3>
            </div>
            <div class="panel-body">
                <?php
                $this->widget('ext.xupload.XUpload', array(
                    'model' => $archivo,
                    'url' => CController::createUrl('/proyectos/proyectoMultimedia/uploadTmp'),
                    'htmlOptions' => array('id' => 'logo-proyecto-form', 'class' => 'form-horizontal'),
                    'attribute' => 'file',
                    'multiple' => false,
                    'previewImages' => true,
                    'autoUpload' => true,
                ));
                ?>
                <?php
                $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
                    'type' => 'horizontal',
                    'id' => 'proyecto-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => false, 'validateOnChange' => false,),
                    'enableClientValidation' => false,
                ));
                ?>
                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>
                <?php echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50)) ?>
                <input type="hidden" name="Proyecto[logo]" id="logo" value=null />


                <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-2">

                        <button id="btn_save_proyecto" class="btn btn-success ladda-button" form-id="#proyecto-form" data-style="expand-right">
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
<!-- end contenedor-form -->

<!-- begin contenedor-multimedia -->
<div id="contenedor-multimedia" class="hidden">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Imagenes'; ?></h3>
                </div>
                <div class="panel-body">

                    <?php
//                    var_dump('id  '.$model->id);
                    $modelImagen = new ProyectoMultimedia('search');
                    $modelImagen->unsetAttributes();
                    $modelImagen->proyecto_id = $model->id ? $model->id : 0;
                    $dataProvider =$modelImagen->de_proyecto($model->id)->search();
                    $fData = $dataProvider->getData();
//                    $numItem = ProyectoMultimedia::model()->de_proyecto($model->id)->search()->itemCount;
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </a>',
                        'template' => (!empty($fData)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id,function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
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
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Videos'; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Archivos'; ?></h3>

                </div>
                <div class="panel-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contenedor-multimedia -->