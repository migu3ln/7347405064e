<?php if (Yii::app()->user->hasFlash('loginflash')): ?>
    <div class="alert alert-error">
        <?php echo Yii::app()->user->getFlash('loginflash'); ?>
    </div>
<?php else: ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'logon-form',
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>   
    <fieldset>
        <div class="form-group">
            <?php echo $form->textField($model, 'username', array('placeholder' => CrugeTranslator::t('logon', 'Username'), 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->passwordField($model, 'password', array('placeholder' => Yii::t('app', CrugeTranslator::t('logon', "Password")), 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <div class="checkbox">
            <label>
                <?php echo $form->checkBox($model, 'rememberMe'); ?> Recordarme más tarde
            </label>    
        </div>
        <input class="btn btn-lg btn-success btn-block" type="submit" value="<?php echo CrugeTranslator::t('logon', "Login") ?>">
    </fieldset>
    <?php $this->endWidget(); ?>
<?php endif; ?>
