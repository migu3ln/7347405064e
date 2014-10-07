<!--elencoMultimedias-->
<h3></h3>
<?php // var_dump($elencos); ?>
<div class="wrapper">
    <div class="imagenMenu">


        <div class="col-lg-6">
            <div class="item">
                <img src="<?php echo $header->ubicacion ?>" class="img-responsive" alt="...">
            </div>
        </div>
        <div class="col-lg-6">
        </div>
    </div>
    <div class="col-lg-12">
        <h3 class="headline "><span><?php echo $produccion->nombre; ?></span></h3>
        <p>
            <?php echo $produccion->descripcion ?>
        </p>
    </div>
    <div class="">

    </div>
    <div class="col-sm-12">
        <h3 class="headline"><span>GALERIA</span></h3>
        <div class="col-lg-offset-2 col-sm-8 ">
            <div class="wrapper">

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
                                <img src="<?php echo $value->ubicacion ?>" alt="image1"/>
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

                },
                orientation: 'r',
                cuboidsRandom: true,
                disperseFactor: 30
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

                    };

            return {init: init};

        })();

        Page.init();

    });
</script>
