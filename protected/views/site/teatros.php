<!--elencoMultimedias-->
<h3>Nuestros Teatros</h3>
<?php // var_dump($elencos); ?>

<div class="col-lg-12">
    <div class="contenedor-imagenes">

        <div class="row-fluid isotope" id="isotope-container" >

            <?php foreach ($teatros as $value) : ?>

                <?php // var_dump($prueba=$value->elencoMultimedias); echo"_---------------------" ?>
                <?php $logo = EscenarioMultimedia::model()->logo_de_escenario($value->id) ?>
                <div class="col-sm-6 col-md-6 col-lg-6 isotope-item modernism" >
                    <div class="portfolio-item">
                        <div class="titulo-imagen"><?php echo $value->nombre ?></div>
                        <div class="portfolio-thumbnail">
                            <img class="img-responsive" src="<?php echo $logo->ubicacion ?>" alt="...">
                            <a class="link-image-responsive" href="<?php echo Yii::app()->createUrl('/site/teatro/id/' . $value->id) ?>" ></a>

                            <p>
                            </p>
                        </div>
                    </div> <!-- / .portfolio-item -->
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>
