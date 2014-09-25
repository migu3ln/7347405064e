<?php
/** @var EscenarioTaquillaController $this */
/** @var EscenarioTaquilla $data */
?>
<div class="view">
                    
        <?php if (!empty($data->nombre)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->nombre); ?>
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