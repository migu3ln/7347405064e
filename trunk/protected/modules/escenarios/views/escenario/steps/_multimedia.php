<!--<div id="contenedor-multimedia" class="hidden">-->
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Upload') . ' ' . 'Imagenes'; ?></h3>
            </div>
            <div class="panel-body">

                <?php
                $modelImagen = new EscenarioMultimedia('search');
                $modelImagen->unsetAttributes();
                $modelImagen->escenario_id = $model->id ? $model->id : 0;
                $dataProvider = $modelImagen->de_tipo(Constants::MULTIMEDIA_TIPO_IMAGEN)->search();
                $fData = $dataProvider->getData();
                $this->widget('ext.booster.widgets.TbGridView', array(
                    'id' => 'images-grid',
                    'showTableOnEmpty' => false,
                    'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'escenarios/escenarioMultimedia/ajaxCreate/escenario_id/'+escenario_id+'/tipo/IMAGEN'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </a>',
                    'template' => (!empty($fData)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('escenarios/escenarioMultimedia/ajaxCreate/escenario_id/'+escenario_id+'/tipo/IMAGEN',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
                    'type' => 'striped bordered hover advance',
                    'dataProvider' => $dataProvider,
                    'columns' => array(
                        array(
                            'class' => 'ext.booster.widgets.TbImageColumn',
//                                 'name'=>'ubicacion',
                            'imagePathExpression' => '$data->ubicacion',
                            'imageOptions' => array(
                                'width' => 150,
                                'height' => 150
                            )
                        )
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
                $modelVideo = new EscenarioMultimedia('search');
                $modelVideo->unsetAttributes();
                $modelVideo->escenario_id = $model->id ? $model->id : 0;
                $dataProvideVideo = $modelVideo->de_tipo(Constants::MULTIMEDIA_TIPO_VIDEO)->search();
                $fDataVideo = $dataProvideVideo->getData();
//                    $numItem = ProyectoMultimedia::model()->de_escenario($model->id)->search()->itemCount;
                $this->widget('ext.booster.widgets.TbGridView', array(
                    'id' => 'video-grid',
                    'showTableOnEmpty' => false,
                    'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'escenarios/escenarioMultimedia/ajaxCreate/escenario_id/'+escenario_id+'/tipo/VIDEO'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR VIDEO
                                        </a>',
                    'template' => (!empty($fDataVideo)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('escenarios/escenarioMultimedia/ajaxCreate/escenario_id/'+escenario_id+'/tipo/VIDEO',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
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
                $modelArchivo = new EscenarioMultimedia('search');
                $modelArchivo->unsetAttributes();
                $modelArchivo->escenario_id = $model->id ? $model->id : 0;
                $dataProvideArchivo = $modelArchivo->de_tipo(Constants::MULTIMEDIA_TIPO_ARCHIVO)->search();
                $fDataArchivo = $dataProvideArchivo->getData();
                $this->widget('ext.booster.widgets.TbGridView', array(
                    'id' => 'file-grid',
                    'showTableOnEmpty' => false,
                    'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'escenarios/escenarioMultimedia/ajaxCreate/escenario_id/'+escenario_id+'/tipo/ARCHIVO'" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR ARCHIVOS
                                        </a>',
                    'template' => (!empty($fDataArchivo)) ? "{summary}\n{items}\n{pager}\n<br><button  onclick=\"js:viewModal('escenarios/escenarioMultimedia/ajaxCreate/escenario_id/'+escenario_id+'/tipo/ARCHIVO',function(){});\" class=\"btn btn-info\">Añadir</button>" : "{summary}\n{items}\n{pager}",
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
<!--</div>-->