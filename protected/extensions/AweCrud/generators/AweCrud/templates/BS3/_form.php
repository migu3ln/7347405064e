<?php
/** @var AweCrudCode $this */
?>
<?php echo "<?php\n" ?>
/** @var <?php echo $this->controllerClass; ?> $this */
/** @var <?php echo $this->modelClass; ?> $model */
/** @var AweActiveForm $form */
<?php echo "?>\n"?>
<div class="col-lg-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo "<?php echo Yii::t('AweCrud.app',\$model->isNewRecord ? 'Create' : 'Update') . ' ' . {$this->modelClass}::label(1); ?>" ?></h3>
        </div>
        <div class="panel-body">

            <?php
            echo "<?php\n"
            ?> 
            $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
            'type' => 'horizontal',
            'id' => '<?php echo $this->class2id($this->modelClass) ?>-form',
            'enableAjaxValidation' => <?php echo $this->validation == 1 || $this->validation == 3 ? 'true' : 'false' ?>,
            'clientOptions' => array('validateOnSubmit' => <?php echo $this->validation == 2 || $this->validation == 3 ? 'true' : 'false' ?>, 'validateOnChange' => <?php echo $this->validation == 1 || $this->validation == 3 ? 'true' : 'false' ?>,),
            'enableClientValidation' => <?php echo $this->validation == 2 || $this->validation == 3 ? 'true' : 'false' ?>,
            ));
            ?>
            <?php
            $aux = 1; //auxiliar para ver si el campo es par o impar
            ?>

            <?php foreach ($this->tableSchema->columns as $column): ?>

                <?php
                if ($column->autoIncrement || in_array($column->name, array_merge($this->create_time, $this->update_time))) {
                    continue;
                }
                //skip many to many relations, they are rendered below, this allows handling of nm relationships
                foreach ($this->getRelations() as $relation) {
                    if ($relation[2] == $column->name && $relation[0] == 'CManyManyRelation') {
                        continue 2;
                    }
                }
                ?>
                <?php if ($aux % 2): //ver elemento es par, creo q si la cantidad de campos es impar no generaria el ultimo </div>?>
                    <?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $column) . " ?>\n"; ?>
                <?php else: ?>
                    <?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $column) . " ?>\n"; ?>
                <?php endif ?>
                <?php $aux++; ?>
            <?php endforeach; ?>
            <?php if ($aux % 2 == FALSE) echo('</div>'); ?>
            <?php
            foreach ($this->getRelations() as $relatedModelClass => $relation) {
                if ($relation[0] == 'CManyManyRelation') {
                    echo "<div class=\"row nm_row\">\n";
                    echo $this->getNMField($relation, $relatedModelClass, $this->modelClass);
                    echo "</div>\n\n";
                }
            }
            ?>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php echo "" ?>
                    <?php echo "<?php \$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'label'=>\$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
		)); ?>\n" ?>
                    <?php echo "<?php \$this->widget('booster.widgets.TbButton', array(
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>\n" ?>
                    <?php echo "<?php \$this->endWidget(); ?>\n" ?>
                </div>
            </div>
        </div>
    </div>
</div>