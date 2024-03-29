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
                <div class="row">
                    <div class="col-lg-12">
                        <div id="content_prev" class="row" hidden>
                            <div class="col-md-offset-3 col-md-3 col-xs-4">
                                <div class="thumbnail">
                                    <img id="img_prev" data-src="holder.js/100%x200" alt="100%x300" src="#">

                                    <div class="caption">
                                        <h4><strong>Logo</strong></h4>

                                        <p>
                                            <a id="btn_upload_change" href="#" class="btn btn-info" role="button">
                                                <i class="fa fa-arrows-h"></i>
                                                Cambiar</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content_action" class="row">
                            <div class="col-lg-12">
                                <form id="logo-form" class="form-horizontal" role="form">
                                    <div class="form-group form-group-sm">
                                        <label class="col-sm-3 control-label" for="formGroupInputSmall">Logo</label>

                                        <div class="col-sm-9">
                                            <button id="btn_upload_action" class="btn btn-default btn-xs"><i
                                                    class="fa fa-plus"></i> Seleccione
                                            </button>
                                            <input name="logo_imagen" id="logo_imagen" type="file"
                                                   style="display: none">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
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
                <input type="hidden" name="Proyecto[logo]" value=null id="Proyecto_logo"/>


                <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-2">

                        <button id="btn_save_proyecto" class="btn btn-success ladda-button" form-id="#proyecto-form"
                                data-style="expand-right">
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
                    $dataProvider = $modelImagen->de_tipo(Constants::MULTIMEDIA_TIPO_IMAGEN)->de_proyecto($model->id)->search();
                    $fData = $dataProvider->getData();
                    //                    $numItem = ProyectoMultimedia::model()->de_proyecto($model->id)->search()->itemCount;
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id+'/tipo/IMAGEN'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </a>',
                        'template' => (!empty($fData)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id+'/tipo/IMAGEN',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $dataProvider,
                        'columns' => array(
                            'ubicacion'

//                            array(
//                                'class' => 'ext.booster.widgets.TbImageColumn',
////                                 'name'=>'ubicacion',
//                                'imagePathExpression' => '$data->ubicacion',
//                                'imageOptions' => array(
//                                    'width' => 150,
//                                    'height' => 150
//                                )
//                            )
                        )
                    ));
                    unset($modelImagen);
                    unset($dataProvider);
                    unset($fData);
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

                    <?php
                    //                    var_dump('id  '.$model->id);
                    $modelVideo = new ProyectoMultimedia('search');
                    $modelVideo->unsetAttributes();
                    $modelVideo->proyecto_id = $model->id ? $model->id : 0;
                    $dataProvideVideo = $modelVideo->de_tipo(Constants::MULTIMEDIA_TIPO_VIDEO)->de_proyecto($model->id)->search();
                    $fDataVideo = $dataProvideVideo->getData();
                    //                    $numItem = ProyectoMultimedia::model()->de_proyecto($model->id)->search()->itemCount;
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'video-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id+'/tipo/VIDEO'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR VIDEO
                                        </a>',
                        'template' => (!empty($fDataVideo)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id+'/tipo/VIDEO',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $dataProvideVideo,
                        'columns' => array(
                            'ubicacion'
                        )
                    ));
                    unset($modelVideo);
                    unset($dataProvideVideo);
                    unset($fDataVideo);
                    ?>
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
                    <?php
                    $modelArchivo = new ProyectoMultimedia('search');
                    $modelArchivo->unsetAttributes();
                    $modelArchivo->proyecto_id = $model->id ? $model->id : 0;
                    $dataProvideArchivo = $modelArchivo->de_tipo(Constants::MULTIMEDIA_TIPO_ARCHIVO)->de_proyecto($model->id)->search();
                    $fDataArchivo = $dataProvideArchivo->getData();
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'file-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id+'/tipo/ARCHIVO'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR ARCHIVOS
                                        </a>',
                        'template' => (!empty($fDataArchivo)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id+'/tipo/ARCHIVO',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => $dataProvideArchivo,
                        'columns' => array(
                            'ubicacion'
                        )
                    ));
                    unset($modelArchivo);
                    unset($dataProvideArchivo);
                    unset($fDataArchivo);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contenedor-multimedia -->
