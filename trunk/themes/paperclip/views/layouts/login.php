<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style_responsive.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style_default.css" rel="stylesheet" id="style_color">
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body  id="login-body">
        <div class="login-header">
            <!-- BEGIN LOGO -->
            <div id="logo" class="center">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="logo" class="center" />
            </div>
            <!-- END LOGO -->
        </div>
        <div id="login">
            <?php echo $content ?>
        </div>
    </body>
    <!-- END BODY -->
</html>