<?php
/** @var EscenarioMultimediaController $this */
/** @var EscenarioMultimedia $data */
?>
<div class="view">
                    
        <?php if (!empty($data->ubicacion)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ubicacion); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->local)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('local')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->local); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->tipo)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->tipo); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->escenario->nombre)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('escenario_id')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->escenario->nombre); ?>
            </div>
        </div>

        <?php endif; ?>
    </div>