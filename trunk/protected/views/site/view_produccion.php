<!--elencoMultimedias-->
<h3></h3>
<?php // var_dump($elencos); ?>
<div class="wrapper">
    <div class="imagenMenu">
        <div class="row">



            <div class="col-lg-6">
                <div class="item">
                    <img src="<?php echo $header->ubicacion ?>" class="img-responsive" alt="...">
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="headline"><span>Información</span></h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Escenario</td><td>
                            </td><td><?php echo $produccion->escenario->nombre ?></td>
                        </tr>
                        <tr>
                            <td>Ubicación</td><td>
                            </td><td><?php echo $produccion->escenario->ubicacion ?></td>
                        </tr>
                        <tr>
                            <td>Género</td><td>
                            </td><td><?php echo $produccion->produccionCategoria->nombre ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <h3 class="headline "><span><?php echo $produccion->nombre; ?></span></h3>
            <p>
                <?php echo $produccion->descripcion ?>
            </p>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-12">
            <h3 class="headline"><span>GALERIA</span></h3>
            <div class="col-lg-offset-1 col-lg-10 col-lg-offset-1 ">
                <!--<div class="wrapper">-->

                <ul id="sb-slider" class="sb-slider">
                    <!--                <li>
                                        <a href="http://www.flickr.com/photos/strupler/2969141180" target="_blank"><img src="<?php echo Yii::app()->baseUrl ?>/site/images/1.jpg" alt="image1"/></a>
                                        <div class="sb-description">
                                            <h3>Creative Lifesaver</h3>
                                        </div>
                                    </li>-->
                    <?php $multimedia = $produccion->produccionMultimedias ?>
                    <?php foreach ($multimedia as $value) : ?>
                        <?php if ($value->tipo == Constants::MULTIMEDIA_TIPO_IMAGEN): ?>
                            <li>
                                <!--<a href="#" target="_blank">-->
                                <img src="<?php echo $value->ubicacion ?>" alt="imagen1"  />
                                <div class="mask">
                                    <p>
                                        <a href="<?php echo $value->ubicacion ?>" data-lightbox="template_showcase"><i class="fa fa-search-plus fa-2x"></i></a>

                                    </p>
                                </div>
                                <!--</a>-->
                                <!--                                <div class="sb-description">
                                                                    <h3></h3>
                                                                </div>-->
                            </li>

                        <?php endif; ?>


                    <?php endforeach; ?>

                </ul>

                <div id="shadow" class="shadow"></div>

                <div id="nav-arrows" class="nav-arrows">
                    <a href="#">Next</a>
                    <a href="#">Previous</a>
                </div>

                <!--</div>-->
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {

        var Page = (function() {

            var $navArrows = $('#nav-arrows').hide(),
                    $shadow = $('#shadow').hide(),
                    slicebox = $('#sb-slider').slicebox({
                onReady: function() {

                    $navArrows.show();
                    $shadow.show();
//                    slicebox.play();

                },
                orientation: 'r',
                cuboidsRandom: true,
                disperseFactor: 30,
                interval: 4000,
            }),
                    init = function() {

                        initEvents();

                    },
                    initEvents = function() {

                        // add navigation events
                        $navArrows.children(':first').on('click', function() {

                            slicebox.next();
                            return false;

                        });

                        $navArrows.children(':last').on('click', function() {

                            slicebox.previous();
                            return false;

                        });

//                        $('#sb-slider').mouseover(function() {
//
//                            slicebox.pause();
//                            return false;
//
//                        });
//                        $('#sb-slider').mouseleave(function() {
//
//                            slicebox.play();
//                            return false;
//
//                        });



                    };

            return {init: init};

        })();

        Page.init();

    });
</script>
