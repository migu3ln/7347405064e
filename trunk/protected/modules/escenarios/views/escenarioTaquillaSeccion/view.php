<?php
/** @var EscenarioTaquillaSeccionController $this */
/** @var EscenarioTaquillaSeccion $model */

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . EscenarioTaquillaSeccion::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => "<div>" . CHtml::image(Yii::app()->baseUrl . "/images/topbar/administrar.png") . "</div>" . Yii::t('AweCrud.app', 'Manage'), 'url' => array('admin')),
    array('label' => "<div>" . CHtml::image(Yii::app()->baseUrl . "/images/topbar/nuevo.png") . "</div>" .  Yii::t('AweCrud.app', 'Create'), 'url' => array('create')),
    //array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'itemOptions'=>array('class'=>'active')),
    //array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    //array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View'); ?> </legend>

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
                  'nombre',
             array(
			'name' => 'escenario_taquilla_id',
			'value'=>($model->escenarioTaquilla !== null) ? CHtml::link($model->escenarioTaquilla, array('/escenarioTaquilla/view', 'id' => $model->escenarioTaquilla->id)).' ' : null,
			'type' => 'html',
		),
	),
)); ?>
</fieldset>