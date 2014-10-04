<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Agregar Taquilla') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <form id="escenario-taquilla-form"  role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label required" for="Escenario_Taquilla_nombre">Nombre <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="Escenario_Taquilla_nombre" class="form-control" name="EscenarioTaquilla[nombre]">
                            <div class="help-block error" id="Escenario_Taquilla_nombre_em_" style="display:none"></div>
                        </div>
                    </div>
                    <div class="form-actions-float">
                        <button id="btn_save_taquilla" class="btn btn-success ladda-button" form-id="#escenario-taquilla-form" data-style="expand-right">
                            <span class="ladda-label">Registrar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('AweCrud.app', 'Agregar Taquilla') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row-fluid">
                <div class="col-sm-6">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Taquilla</label>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="well">
                        <div class="row-fluid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
