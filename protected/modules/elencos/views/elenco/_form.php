<?php
/** @var ElencoController $this */
/** @var Elenco $model */
/** @var AweActiveForm $form */
Util::tsRegisterAssetJs('_form.js')
?>
<script type="text/javascript">
    var proyecto_id =<?php print $model->id ? $model->id : 0  ?>;
</script>
<div class="row" id='contenedor-form'>

    <div class="col-lg-12">
        <div class="panel panel-theme-secondary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', $model->isNewRecord ? 'Create' : 'Update') . ' ' . Elenco::label(1); ?></h3>
            </div>
            <div class="panel-body">
                <?php
//            die(var_dump("d",$archivo));
                $this->widget('ext.xupload.XUpload', array(
                    'model' => $archivo,
                    'url' => CController::createUrl('/elencos/elencoMultimedia/uploadTmp'),
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
                    'id' => 'elenco-form',
                    'enableAjaxValidation' => false,
                    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
                    'enableClientValidation' => true,
                ));
                ?>


                <div class="form-group">

                    <label class="col-sm-3 control-label" for="Elenco_escenario_id">Elenco Representante <span class="required">*</span></label>
                    <div class="col-sm-7 col-sm-9">
                        <?php
                        $htmlOptions = array('class' => "form-control");
                        if ($model->elenco_representante_id) {
                            $model_elenco_representante = ElencoRepresentante::model()->findByPk($model->elenco_representante_id);
                            $htmlOptions = array_merge($htmlOptions, array(
                                'selected-text' => $model_elenco_representante->nombre
                            ));
                        }
                        echo $form->hiddenField($model, 'elenco_representante_id', $htmlOptions);
                        ?>
                        <span class="input-group-addon"><a href="#" id="popover2" class="pop" entidad="ElencoRepresentante" data-original-title="" title=""><i class="fa fa-plus"></i></a></span>

                        <?php echo $form->error($model, 'elenco_representante_id', array('class' => 'help-block error')); ?>

                    </div>
                </div>
                <?php echo $form->textFieldGroup($model, 'nombre', array('maxlength' => 150)) ?>


                <?php
                echo $form->textAreaGroup($model, 'descripcion', array('rows' => 3, 'cols' => 50))
                ?>

                <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-2">
                        <input type="hidden" name="Elenco[logo]" id="logo" value=null />

                        <button id="btn_save_elenco" class="btn btn-success ladda-button" form-id="#elenco-form" data-style="expand-right">
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
                    $this->widget('ext.booster.widgets.TbGridView', array(
                        'id' => 'images-grid',
                        'showTableOnEmpty' => false,
                        'emptyText' => '<a class="empty-portlet btn" onclick="js:viewModal(' . "'proyectos/proyectoMultimedia/ajaxCreate/proyecto_id/'+proyecto_id" . ',function(){});" class="jumbotron">
                                        <h1><span class="glyphicon glyphicon-open"></span></h1>
                                        SUBIR IMAGEN
                                        </a>',
                        'type' => 'striped bordered hover advance',
                        'dataProvider' => ElencoMultimedia::model()->search(),
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
                    <div class="row-fluid">

                    </div>
                </div>
            </div>

        </div    <div class="row">

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
        </div>
    </div>
    <!-- end contenedor-multimedia -->
    <div id="popover-head-ElencoRepresentante" class="hide popover-head">Nuevo Elenco Representante</div>
    <div id="popover-content-ElencoRepresentante" class="hide popover-content">
        <?php $modelElencoRepresentante = new ElencoRepresentante ?>
        <?php
        $formElencoRepresentate = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
            'type' => 'inline',
            'id' => 'elenco-representante-form',
            'enableAjaxValidation' => true,
            'action' => Yii::app()->createUrl('/elencos/elencoRepresentante/ajaxCreate'),
            'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,),
            'enableClientValidation' => false,
        ));
        ?>
        <?php echo $formElencoRepresentate->textFieldGroup($modelElencoRepresentante, 'titulo', array('maxlength' => 45)) ?>

        <?php echo $formElencoRepresentate->textFieldGroup($modelElencoRepresentante, 'nombre', array('maxlength' => 150)) ?>

        <br />
        <!--    <div class="form-group">
                <div class="col-xs-offset-2">-->
        <?php
        $this->widget('ext.booster.widgets.TbButton', array(
//                'buttonType' => 'submit',
            'size' => 'mini',
            'label' => $modelElencoRepresentante->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
            'htmlOptions' => array(
                'onclick' => 'js:saveElencoRepresentante("#elenco-representante-form")',
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