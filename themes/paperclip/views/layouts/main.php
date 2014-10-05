<?php Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon.ico">-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>


        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">

        <!-- Resources -->
        <!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>-->
        <!--<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>-->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!--<link href="<?php // echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">-->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/lightbox.css" rel="stylesheet">
                <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/site.css" rel="stylesheet">
                <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/isotope_style.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var baseUrl = "<?php print Yii::app()->baseUrl . '/'; ?>";
            var themeUrl = "<?php print Yii::app()->theme->baseUrl . '/'; ?>";
        </script>
    </head>

    <body>
        <div class="container-fluid">
            <br/>
            <div class="row">
                <div class="col-xs-6 col-md-3 art-fundacionTeatroNacionalSucre_img"></div>
                <!--                <div class="col-xs-6 col-md-3">
                                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/fundacionTeatroNacionalSucre_img.png">
                                </div>-->
            </div>
            <br/>
            <div class="row">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">INICIO <i class="fa fa-home"></i></a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl;  ?>/site/quienesSomos">¿QUIÉNES SOMOS?</a></li>
                                <li><a href="#">PRESENTACIÓN PROPUESTA</a></li>
                                <li><a href="#">SUSCRIPCIÓN AGENDA</a></li>
                                <li><a href="#">AGENDA ELENCOS</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">INFORMACIÓN PÚBLICA<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">CONTÁCTANOS</a></li>
                                <li><form action="<?php echo Yii::app()->baseUrl ?>/cruge/ui/login"><button class="navbar-btn btn btn-theme-primary" >Sign In</button></form></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
        <!-- Wrapper -->
        <div class="wrapper">
            <div class="row-fluid">
                <div class="col-md-12">
                    <?php echo $content; ?>
                </div>
            </div>

        </div> <!-- / .wrapper -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scrolltopcontrol.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/index.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.isotope.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/portfolio.js"></script>
    </body>
</html>