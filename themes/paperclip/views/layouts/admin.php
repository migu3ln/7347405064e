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
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon.ico">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">
        <!-- ladda submit -->
        <!--<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ladda.min.css" rel="stylesheet">-->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ladda-themeless.min.css" rel="stylesheet">
        <!-- Resources -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/lightbox.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom_fixes.css" rel="stylesheet">


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
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <!-- Navigation -->
                    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="index.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="..."></a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <button class="navbar-btn btn btn-theme-primary pull-right hidden-sm hidden-xs">Sign In</button>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown active">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="index.html">Home: Default</a></li>
                                            <li><a href="index-full.html">Home: Fullscreen</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu">
                                                <a href="javascript:void(0);">About Us</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="about-us.html">About Us: Default</a></li>
                                                    <li><a href="about-us_option-1.html">About Us: Option 1</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                            <li class="dropdown-submenu">
                                                <a href="javascript:void(0);">Contact Us</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="contact-us.html">Contact Us: Default</a></li>
                                                    <li><a href="contact-us_option-1.html">Contact Us: Option 1</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="help-center.html">Help Center</a></li>
                                            <li><a href="help-item.html">Help Item</a></li>
                                            <li class="dropdown-submenu">
                                                <a href="javascript:void(0);">Pricing Options</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="pricing.html">Pricing: Boxes</a></li>
                                                    <li><a href="pricing_joint.html">Pricing: Joint Boxes</a></li>
                                                    <li><a href="pricing_table.html">Pricing: Table</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="responsive-video.html">Responsive Video</a></li>
                                            <li><a href="services.html">Services</a></li>
                                            <li><a href="sign-in.html">Sign In</a></li>
                                            <li><a href="sign-up.html">Sign Up</a></li>
                                            <li><a href="search-results.html">Search Results</a></li>
                                            <li class="dropdown-submenu">
                                                <a href="javascript:void(0);">Timeline</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="timeline_center.html">Timeline: Center</a></li>
                                                    <li><a href="timeline_left.html">Timeline: Left</a></li>
                                                    <li><a href="timeline_right.html">Timeline: Right</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="error-page.html">404 Error Page</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="portfolio.html">Portfolio</a></li>
                                            <li><a href="portfolio-item.html">Portfolio Item</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu">
                                                <a href="javascript:void(0);">Blog</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="blog_sidebar-right.html">Sidebar Right</a></li>
                                                    <li><a href="blog_sidebar-left.html">Sidebar Left</a></li>
                                                    <li><a href="blog_sidebar-no.html">Without Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="javascript:void(0);">Blog Post</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="blog-post_sidebar-right.html">Sidebar Right</a></li>
                                                    <li><a href="blog-post_sidebar-left.html">Sidebar Left</a></li>
                                                    <li><a href="blog-post_sidebar-no.html">Without Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="shop.html">Shop</a></li>
                                            <li><a href="shop-item.html">Shop Item</a></li>
                                            <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                            <li><a href="user-profile.html">User Profile</a></li>
                                        </ul>
                                    </li>
                                    <li class="hidden-sm">
                                        <a href="ui-elements.html">UI Elements</a>
                                    </li>
                                    <!-- Navbar Search -->
                                    <li class="hidden-xs" id="navbar-search">
                                        <a href="#">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <div class="hidden" id="navbar-search-box">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">Go!</button>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- Mobile Search -->
                                <form class="navbar-form navbar-right visible-xs" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-btn">
                                            <button class="btn btn-theme-primary" type="button">Search!</button>
                                        </span>
                                    </div>
                                </form>
                            </div><!--/.nav-collapse -->
                        </div>
                    </div> 
                    <!-- / .navigation -->
                </div>
            </div>
        </div>
        <!-- Wrapper -->
        <div class="wrapper">
            <div class="topic">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3><?php echo Yii::t('AweCrud.app', 'Administración') ?></h3>
                        </div>
                        <div class="col-sm-8">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="col-sm-3">
                    <!-- Categories -->
                    <div class="panel-group" id="help-nav">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#help-nav" href="#help-nav-one" class="collapsed">
                                    Eventos
                                </a>
                            </div>
                            <div id="help-nav-one" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="#">Nuevo</a></li>
                                        <li><a href="#">Administración</a></li>
                                        <li><a href="#">Vistas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#help-nav" href="#help-nav-two" class="collapsed">
                                    Escenarios
                                </a>
                            </div>
                            <div id="help-nav-two" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->createUrl('escenarios/escenario/create') ?>">Nuevo</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl('escenarios/escenario/') ?>">Administración</a></li>
                                        <li><a href="#">Vistas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#help-nav" href="#help-nav-three" class="collapsed">
                                    Elencos
                                </a>
                            </div>
                            <div id="help-nav-three" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->createUrl('elencos/elenco/create') ?>">Nuevo</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl('elencos/elenco/') ?>">Administración</a></li>
                                        <li><a href="#">Vistas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#help-nav" href="#help-nav-four" class="collapsed">
                                    Proyectos
                                </a>
                            </div>
                            <div id="help-nav-four" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->createUrl('proyectos/proyecto/create') ?>">Nuevo</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl('proyectos/proyecto/create') ?>">Administración</a></li>
                                        <li><a href="#">Vistas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#help-nav" href="#help-nav-five" class="collapsed">
                                    Producciones
                                </a>
                            </div>
                            <div id="help-nav-five" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->createUrl('producciones/produccion/create') ?>">Nuevo</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl('producciones/produccion/admin') ?>">Administración</a></li>
                                        <li><a href="#">Vistas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <?php echo $content; ?>
                </div>
            </div>

        </div> <!-- / .wrapper -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scrolltopcontrol.js"></script>
        <!-- ladda submit -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/spin.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ladda.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ladda.jquery.min.js"></script>
        
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.validateAjax.js"></script>
        <!-- script principal -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/index.js"></script>
    </body>
</html>

