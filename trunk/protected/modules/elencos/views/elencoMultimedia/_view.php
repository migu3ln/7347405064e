<?php
/** @var ElencoMultimediaController $this */
/** @var ElencoMultimedia $data */
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
                
        <?php if (!empty($data->menu)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('menu')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->menu); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->encabezado)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('encabezado')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->encabezado); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->elenco->nombre)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('elenco_id')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->elenco->nombre); ?>
            </div>
        </div>

        <?php endif; ?>
    </div>