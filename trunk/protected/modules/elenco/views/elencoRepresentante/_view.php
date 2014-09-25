<?php
/** @var ElencoRepresentanteController $this */
/** @var ElencoRepresentante $data */
?>
<div class="view">
                    
        <?php if (!empty($data->titulo)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->titulo); ?>
            </div>
        </div>

        <?php endif; ?>
                
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
    </div>